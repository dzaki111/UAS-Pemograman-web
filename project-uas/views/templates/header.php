<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>../css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="<?= BASEURL; ?>UserController">E-STORE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-dark text-white px-3 me-2" href="<?= BASEURL; ?>CartController">
                <i class="bi bi-cart"></i> Keranjang
            </a>
        </li>
        <li class="nav-item">
            <span class="text-white me-2">Halo, <strong><?= $_SESSION['username']; ?></strong></span>
            <a class="btn btn-sm btn-outline-light" href="<?= BASEURL; ?>AuthController/logout">Keluar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>