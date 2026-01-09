<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class ProductController extends Controller{

    // halaman list semua produk untuk user
    public function index(){
        $products = Product::getAll();
        $this->view('products/index', ['products' => $products]);
    }

    // halaman detail produk
   public function show() {
    // Ambil ID dari URL
    $id = $_GET['id'] ?? null;
    
    // Cek apakah ID ada
    if (!$id) {
        die('ID produk tidak ditemukan');
    }
    
    // Ambil data produk dari database
    $product = Product::find($id);
    
    // Debug: cek apakah data produk berhasil diambil
    if ($product === false || $product === null) {
        die('Produk dengan ID ' . $id . ' tidak ditemukan di database');
    }
    
    // Kirim ke view
    $this->view('products/show', ['product' => $product]);
}

}