<?php

namespace App\Middleware;

use App\Core\Middleware;

class RoleMiddleware extends Middleware{
    public function handle()
    {

        if(!isset($_SESSION['user'])){
            header('location: /e-commerce-app/public/login');
            exit;
        }

        if($_SESSION['user']['role'] !== 'admin'){
            header('location: /e-commerce-app/public/dashboard');
            exit;
        }
    }
}