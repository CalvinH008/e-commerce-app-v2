<?php 

namespace App\Core;

use PDO;    

class Model{
    protected static PDO $db;
    public static function setDB(PDO $pdo){
        self::$db = $pdo;
    }
}