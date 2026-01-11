<?php
namespace App\Models;
use App\Core\Model;

class Order extends Model{

    // buat order baru
    public static function create(array $data){
        self::init();

        try{
            // insert ke table orders
            $stmt = self::$db->prepare("INSERT INTO orders(user_id, total, status) VALUES (:user_id, :total, :status)");
            $stmt->execute([
                ':user_id' => $data['user_id'],
                ':total' => $data['total'],
                ':status' => $data['status'] ?? 'pending'
            ]);
            // return order id yang baru dibuat
            return self::$db->lastInsertId();
        }catch(\PDOException $e){
            die("Error create error: " . $e->getMessage());
        }
    }

    // ambil order berdasarkan id
    public static function find(int $id){
        self::init();

        $stmt = self::$db->prepare("SELECT * FROM orders WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // ambil order berdasarkan user_id
    public static function findByUser(int $user_id){
        self::init();

        $stmt = self::$db->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    // ambil semua order untuk admin
    public static function all(){
        self::init();

        $stmt = self::$db->prepare("SELECT * FROM orders JOIN users ON orders.user_id = users.id ORDER BY orders.created_at DESC");
        return $stmt->fetchAll();
    }

    // update status order
    public static function updateStatus(int $id, string $status){
        self::init();

        $stmt = self::$db->prepare("UPDATE orders SET status = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':id' => $id,
        ]);
    }

    // ambil orders item (detail produk)
    public static function getItems(int $orderId){
        self::init();

        $stmt = self::$db->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetchAll();
    }

    // insert order itemsP
    public static function addItem(array $data){
        self::init();
        
        $stmt = self::$db->prepare("INSERT INTO order_items(order_id, product_id, product_name, price, quantity, subtotal) VALUES (:order_id, :product_id, :product_name, :price, :quantity, :subtotal)");

        return $stmt->execute([
            ':order_id' => $data['order_id'],
            ':product_id' => $data['product_id'],
            ':product_name' => $data['product_name'],
            ':price' => $data['price'],
            ':quantity' => $data['quantity'],
            ':subtotal' => $data['subtotal']
        ]);
    }
}