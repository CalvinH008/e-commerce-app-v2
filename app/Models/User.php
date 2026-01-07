<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {

    public static function create(array $data) {
        $stmt = self::$db->prepare("INSERT INTO users(username, email, password, role) VALUES (:username, :email, :password, :role)");
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role' => $data['role'] ?? 'user'
        ]);
    }

    public static function findByEmail(string $email) {
        $stmt = self::$db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
}
