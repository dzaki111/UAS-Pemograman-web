<div class="d-flex">
    <div class="bg-dark text-white p-4" style="min-width: 250px; min-height: 100vh;">
        <h4 class="fw-bold mb-5 text-uppercase" style="color: #ff4d4d;">E-STORE ADMIN</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="<?= BASEURL; ?>AdminController" class="nav-link text-white bg-secondary rounded p-2">
                    <i class="bi bi-box-seam me-2"></i> Data Produk
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASEURL; ?>AuthController/logout" class="nav-link text-white-50 p-2">
                    <i class="bi bi-box-arrow-left me-2"></i> Keluar
                </a>
            </li>
        </ul>
    </div>

    <div class="flex-grow-1 p-5 bg-light">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Manajemen Produk</h2>
            <a href="<?= BASEURL; ?>AdminController/tambah_halaman" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Tambah Barang
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-danger">
                        <tr>
                            <th class="ps-4">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['produk'] as $p) : ?>
                        <tr>
                            <td class="ps-4">
                                <img src="<?= $p['gambar']; ?>" width="50" class="img-thumbnail">
                            </td>
                            <td class="fw-semibold"><?= $p['nama']; ?></td>
                            <td><span class="badge bg-secondary opacity-75"><?= $p['kategori']; ?></span></td>
                            <td class="text-dark">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <a href="<?= BASEURL; ?>AdminController/hapus/<?= $p['id']; ?>" 
                                   class="text-danger text-decoration-none fw-bold"
                                   onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>