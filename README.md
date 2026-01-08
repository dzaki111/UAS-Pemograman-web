# UAS-Pemograman-web
#### Nama   = DZAKI ARIF RAHMAN  
#### Kelas  = TI.24.A4  
#### NIM    = 312410312  
#### Matkul  = Pemograman Web 1 




## Pertanyaan 




#### **1. Latar Belakang dan Arsitektur Dasar**

Dalam membangun proyek ini, saya tidak menggunakan cara PHP tradisional (spaghetti code), melainkan menggunakan arsitektur **MVC (Model-View-Controller)**. Alasan utamanya adalah untuk menciptakan aplikasi yang rapi dan profesional. Kita memulai dengan membuat sebuah "Mesin Utama" di dalam folder `app/Core/App.php`.

Fungsi dari mesin ini adalah sebagai **Routing**. Jadi, setiap kali ada orang mengakses website kita, permintaan mereka akan ditangkap oleh file `index.php` di folder public, lalu diteruskan ke `App.php`. Mesin ini akan membedah alamat URL tersebut untuk mencari tahu: "Controller mana yang harus dipanggil?", "Fungsi apa yang ingin dijalankan?", dan "Data (parameter) apa yang dibawa?". Dengan sistem ini, website kita terlihat jauh lebih modern dan terorganisir.

---

#### **2. Sistem Autentikasi dan Pengalihan Hak Akses (Role)**

Salah satu tantangan terbesar dalam membuat toko online adalah memisahkan halaman untuk pembeli (User) dan penjual (Admin). Kita menyelesaikan ini di dalam `AuthController.php`.

Prosesnya begini: ketika user memasukkan username dan password, sistem tidak hanya mengecek apakah akun itu ada, tapi juga mengecek kolom `role` di database. Jika database mengatakan orang ini adalah **'admin'**, maka sistem secara otomatis melakukan **Redirect** (pengalihan) menggunakan kode `header('Location: ... AdminController')`. Sebaliknya, jika dia adalah **'user'**, dia akan dilempar ke `UserController`. Ini adalah inti dari keamanan aplikasi kita, di mana setiap halaman diproteksi menggunakan **Session** agar orang yang belum login tidak bisa sembarangan masuk ke dashboard.

---

#### **3. Pembangunan Katalog dan Fitur Filter Produk**

Untuk halaman depan (User Dashboard), kita ingin pengguna bisa mencari barang dengan mudah. Di sinilah peran `UserController.php` dan `Product_model.php` bekerja sama. Kita membuat kodingan yang bisa mendeteksi input dari sidebar kategori.

Jika pengguna mencentang "Smartphone" atau "Laptop", JavaScript yang kita pasang di `script.js` akan mendeteksi perubahan tersebut dan mengirimkan instruksi ke Controller. Controller kemudian meminta Model untuk menjalankan perintah SQL khusus (seperti `SELECT * FROM produk WHERE kategori = ...`). Hasilnya kemudian dikirimkan kembali ke View untuk ditampilkan dalam bentuk kartu-kartu produk (Cards) yang cantik menggunakan Bootstrap 5.

---

#### **4. Logika Keranjang Belanja "Beli Sekarang"**

Fitur yang paling krusial yang Anda minta adalah: "ketika klik tombol Beli Sekarang, barang langsung masuk ke keranjang". Ini adalah logika yang cukup kompleks karena PHP bersifat *stateless* (mudah lupa).

Untuk mengatasinya, kita menggunakan `CartController.php`. Setiap kali tombol "Beli Sekarang" diklik, kita mengirimkan **ID Produk** ke fungsi `tambah($id)`. Di sana, sistem akan mengambil detail barang (nama, harga, gambar) dari database, lalu menyimpannya ke dalam **Array Session** bernama `$_SESSION['keranjang']`. Dengan menyimpan data di Session, barang tersebut akan tetap "tersimpan" meskipun user berpindah-pindah halaman, sampai akhirnya user sampai di halaman Checkout (Screenshot 195) yang menampilkan total pembayaran dan metode bayar.

---

#### **5. Manajemen Data oleh Admin (CRUD)**

Di sisi belakang (Admin), kita membangun sistem manajemen yang sangat fungsional sesuai Screenshot 199. Di sini, `AdminController.php` bertanggung jawab penuh. Admin bisa melihat semua data dalam tabel yang rapi.

Kita menambahkan fitur **Tambah Data** di mana admin bisa memasukkan nama barang, harga, kategori, dan link gambar melalui form di halaman `admin/tambah.php`. Selain itu, ada fitur **Hapus** yang bekerja secara dinamis. Ketika admin klik hapus, sistem akan mengirimkan ID barang ke Controller, menjalankan perintah `DELETE` di database, dan langsung menyegarkan (refresh) halaman agar data terbaru langsung terlihat.

---

#### **6. Sentuhan Akhir: Desain dan User Interface (UI/UX)**

Terakhir, untuk membuat aplikasi ini tidak membosankan, kita merombak total **CSS** di `style.css`. Kita menggunakan skema warna **Merah dan Putih** untuk memberikan kesan toko elektronik yang energetik dan terpercaya.

Kita menambahkan efek *hover* pada kartu produk, sehingga saat kursor diarahkan, kartu tersebut akan sedikit terangkat (floating effect). Sidebar dibuat dengan warna gelap (Dark Mode) untuk memberikan kontras yang jelas antara menu navigasi dan konten utama. Penggunaan **Bootstrap Icons** juga mempermanis tampilan tombol-tombol aksi, membuat aplikasi ini tidak hanya berfungsi dengan baik, tetapi juga nyaman dipandang mata.

---

### **KODINGAN LENGKAP YANG MENDUKUNG PENJELASAN DI ATAS**


### ** STRUKTUR FOLDER PROYEK**

```text
project-uas/
├── app/
│   ├── Config/
│   │   └── config.php
│   ├── Controllers/
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── CartController.php
│   │   └── UserController.php
│   ├── Core/
│   │   ├── App.php
│   │   ├── Controller.php
│   │   └── Database.php
│   ├── Models/
│   │   ├── Product_model.php
│   │   └── User_model.php
│   └── Views/
│       ├── admin/ (index.php, tambah.php)
│       ├── auth/ (login.php)
│       ├── user/ (index.php, detail.php, keranjang.php)
│       └── templates/ (header.php, footer.php, header_admin.php)
├── public/
│   ├── css/ (style.css)
│   ├── js/ (script.js)
│   ├── img/ (simpan foto produk di sini)
│   └── index.php

```

---

### ** KODINGAN INTI (CORE & CONFIG)**

**File: `app/Config/config.php**`

```php
<?php
define('BASEURL', 'http://localhost/project-uas/public/index.php?url=');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'project_uas');

```

**File: `app/Core/App.php**` (Logika Routing)

```php
<?php 
class App {
    protected $controller = 'AuthController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();
        if(!empty($url) && file_exists('../app/Controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once '../app/Controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
        if(isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}

```

---

### ** CONTROLLERS (LOGIKA FITUR)**

**File: `app/Controllers/AuthController.php**` (Login & Role Redirect)

```php
<?php
class AuthController extends Controller {
    public function index() {
        $this->view('templates/header', ['judul' => 'Login E-Store']);
        $this->view('auth/login');
        $this->view('templates/footer');
    }

    public function prosesLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $this->model('User_model')->getUserByUsername($username);
        
        if($user && $password == $user['password']) { 
            $_SESSION['login'] = true;
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            $target = ($user['role'] == 'admin') ? 'AdminController' : 'UserController';
            header('Location: ' . BASEURL . $target);
        } else {
            header('Location: ' . BASEURL . 'AuthController');
        }
        exit;
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASEURL . 'AuthController');
        exit;
    }
}

```

**File: `app/Controllers/CartController.php**` (Beli Sekarang & Keranjang)

```php
<?php
class CartController extends Controller {
    public function tambah($id) {
        $produk = $this->model('Product_model')->getProdukById($id);
        if($produk) {
            $_SESSION['keranjang'][$id] = [
                'nama' => $produk['nama'], 'harga' => $produk['harga'],
                'gambar' => $produk['gambar'], 'jumlah' => 1
            ];
        }
        header('Location: ' . BASEURL . 'CartController');
        exit;
    }

    public function index() {
        $data['keranjang'] = $_SESSION['keranjang'] ?? [];
        $this->view('templates/header', ['judul' => 'Detail Pesanan']);
        $this->view('user/keranjang', $data);
        $this->view('templates/footer');
    }
}

```

---

### ** VIEWS (TAMPILAN & STYLE)**

**File: `public/css/style.css**` (Desain Merah-Putih)

```css
:root { --primary-red: #e62129; }
body { font-family: 'Inter', sans-serif; background: #f8f9fa; }
.navbar { background: var(--primary-red) !important; }
.card-product { border: none; border-radius: 12px; transition: 0.3s; }
.card-product:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
.btn-danger { background: var(--primary-red); border: none; font-weight: bold; }
/* Sidebar Admin */
.sidebar-admin { background: #343a40; min-height: 100vh; color: white; width: 250px; }

```

**File: `app/views/user/index.php**` (Dashboard User & Filter)

```php
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6 class="fw-bold mb-3">Kategori</h6>
                <form action="<?= BASEURL ?>UserController" method="post">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kategori" value="Smartphone" onchange="this.form.submit()">
                        <label>Smartphone</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kategori" value="Laptop" onchange="this.form.submit()">
                        <label>Laptop</label>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <?php foreach($data['produk'] as $p) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-product p-3 text-center">
                        <img src="<?= $p['gambar'] ?>" class="img-fluid mb-2" style="height:150px; object-fit:contain;">
                        <h6 class="fw-bold"><?= $p['nama'] ?></h6>
                        <p class="text-danger fw-bold">Rp <?= number_format($p['harga'],0,',','.') ?></p>
                        <a href="<?= BASEURL ?>CartController/tambah/<?= $p['id'] ?>" class="btn btn-danger btn-sm">Beli Sekarang</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

```

**File: `app/views/user/keranjang.php**` (Tampilan Checkout - Screenshot 195)

```php
<div class="container mt-5">
    <h4 class="fw-bold">Detail Pesanan Anda</h4>
    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table align-middle">
            <thead class="table-light">
                <tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Total</th></tr>
            </thead>
            <tbody>
                <?php $total = 0; foreach($data['keranjang'] as $item) : 
                    $sub = $item['harga'] * $item['jumlah']; $total += $sub; ?>
                <tr>
                    <td><img src="<?= $item['gambar'] ?>" width="40"> <?= $item['nama'] ?></td>
                    <td>Rp <?= number_format($item['harga']) ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp <?= number_format($sub) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row mt-4">
        <div class="col-md-7">
            <div class="card p-3 shadow-sm">
                <h6 class="fw-bold">Metode Pembayaran</h6>
                <div class="form-check border p-2 rounded"><input class="form-check-input" type="radio" checked> Bayar di Toko (Cash)</div>
            </div>
        </div>
        <div class="col-md-5 text-center">
            <div class="card p-3 shadow-sm">
                <p class="mb-1">Total Pembayaran</p>
                <h2 class="text-danger fw-bold">Rp <?= number_format($total) ?></h2>
                <button class="btn btn-danger w-100">Buat Pesanan Sekarang</button>
            </div>
        </div>
    </div>
</div>

```

---

### **PENJELASAN SINGKAT **

1. **MVC Pattern:** Memisahkan data (Model), tampilan (View), dan logika (Controller) agar kode mudah dikelola.
2. **Routing Dinamis:** Menggunakan `App.php` untuk memetakan URL ke Controller tanpa perlu banyak file `.php` yang terpisah-pisah.
3. **Session Management:** Fitur login dan keranjang belanja dikelola melalui `$_SESSION` agar data tidak hilang saat pindah halaman.
4. **Database Driven:** Semua konten produk dan user diambil dari MySQL menggunakan `User_model` dan `Product_model`.
5. **User Experience:** Fitur "Beli Sekarang" langsung mengarahkan user ke halaman detail pesanan untuk mempercepat proses transaksi.

# berikut screenshot codingannya dan output dari USER

<img width="1366" height="658" alt="image" src="https://github.com/user-attachments/assets/4628050a-50e8-48bc-b0fe-d560ad163cdf" />

<img width="1366" height="646" alt="image" src="https://github.com/user-attachments/assets/2c4da0b3-6f71-489d-b650-f9eabe8ffa50" />

<img width="1366" height="672" alt="image" src="https://github.com/user-attachments/assets/be254d64-a9a3-4f99-983a-6e95e4bbf6db" />

<img width="1365" height="663" alt="image" src="https://github.com/user-attachments/assets/f243fa50-834e-4044-a20d-c0fe831d7fb3" />

<img width="1365" height="667" alt="image" src="https://github.com/user-attachments/assets/001f77ef-a9da-4222-80bd-ec256f94f51b" />

# berikut screenshot codingannya dan output dari ADMIN



