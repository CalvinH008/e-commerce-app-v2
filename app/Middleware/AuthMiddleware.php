<?php

namespace App\Middleware;

use App\Core\Middleware;

class AuthMiddleware extends Middleware{
    public function handle()
    {
        if(!isset($_SESSION['user'])){
            die("AKSES DITOLAK (BELUM LOGIN)"); 
        }
    }
}