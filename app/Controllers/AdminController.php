<?php
namespace App\Controllers;

use App\Core\Controller;

class AdminController extends Controller{

    public function index(){
        echo "<h1>ADMIN DASHBOARD</h1>";
        echo "<p>Selamat datang, " . $_SESSION['user']['username'] . "!</p>";
        echo "<p>Role kamu:, " . $_SESSION['user']['role'] . "!</p>";
        echo "<a href='/e-commerce-app/public/logout'>Logout</a>";
    }
    
    public function products(){
        echo "<h1>Kelola Produk(Admin Only)</h1>";
        echo "<p>Halaman ini hanya bisa diakses oleh admin</p>";
        echo '<a href="/e-commerce-app/public/admin/dashboard">Kembali ke halaman admin dashboard</a>';
    }

}