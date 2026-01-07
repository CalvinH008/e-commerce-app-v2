<?php

namespace App\Core;

class Session{
    public static function flash(string $key, ?string $value = null){
        if($value !== null){
            $_SESSION['flash'][$key] = $value;
        }else{
            $msg = $_SESSION['flash'][$key] ?? null;
            unset($_SESSION['flash'][$key]);
            return $msg;
        }
    }
}