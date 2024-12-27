<?php
session_start();
require_once "../functions/functions.php";
$id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT setor_sampah.*, kategori_sampah.*
                                FROM setor_sampah 
                                INNER JOIN kategori_sampah ON setor_sampah.id_kategori = kategori_sampah.jenis 
                                WHERE setor_sampah.id_user = ?");
$stmt->bind_param('i',$id);
$stmt->execute();
$result = $stmt->get_result();
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
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <!-- Profil Header -->
                    <div class="card-header bg-success text-white py-4">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="card-title mb-1"><?= $_SESSION['email']; ?></h2>
                            </div>
                        </div>
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
                        <?php while($row = $result->fetch_assoc()): ?>
                            <?php $timestamp = $row['tanggal_setoran'];
                                setlocale(LC_TIME, 'id_ID');
                                $tanggal = date("d F Y ", strtotime($timestamp));?>
                        <!-- Transaksi Item -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bi bi-clock me-2 text-muted"></i>
                                        <small class="text-muted"><?= $tanggal; ?></small>
                                    </div>
                                    <h6 class="mb-1"><?= $row['jenis'] ?></h6>
                                    <p class="mb-1 small text-muted"><?= $row['berat'].' Kg dan Rp ' . number_format($row['total_harga'], 0, ',', '.');?></p>
                                    <?php if($row['status'] == 'pending'): ?>
                                    <td>
                                        <span class="badge bg-danger">pending</span>
                                    </td>
                                    <?php elseif($row['status'] == 'proses'): ?>
                                    <td>
                                        <span class="badge bg-warning">proses</span>
                                    </td>
                                    <?php elseif($row['status'] == 'selesai'): ?>
                                    <td>
                                        <span class="badge bg-success">selesai</span>
                                    </td>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endwhile; ?>
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