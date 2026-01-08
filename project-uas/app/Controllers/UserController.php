<?php
class UserController extends Controller {
    public function index() {
        if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
            header('Location: ' . BASEURL . 'AuthController');
            exit;
        }

        $data['judul'] = 'E-STORE | Dashboard';
        
        // Logika Filter & Pencarian
        $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : null;
        $keyword = isset($_POST['cari']) ? $_POST['cari'] : null;

        if($kategori) {
            $data['produk'] = $this->model('Product')->getProdukByKategori($kategori);
        } elseif($keyword) {
            $data['produk'] = $this->model('Product')->cariProduk($keyword);
        } else {
            $data['produk'] = $this->model('Product')->getProdukAll();
        }

        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id) {
        $data['judul'] = 'Detail Produk';
        $data['p'] = $this->model('Product')->getProdukById($id);
        
        $this->view('templates/header', $data);
        $this->view('user/detail', $data);
        $this->view('templates/footer');
    }
}