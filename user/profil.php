<?php
session_start();
require_once "../functions/functions.php";
// Proses upload foto jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['foto'])) {
    // Pastikan user sudah login
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Silakan login terlebih dahulu.');</script>";
        exit();
    }

    // Panggil fungsi upload
    $user_id = $_SESSION['user_id'];
    uploadFotoProfil($user_id, $_FILES['foto']);
}


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Bank Sampah</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid white;
        }
        .upload-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            transform: translate(25%, 25%);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <!-- Profil Header -->
                    <div class="card-header bg-success text-white py-4">
                        <form action="" method="post">
                        <div class="d-flex align-items-center">
                            <div class="position-relative me-4">
                                <img 
                                    src="https://via.placeholder.com/150" 
                                    alt="Foto Profil" 
                                    class="rounded-circle profile-img"
                                >
                                <label name="foto" for="foto-profil" class="btn btn-primary btn-sm rounded-circle upload-btn">
                                    <i class="bi bi-camera"></i>
                                    <input 
                                        type="file" 
                                        id="foto-profil"
                                        class="d-none" 
                                        accept="image/*"
                                        onchange="this.form.submit()">
                                </label>
                            </div>
                            <div>
                                <h2 class="card-title mb-1"><?= $_SESSION['email']; ?></h2>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Statistik -->
                    <div class="card-body bg-light">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Saldo</h6>
                                        <p class="card-text h5 text-success"><?= totalsaldo(); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Total Setor</h6>
                                        <p class="card-text h5 text-primary"><?= totalsampahuser(); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat Transaksi -->
                    <div class="card-body">
                        <h5 class="card-title mb-3">Riwayat Bank Sampah</h5>
                        
                        <!-- Transaksi Item -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bi bi-clock me-2 text-muted"></i>
                                        <small class="text-muted">15 Februari 2024</small>
                                    </div>
                                    <h6 class="mb-1">Sampah Organik</h6>
                                    <p class="mb-1 small text-muted">5.5 kg - Rp 55.000</p>
                                    <span class="badge bg-success">Selesai</span>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bi bi-clock me-2 text-muted"></i>
                                        <small class="text-muted">20 Maret 2024</small>
                                    </div>
                                    <h6 class="mb-1">Sampah Anorganik</h6>
                                    <p class="mb-1 small text-muted">3.2 kg - Rp 16.000</p>
                                    <span class="badge bg-warning">Diproses</span>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, if you need dropdowns, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>