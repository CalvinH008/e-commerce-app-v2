<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Order;
use App\Models\Payment;

class CheckoutController extends Controller{

    // halaman checkout 
    public function index(){

        // cek apakah cart kosong 
        if(empty($_SESSION['cart'])){
            $_SESSION['flash'] = "Keranjang masih kosong";
            header('location: /e-commerce-app/public/products');
            exit;
        }

        $cart = $_SESSION['cart'];

        // hitung total
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $this->view('checkout/index', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function process() {
    // Cek cart
    if (empty($_SESSION['cart'])) {
        $_SESSION['flash'] = 'Keranjang kosong';
        header('Location: /e-commerce-app/public/products');
        exit;
    }
    
    $cart = $_SESSION['cart'];
    $userId = $_SESSION['user']['id'];
    
    // Hitung total
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    
    // Ambil data dari form
    $paymentMethod = $_POST['payment_method'] ?? 'transfer';
    
    try {
        // 1. Buat order
        $orderId = Order::create([
            'user_id' => $userId,
            'total' => $total,
            'status' => 'pending'
        ]);
        
        // 2. Insert order items (detail produk)
        foreach ($cart as $productId => $item) {
            Order::addItem([
                'order_id' => $orderId,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity']
            ]);
        }
        
        // 3. Buat payment
        Payment::create([
            'order_id' => $orderId,
            'amount' => $total,
            'payment_method' => $paymentMethod,
            'status' => 'pending'
        ]);
        
        // 4. Kosongkan cart
        $_SESSION['cart'] = [];
        
        // 5. Redirect ke halaman sukses
        $_SESSION['flash'] = 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.';
        header('Location: /e-commerce-app/public/order/detail?id=' . $orderId);
        exit;
        
    } catch (\Exception $e) {
        $_SESSION['flash'] = 'Terjadi kesalahan: ' . $e->getMessage();
        header('Location: /e-commerce-app/public/checkout');
        exit;
    }
    }
}