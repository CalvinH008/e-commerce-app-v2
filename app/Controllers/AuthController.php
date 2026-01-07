<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Model;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller {

    public function registerForm() {
        $this->view('auth/register');
    }

    public function register() {
        Model::init();

        $success = User::create([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'role' => 'user'
        ]);

        if ($success) {
            Session::flash('success', 'Register berhasil, silakan login');
            header('Location: /e-commerce-app/public/login');
            exit;
        }

        Session::flash('error', 'Register gagal');
        header('Location: /e-commerce-app/public/register');
        exit;
    }

    public function loginForm() {
        $this->view('auth/login');
    }

    public function login() {
        Model::init();

        $user = User::findByEmail($_POST['email']);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: /e-commerce-app/public/dashboard');
            exit;
        }

        Session::flash('error', 'Login gagal');
        header('Location: /e-commerce-app/public/login');
        exit;
    }

    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /e-commerce-app/public/login');
        exit;
    }
}
