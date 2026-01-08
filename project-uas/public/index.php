<?php 
// 1. Jalankan session hanya satu kali di paling atas
if( !session_id() ) session_start();

// 2. Panggil semua file inti (Core) dan Konfigurasi
// Pastikan penulisan huruf besar/kecil sesuai dengan nama folder Anda
require_once '../app/Config/config.php';
require_once '../app/Core/App.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Database.php';

// 3. Inisialisasi class App cukup satu kali saja
$app = new App();