<?php 

class AdminController extends Controller {
    public function index() {
        if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASEURL . 'AuthController');
            exit;
        }

        $data['judul'] = 'Manajemen Produk';
        $data['produk'] = $this->model('Product')->getProdukAll();
        
        $this->view('templates/header_admin', $data); // Template khusus admin
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function tambah_halaman() {
        $data['judul'] = 'Tambah Produk Baru';
        $this->view('templates/header_admin', $data);
        $this->view('admin/tambah', $data);
        $this->view('templates/footer');
    }

    public function proses_tambah() {
        if( $this->model('Product')->tambahDataProduk($_POST) > 0 ) {
            header('Location: ' . BASEURL . 'AdminController');
            exit;
        }
    }

    public function hapus($id) {
        if( $this->model('Product')->hapusDataProduk($id) > 0 ) {
            header('Location: ' . BASEURL . 'AdminController');
            exit;
        }
    }
}