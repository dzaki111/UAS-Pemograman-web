<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 p-4">
                <h3 class="fw-bold mb-4">Tambah Produk Baru</h3>
                <form action="<?= BASEURL; ?>AdminController/proses_tambah" method="post">
                    <div class="mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Produk (Contoh: Vivo V50)" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="harga" class="form-control" placeholder="Harga (Angka saja)" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="gambar" class="form-control" placeholder="Link URL Foto" required>
                    </div>
                    <div class="mb-4">
                        <select name="kategori" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Smartphone">Smartphone</option>
                            <option value="Laptop">Laptop</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100 fw-bold mb-3">Simpan ke Katalog</button>
                    <div class="text-center">
                        <a href="<?= BASEURL; ?>AdminController" class="text-muted text-decoration-none small">Batal & Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>