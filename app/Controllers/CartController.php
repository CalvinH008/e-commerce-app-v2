<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Product;
use PDO;

class CartController extends Controller{
    // tambah produk ke cart
    public function add(){
        // ambil id dari form atau url
        $product_id = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;
    
        if(!$product_id){
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('location: /e-commerce-app/public/products');
            exit;
        }
        // ambil data produk dari database
        $product = Product::find($product_id);
        
        if(!$product){
            $_SESSION['flash'] = 'Produk tidak ditemukan';
            header('location: /e-commerce-app/public/products');
            exit;
        }
        // inisialisasi cart jika belum ada
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        // cek apakah produk sudah ada di cart
        if(isset($_SESSION['cart'][$product_id])){
            // produk udah ada, tambah quantity
            $_SESSION['cart'][$product_id['quantity']] += $quantity;
        }else{
            // produk belum ada, tambah baru
            $_SESSION['cart'][$product_id] = [
                'product_id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => $quantity
            ];
        }

        $_SESSION['flash'] = 'Produk berhasil ditambahkan ke keranjang';
        header('location: /e-commerce-app/public/cart');
        exit;
    }
    // tampilkan isi cart
    public function index(){
        $cart = $_SESSION['cart'] ?? [];

        // hitung total
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $this->view('cart/index', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    // update quantity
    public function update(){
        $product_id = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 0;

        if($product_id && isset($_SESSION['cart'][$product_id])){
            if($quantity > 0){
                $_SESSION['cart'][$product_id]['quantity'] = $quantity;
                $_SESSION['flash'] = 'Keranjang berhasil diupdate';
            }else{
                unset($_SESSION['cart'][$product_id]);
                $_SESSION['flash'] = 'Produk dihapus dari keranjang';
            }
        }

        header('location: /e-commerce-app/public/cart');
        exit;
    }

    //  hapus item dari cart
    public function remove(){
        $product_id = $_POST['product_id'] ?? null;
        
        if($product_id && isset($_SESSION['cart'][$product_id])){
            unset($_SESSION['cart'][$product_id]);
            $_SESSION['flash'] = 'Produk berhasil dihapus dari keranjang';
        }

        header('location: /e-commerce-app/public/cart');
        exit;
    }

    // kosongkan cart
    public function clear(){
        $_SESSION['cart'] = [];
        $_SESSION['flash'] = 'Keranjang dikosongkan';
        header('location: /e-commerce-app/public/cart');
        exit;
    }

}