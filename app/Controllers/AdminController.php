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
            if($order['status'] !== 'cancelled'){
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
        $name = sanitize($_POST['name'] ?? '');
        $price = $_POST['price'] ?? 0;
        $description = sanitize($_POST['description'] ?? '');
        $image = sanitize($_POST['image'] ?? '');
        $stock = $_POST['stock'] ?? 0;

        // validasi
        if(empty($name)){
            $_SESSION['flash'] = 'Nama produk harus diisi';
            header('location: ' . base_path('admin/products/create'));
            exit;
        }
        
        if(!validatePrice($price)){
            $_SESSION['flash'] = 'Harga harus berupa angka positif';
            header('location: ' . base_path('admin/products/create'));
            exit;
        }
        
        if(!validateStock($stock)){
            $_SESSION['flash'] = 'Stok harus berupa angka';
            header('location: ' . base_path('admin/products/create'));
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
        header('location: ' . base_path('admin/products'));
        exit;
    }

    // form edit produk
    public function editProduct(){
        $id = $_GET['id'] ?? null;

        if(!$id){
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('location: ' . base_path('admin/products'));
            exit;
        }

        $product = Product::find($id);

        if(!$product){
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('location: ' . base_path('admin/products'));
            exit;
        }

        $this->view('admin/products/edit', [
            'product' => $product
        ]);
    }

    // proses update produk
     public function updateProduct(){
        $id = $_POST['id'] ?? null;

        if(!$id){
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('location: ' . base_path('admin/products'));
            exit;
        }
        
        $name = sanitize($_POST['name'] ?? '');
        $price = $_POST['price'] ?? 0;
        $description = sanitize($_POST['description'] ?? '');
        $image = sanitize($_POST['image'] ?? '');
        $stock = $_POST['stock'] ?? 0;

        // validasi
        if(empty($name)){
            $_SESSION['flash'] = 'Nama produk harus diisi';
            header('location: ' . base_path('admin/products/edit?id=' . $id));
            exit;
        }
        
        if(!validatePrice($price)){
            $_SESSION['flash'] = 'Harga harus berupa angka positif';
            header('location: ' . base_path('admin/products/edit?id=' . $id));
            exit;
        }
        
        if(!validateStock($stock)){
            $_SESSION['flash'] = 'Stok harus berupa angka';
            header('location: ' . base_path('admin/products/edit?id=' . $id));
            exit;
        }

        $result = Product::edit($id, [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image' => $image,
            'stock' => $stock
        ]);

        if($result){
            $_SESSION['flash'] = 'Produk berhasil diupdate';
            header('location: ' . base_path('admin/products'));
        } else {
            $_SESSION['flash'] = 'Gagal update produk, silakan coba lagi';
            header('location: ' . base_path('admin/products/edit?id=' . $id));
        }
        exit;
    }
    // Hapus produk
    public function deleteProduct() {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('Location: ' . base_path('admin/products'));
            exit;
        }
        
        Product::delete($id);
        
        $_SESSION['flash'] = 'Produk berhasil dihapus';
        header('Location: ' . base_path('admin/products'));
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
            header('location: ' . base_path('admin/orders'));
            exit;
        }

        $order = Order::find($orderId);

        if(!$order){
            $_SESSION['flash'] = 'Order tidak ditemukan';
            header('location: ' . base_path('admin/orders'));
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
        $orderId = (int) ($_POST['order_id'] ?? null);
        $status = sanitize($_POST['status'] ?? '');

        if(!$orderId || !$status){
            $_SESSION['flash'] = 'Data tidak lengkap';
            header('location: ' . base_path('admin/orders'));
            exit;
        }

        try {
            Order::updateStatus($orderId, $status);
            $_SESSION['flash'] = 'Status order berhasil diupdate';
            header('location: ' . base_path('admin/orders/detail?id=' . $orderId));
        } catch (\Exception $e) {
            $_SESSION['flash'] = 'Gagal update status order: ' . $e->getMessage();
            header('location: ' . base_path('admin/orders/detail?id=' . $orderId));
        }
        exit;
    }

    // update status payment (verifikasi pembayaran)
    public function updatePaymentStatus(){
        $paymentId = (int) ($_POST['payment_id'] ?? null);
        $status = sanitize($_POST['status'] ?? '');
        $orderId = (int) ($_POST['order_id'] ?? null);

        if(!$paymentId || !$status || !$orderId){
            $_SESSION['flash'] = 'Data tidak lengkap';
            header('location: ' . base_path('admin/orders'));
            exit;
        } 

        try {
            Payment::updateStatus($paymentId, $status);

            // jika payment di approve(paid), update order status jadi processing
            if($status === 'paid'){
                Order::updateStatus($orderId, 'processing');
            }

            $_SESSION['flash'] = 'Status pembayaran berhasil diupdate';
            header('location: ' . base_path('admin/orders/detail?id=' . $orderId));
        } catch (\Exception $e) {
            $_SESSION['flash'] = 'Gagal update pembayaran: ' . $e->getMessage();
            header('location: ' . base_path('admin/orders/detail?id=' . $orderId));
        }
        exit;
    }
}