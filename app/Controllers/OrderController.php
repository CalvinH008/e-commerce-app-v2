<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Order;
use App\Models\Payment;

class OrderController extends Controller{

    // halaman ambil order
    public function detail(){
        $orderId = $_GET['id'] ?? null;

        if(!$orderId){
            $_SESSION['flash'] = 'Order tidak ditemukan';
            header('location: /e-commerce-app/public/dashboard');
            exit;
        }

        // ambil data order
        $order = Order::find($orderId);

        if(!$order){
            $_SESSION['flash'] = 'Order tidak ditemukan';
            header('location: /e-commerce-app/public/dashboard');
            exit;
        }

        // Cek apakah order milik user yang login (kecuali admin)
        if($_SESSION['user']['role'] !== 'admin' && $order !== $_SESSION['user']['id']){
            $_SESSION['flash'] = 'Anda tidak memiliki akses ke order ini';
            header('location: /e-commerce-app/public/dashboard');
            exit;
        }

        // ambil order items
        $items = Order::getItems($orderId);

        // ambil payment info
        $payment = Payment::findByOrder($orderId);

        $this->view('order/detail', [
            'order' => $order,
            'items' => $items,
            'payment' => $payment
        ]);
    }

    // history user
    public function history(){
        $userId = $_SESSION['user']['id'];
        $orders = Order::findByUser($userId);

        $this->view('order/history', [
            'orders' => $orders
        ]);
    }

}