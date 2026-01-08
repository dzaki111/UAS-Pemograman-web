<?php

class AuthController extends Controller {
    public function index() {
        $this->view('templates/header', ['judul' => 'Login']);
        $this->view('auth/login');
        $this->view('templates/footer');
    }

    public function prosesLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('User')->getUserByUsername($username);
        
        if($user && $password == $user['password']) { 
            if (session_status() == PHP_SESSION_NONE) session_start();
            
            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Ambil role dari DB (admin/user)

            // OTOMATISASI REDIRECT BERDASARKAN ROLE
            if($_SESSION['role'] == 'admin') {
                header('Location: ' . BASEURL . 'AdminController');
            } else {
                header('Location: ' . BASEURL . 'UserController');
            }
            exit;
        } else {
            header('Location: ' . BASEURL . 'AuthController');
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASEURL . 'AuthController');
        exit;
    }
}