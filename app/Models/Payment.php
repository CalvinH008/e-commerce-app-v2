<?php
namespace App\Models;
use App\Core\Model;

class Payment extends Model{

    // buat payment baru
    public static function create(array $data){
        self::init();

        try{
            $stmt = self::$db->prepare("INSERT INTO payments(order_id, amount, payment_method, status, proof) VALUES(:order_id, :amount, :payment_method, :status, :proof)");

            return $stmt->execute([
                ':order_id' => $data['order_id'],
                ':amount' => $data['amount'],
                ':payment_method' => $data['payment_method'] ?? 'transfer', 
                ':status' => $data['status'] ?? 'pending', 
                ':proof' => $data['proof'] ?? null
            ]);
        }catch(\PDOException $e){
            die("Error create payment: " . $e->getMessage());
        }
    }

    public static function findByOrder(int $id){
        self::init();

        $stmt = self::$db->prepare("SELECT * FROM payments WHERE order_id = :order_id LIMIT 1");
        $stmt->execute([':order_id' => $id]);
        return $stmt->fetch();
    }

    public static function updateStatus(int $id, string $status){
        self::init();

        try {
            $stmt = self::$db->prepare("UPDATE payments SET status = :status WHERE id = :id");
            return $stmt->execute([
                ':status' => $status,
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Error update payment status: " . $e->getMessage());
        }
    }

    public static function updateProof(int $id, string $proof){
        self::init();

        try {
            $stmt = self::$db->prepare("UPDATE payments SET proof = :proof WHERE id = :id");
            return $stmt->execute([
                ':proof' => $proof,
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Error update payment proof: " . $e->getMessage());
        }
    }
}