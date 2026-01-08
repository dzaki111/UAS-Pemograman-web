<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASEURL; ?>UserController">Home</a></li>
            <li class="breadcrumb-item active"><?= $data['p']['nama']; ?></li>
        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-md-6 text-center">
            <img src="<?= BASEURL_IMG; ?><?= $data['p']['gambar']; ?>" class="img-fluid shadow-sm p-4" style="max-height: 400px;">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold"><?= $data['p']['nama']; ?></h2>
            <p class="text-primary small">• Bebas Ongkir • Stok Terbatas</p>
            <h3 class="text-danger fw-bold mb-4">Rp <?= number_format($data['p']['harga'], 0, ',', '.'); ?></h3>
            
            <div class="d-flex gap-2">
                <a href="<?= BASEURL; ?>CartController/tambah/<?= $data['p']['id']; ?>" class="btn btn-danger btn-lg px-5">Beli Langsung</a>
                <a href="<?= BASEURL; ?>CartController/tambah/<?= $data['p']['id']; ?>" class="btn btn-outline-danger btn-lg">+ Keranjang</a>
            </div>
        </div>
    </div>
</div>