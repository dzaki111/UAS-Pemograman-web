document.addEventListener('DOMContentLoaded', function () {
    // 1. Fitur Auto-Submit Filter
    // Saat user mencentang kategori, form akan otomatis terkirim tanpa klik tombol
    const filterCheckboxes = document.querySelectorAll('.form-check-input');
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            this.closest('form').submit();
        });
    });

    // 2. Notifikasi Tambah Keranjang
    // Memberikan feedback visual saat tombol beli/keranjang diklik
    const buyButtons = document.querySelectorAll('.btn-danger, .btn-outline-danger');
    buyButtons.forEach(button => {
        if (button.innerText.includes('Beli') || button.innerText.includes('Keranjang')) {
            button.addEventListener('click', function (e) {
                // Opsional: Anda bisa menggunakan library seperti SweetAlert2 di sini
                console.log('Produk berhasil ditambahkan ke aktivitas!');
            });
        }
    });

    // 3. Efek Zoom Sederhana pada Gambar Detail
    const detailImg = document.querySelector('.product-detail-img img');
    if (detailImg) {
        detailImg.addEventListener('mouseover', function () {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'all 0.3s ease';
        });
        detailImg.addEventListener('mouseout', function () {
            this.style.transform = 'scale(1)';
        });
    }
});