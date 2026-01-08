<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Detail Pesanan Anda</h4>
        <a href="<?= BASEURL; ?>UserController" class="text-danger text-decoration-none fw-bold">← Kembali Belanja</a>
    </div>

    <div class="table-responsive bg-white p-4 rounded shadow-sm mb-4">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                if(!empty($data['keranjang'])) : 
                    foreach($data['keranjang'] as $id => $item) : 
                        $subtotal = $item['harga'] * $item['jumlah'];
                        $total += $subtotal;
                ?>
                <tr>
                    <td>
                        <img src="<?= $item['gambar']; ?>" width="50" class="me-3 img-thumbnail">
                        <span class="fw-bold"><?= $item['nama']; ?></span>
                    </td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?= $item['jumlah']; ?></td>
                    <td class="fw-bold">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                    <td class="text-center">
                        <a href="<?= BASEURL; ?>CartController/hapus/<?= $id; ?>" class="text-danger fw-bold text-decoration-none">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; else : ?>
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">Keranjang masih kosong.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-4">Pilih Metode Pembayaran</h6>
                <div class="list-group">
                    <label class="list-group-item d-flex gap-3 p-3 mb-2 border rounded">
                        <input class="form-check-input flex-shrink-0" type="radio" name="pay" value="cash" checked>
                        <span>
                            <strong>Bayar di Toko (Cash)</strong>
                            <small class="d-block text-muted">Ambil barang dan bayar langsung di outlet terdekat.</small>
                        </span>
                    </label>
                    <label class="list-group-item d-flex gap-3 p-3 mb-2 border rounded">
                        <input class="form-check-input flex-shrink-0" type="radio" name="pay" value="qris">
                        <span>
                            <strong>QRIS (OVO, Dana, GoPay)</strong>
                            <small class="d-block text-muted">Scan kode QR secara otomatis untuk pembayaran instan.</small>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 text-center">
                <p class="text-muted mb-1">Total Pembayaran</p>
                <h2 class="text-danger fw-bold mb-4">Rp <?= number_format($total, 0, ',', '.'); ?></h2>
                <button class="btn btn-danger btn-lg w-100 py-3 fw-bold" <?= ($total == 0) ? 'disabled' : ''; ?>>
                    Buat Pesanan Sekarang
                </button>
            </div>
        </div>
    </div>
</div>