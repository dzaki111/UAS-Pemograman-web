<div class="col-md-4 mb-4">
    <div class="card h-100 shadow-sm p-2">
        <div class="img-container">
            <img src="<?= BASEURL; ?>../img/<?= $p['gambar']; ?>" alt="<?= $p['nama']; ?>">
        </div>
        <div class="card-body">
            <h6 class="card-title fw-bold text-dark"><?= $p['nama']; ?></h6>
            <p class="text-danger fw-bold mb-3">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
            <div class="d-grid gap-2">
                <a href="<?= BASEURL; ?>UserController/detail/<?= $p['id']; ?>" class="btn btn-outline-danger btn-sm">Detail</a>
                <a href="<?= BASEURL; ?>CartController/tambah/<?= $p['id']; ?>" class="btn btn-danger btn-sm">Beli Sekarang</a>
            </div>
        </div>
    </div>
</div>