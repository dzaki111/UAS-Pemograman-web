<?php

class CartController extends Controller {
    public function index() {
        $data['judul'] = 'E-STORE | Checkout';
        // Ambil data keranjang dari session jika ada
        $data['keranjang'] = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];
        
        $this->view('templates/header', $data);
        $this->view('user/keranjang', $data);
        $this->view('templates/footer');
    }

    public function tambah($id) {
        if (session_status() == PHP_SESSION_NONE) session_start();

        // Ambil detail produk dari model
        $produk = $this->model('Product')->getProdukById($id);

        if($produk) {
            // Struktur data keranjang
            $item = [
                'id' => $produk['id'],
                'nama' => $produk['nama'],
                'harga' => $produk['harga'],
                'gambar' => $produk['gambar'],
                'jumlah' => 1
            ];

            // Jika barang sudah ada, tambah jumlahnya saja
            if(isset($_SESSION['keranjang'][$id])) {
                $_SESSION['keranjang'][$id]['jumlah'] += 1;
            } else {
                $_SESSION['keranjang'][$id] = $item;
            }
        }

        // Setelah klik "Beli Sekarang", langsung ke halaman keranjang
        header('Location: ' . BASEURL . 'CartController');
        exit;
    }

    public function hapus($id) {
        unset($_SESSION['keranjang'][$id]);
        header('Location: ' . BASEURL . 'CartController');
        exit;
    }
}