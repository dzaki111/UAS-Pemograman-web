<?php 

class Product {
    private $table = 'produk';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getProdukAll() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function tambahDataProduk($data) {
        $query = "INSERT INTO produk (nama, harga) VALUES (:nama, :harga)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('harga', $data['harga']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataProduk($id) {
        $query = "DELETE FROM produk WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}