<?php

namespace App\Core;

class Controller{
    public function view(string $view, array $data = []){
        extract($data);
        $viewFile = __DIR__ . "/../../views/$view.php";

        if(!file_exists($viewFile)){
            die("view $viewFile tidak ditemukan");
        }

        require $viewFile;
    }
}