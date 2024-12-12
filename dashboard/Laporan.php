<?php 
// Start session
session_start();

// Include necessary files
require_once "../includes/config.php";
require_once "../functions/functions.php";

// Check if user is logged in
if (!isset($_SESSION['sign'])) {
    header('Location: /php/user/login.php');
    exit;
}

requireAdmin();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bank Sampah Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 bg-white sidebar">
                <div class="d-flex flex-column">
                    <div class="text-center p-3 border-bottom">
                        <img src="../assets/img/Logo.png" alt="Logo" class="img-fluid mb-2" style="max-width: 100px;">
                        <h5>Bank Sampah Digital</h5>
                    </div>
                    <ul class="nav flex-column py-3">
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">
                                <i class="bi bi-grid-fill me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Kelola.php">
                                <i class="bi bi-people-fill me-2"></i>
                                Kelola Pengguna
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bank-sampah.php">
                                <i class="bi bi-recycle me-2"></i>
                                Bank Sampah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Laporan.php">
                                <i class="bi bi-flag-fill me-2"></i>
                                Laporan Sampah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Harga.php">
                                <i class="bi bi-cash-coin me-2"></i>
                                Harga Sampah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Transaksi.php">
                                <i class="bi bi-file-text-fill me-2"></i>
                                Laporan Transaksi
                            </a>
                        </li>
                        <li class="nav-item mt-auto">
                            <a class="nav-link text-danger" href="<?php echo $GLOBALS['base_url']; ?>/user/logout.php">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-3">
                <!-- Header -->
                <header class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                Admin
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?php echo $GLOBALS['base_url']; ?>/user/logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </header>

                <!-- Statistics Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card card-dashboard bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title mb-1">Total Pengguna</h6>
                                        <h2 class="mb-0"><?= totaluser(); ?></h2>
                                    </div>
                                    <div class="bg-white rounded-circle p-2">
                                        <i class="bi bi-people text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title mb-1">Total Sampah</h6>
                                        <h2 class="mb-0"><?= totalsampah(); ?></h2>
                                    </div>
                                    <div class="bg-white rounded-circle p-2">
                                        <i class="bi bi-recycle text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title mb-1">Pendapatan</h6>
                                        <h2 class="mb-0">Rp 5.2M</h2>
                                    </div>
                                    <div class="bg-white rounded-circle p-2">
                                        <i class="bi bi-cash-coin text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-dashboard bg-danger text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title mb-1">Laporan Pending</h6>
                                        <h2 class="mb-0"><?php totallapor2(); ?></h2>
                                    </div>
                                    <div class="bg-white rounded-circle p-2">
                                        <i class="bi bi-flag text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
