<?php

namespace App\Models;

use App\Core\Model;

class Product extends Model{

    // ambil semua product
    public static function getAll(){
        self::init();
        $stmt = self::$db->query("SELECT * FROM products ORDER BY created_by DESC");
        return $stmt->fetchAll();
    }

    // cari produk berdasarkan id
    public static function find(int $id){
        self::init();
        $stmt = self::$db->query("SELECT * FROM products WHERE id = :id LIMIT 1");
        $stmt->execute([':id => $id']);
        return $stmt->fetch();
    }

    // edit produk 
    public static function edit(int $id, array $data){
        self::init();
        $stmt = self::$db->query("UPDATE products SET 
                        name = :name,
                        price = :price,
                        description = :description,
                        image = :image,
                        stock = :stock
                        WHERE id = :id");

        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':image' => $data['image'],
            ':stock' => $data['stock']
        ]);
    }   

    // tambah produk
    public static function tambah(array $data){
        self::init();
        $stmt = self::$db->prepare("INSERT INTO products (name, price, description, image, stock) VALUES (:name, :price, :description, :image, :stock)");
        
        return $stmt->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':image' => $data['image'] ?? null,
            ':stock' => $data['stock'],
        ]);
    }

    // delete produk
    public static function hapus(int $id){
        self::init();
        $stmt = self::$db->query("DELETE FROM products WHERE id = :id LIMIT 1");
        return $stmt->execute([':id' => $id]);
    }

}