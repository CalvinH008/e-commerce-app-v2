<?php

namespace App\Middleware;

use App\Core\Middleware;

class GuestMiddleware extends Middleware{
    public function handle()
    {
        if(isset($_SESSION['user'])){
            header('location: /e-commerce-app/public/dashboard');
            exit;
        }
    }
}