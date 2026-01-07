<?php 

namespace App\Core;

use PDO;    

class Model{
    protected static PDO $db;

    public static function init(){
        self::$db = Database::connect();
    }
}