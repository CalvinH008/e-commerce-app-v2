<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;

class AdminController extends Controller{

    // dashboard utama admin
    public function index(){
        // ambil statistik
        $totalProducts = count(Product::getAll());
        $totalOrders = count(Order::all());

        $allOrders = Order::all();
        $totalRevenue = 0;
        foreach($allOrders as $order){
            if($order['status'] !== 'canceled'){
                $totalRevenue += $order['total'];
            }
        }

        // ambil 5 order terbaru
        $recentOrders = array_slice($allOrders, 0, 5);

        $this->view('admin/dashboard',[
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'recentOrders' => $recentOrders
        ]);
    }
    
    // halaman list products
    public function products(){
        $products = Product::getAll();
        $this->view('admin/products/index',[
            'products' => $products
        ]);
    }

    // form tambah produk
    public function createProduct(){
        $this->view('admin/products/create');
    }

    // proses tambah produk
    public function storeProduct(){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'] ?? '';
        $image = $_POST['image'] ?? '';
        $stock = $_POST['stock'] ?? 0;

        // validasi
        if(empty($name) || $price <= 0){
            $_SESSION['flash'] = 'Nama dan harga produk harus diisi';
            header('location: /e-commerce-app/public/admin/products/create');
            exit;
        }

        Product::create([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image' => $image,
            'stock' => $stock
        ]);

        $_SESSION['flash'] = 'Produk berhasil ditambahkan';
        header('location: /e-commerce-app/public/admin/products');
        exit;
    }

    // form edit produk
    public function editProduct(){
        $id = $_GET['id'] ?? null;

        if(!$id){
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('location: /e-commerce-app/public/admin/products');
            exit;
        }

        $product = Product::find($id);

        if(!$product){
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('location: /e-commerce-app/public/admin/products');
            exit;
        }

        $this->view('admin/products/edit', [
            'product' => $product
        ]);
    }

    // proses update produk
     public function updateProduct(){
        $id = $_GET['id'] ?? null;

        if(!$id){
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('location: /e-commerce-app/public/admin/products');
            exit;
        }

        Product::edit($id, [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'image' => $_POST['image'],
            'stock' => $_POST['stock']
        ]);

        $_SESSION['flash'] = 'Produk tidak diupdate';
        header('location: /e-commerce-app/public/admin/products');
        exit;
    }
    // Hapus produk
    public function deleteProduct() {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('Location: /e-commerce-app/public/admin/products');
            exit;
        }
        
        Product::hapus($id);
        
        $_SESSION['flash'] = 'Produk berhasil dihapus';
        header('Location: /e-commerce-app/public/admin/products');
        exit;
    }

    // halaman semua order
    public function orders(){
        $orders = Order::all();
        
        $this->view('admin/orders/index', [
            'orders' => $orders
        ]);
    }

    // detail order(sama seperti user, tapi admin bisa ubah status)
    public function orderDetail(){
        $orderId = $_GET['id'] ?? null;

        if(!$orderId){
            $_SESSION['flash'] = 'Order tidak ditemukan';
            header('location: /e-commerce-app/public/admin/orders');
            exit;
        }

        $order = Order::find($orderId);

        if(!$order){
            $_SESSION['flash'] = 'Order tidak ditemukan';
            header('location: /e-commerce-app/public/admin/orders');
            exit;
        }

        $items = Order::getItems($orderId);
        $payment = Payment::findByOrder($orderId);

        $this->view('admin/orders/detail', [
            'order' => $order,
            'items' => $items,
            'payment' => $payment
        ]);
    }

    // update status order
    public function updateOrderStatus(){
        $orderId = $_POST['order_id'] ?? null;
        $status = $_POST['status'] ?? null;

        if(!$orderId || !$status){
            $_SESSION['flash'] = 'Data tidak lengkap';
            header('location: /e-commerce-app/public/admin/orders');
            exit;
        }

        Order::updateStatus($orderId, $status);

        $_SESSION['flash'] = 'Status order berhasil di update';
        header('location: /e-commerce-app/public/admin/orders/detail?id=' . $orderId);
        exit;
    }

    // update status payment (verifikasi pembayaran)
    public function updatePaymentStatus(){
        $paymentId = $_POST['payment_id'] ?? null;
        $status = $_POST['status'] ?? null;

        if(!$paymentId || !$status){
            $_SESSION['flash'] = 'Data tidak lengkap';
            header('location: /e-commerce-app/public/admin/orders');
            exit;
        } 

        Payment::updateStatus($paymentId, $status);

        // jika payment di approve(paid), update order status jadi processing

        if($status === 'paid'){
            $payment = Payment::findByOrder($_POST['order_id']);
            Order::updateStatus($_POST['order_id'], 'processing');
        }

        $_SESSION['flash'] = 'Status pembayaran berhasil diupdate';
        header('location: /e-commerce-app/public/admin/orders/detail?id=' . $_POST['order_id']);
        exit;
    }
}