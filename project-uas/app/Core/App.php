<?php 

class App {
    protected $controller = 'AuthController'; // Default controller
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        // 1. CEK CONTROLLER
        // Jika URL kosong, gunakan default AuthController
        if (isset($url[0])) {
            // Cek apakah file Controller tersebut ada di folder Controllers
            if (file_exists('../app/Controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }

        // Panggil filenya
        require_once '../app/Controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. CEK METHOD
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. KELOLA PARAMETER
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Jalankan controller & method serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        // Kembalikan array kosong jika tidak ada parameter url
        return [];
    }
}