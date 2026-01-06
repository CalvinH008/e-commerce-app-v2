<?php

spl_autoload_register(function ($class) {

    // hanya untuk namespace App\
    if (strpos($class, 'App\\') !== 0) {
        return;
    }

    // hapus App\
    $class = str_replace('App\\', '', $class);

    // ubah \ jadi /
    $class = str_replace('\\', '/', $class);

    // app/
    $baseDir = dirname(__DIR__);

    $file = $baseDir . '/' . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
