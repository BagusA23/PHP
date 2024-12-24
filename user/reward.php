<?php
session_start();
require_once "../functions/functions.php";
requireLogin();
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dana = $_POST['nama_dana'];
    $nomor_dana = $_POST['nomor_dana'];
    $reward_type = $_POST['reward_type'];
    $user = $_SESSION['user_id'];


    $stmt = $conn->prepare("INSERT INTO pengeluaran (id_user, nama_dana, nomor_dana,jumlah,tanggal) VALUES (?,?,?,?,NOW())");
    $stmt->bind_param("isss", $user, $nama_dana, $nomor_dana,$reward_type);
    // Eksekusi query
    if($stmt->execute()) {
        $success = "Laporan berhasil disimpan!";
    } else {
        $error = "Gagal menyimpan laporan: " . $stmt->error;
    }
    
    $_SESSION['message'] = "Klaim reward berhasil diajukan! Tim kami akan memproses dalam 1x24 jam.";
    header("Location: reward.php");
    exit();
}

// Konfigurasi Pagination
$batas_data = 10; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$posisi = ($halaman - 1) * $batas_data;

// Hitung total data
$query_total = "SELECT COUNT(*) AS total FROM pengeluaran";
$total_result = $conn->query($query_total);
$total_data = $total_result->fetch_assoc()['total'];
$total_halaman = ceil($total_data / $batas_data);

$stmt = $conn->prepare("SELECT pengeluaran.*, users.email
                                FROM pengeluaran
                                INNER JOIN users ON pengeluaran.id_user = users.id_user
                                LIMIT ?, ?");
$stmt->bind_param("ii", $posisi, $batas_data);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klaim Reward Dana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    
    <div class="container py-5">
        <!-- Success Message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <h1 class="text-center mb-5">Pilih Reward Dana</h1>
        
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            <!-- Dana 10.000 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="../assets/img/dana.jpg" class="card-img-top" alt="Dana 10.000">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Dana 10.000</h5>
                        <p class="card-text">Tukarkan 10.000 Saldo dengan saldo Dana 10.000</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">10000 Poin</span>
                            <button class="btn btn-primary" onclick="claimReward( 10000)">
                                <i class="bi bi-gift me-2"></i>Klaim
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dana 20.000 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="../assets/img/dana.jpg" class="card-img-top" alt="Dana 20.000">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Dana 20.000</h5>
                        <p class="card-text">Tukarkan 20.000 saldo dengan saldo Dana 20.000</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">20000 Poin</span>
                            <button class="btn btn-primary" onclick="claimReward( 20000)">
                                <i class="bi bi-gift me-2"></i>Klaim
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dana 50.000 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="../assets/img/dana.jpg" class="card-img-top" alt="Dana 50.000">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Dana 50.000</h5>
                        <p class="card-text">Tukarkan 50.000 dengan saldo Dana 50.000</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">50.000 Poin</span>
                            <button class="btn btn-primary" onclick="claimReward(50000)">
                                <i class="bi bi-gift me-2"></i>Klaim
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Claim Modal -->
        <div class="modal fade" id="claimModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Klaim Reward Dana</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="" method="post" id="claimForm">
                        <div class="modal-body">
                            <div id="rewardInfo" class="alert alert-info mb-3"></div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Pemilik Dana</label>
                                <input type="text" name="nama_dana" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nomor Dana</label>
                                <input type="tel" name="nomor_dana" class="form-control" required 
                                       minlength="10" maxlength="13" pattern="\d*">
                                <div class="form-text">Masukkan nomor Dana yang terdaftar (10-13 digit)</div>
                            </div>
                            
                            <input type="hidden" name="reward_type" id="reward_type">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="konfirm" class="btn btn-primary">Konfirmasi Klaim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Riwayat Klaim -->
        <div class="mt-5">
            <h2 class="mb-4">Riwayat Klaim</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Reward</th>
                            <th>Nomor Dana</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <td><?= $row['tanggal']; ?></td>
                            <td><?= "Rp ". number_format($row['jumlah'], 0, ',', '.') ?></td>   
                            <td><?= $row['Nomor_dana']; ?></td>
                            <td><?= $row['status']; ?></td>
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
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const claimModal = new bootstrap.Modal(document.getElementById('claimModal'));
        
        function claimReward(rewardType, points) {
            document.getElementById('rewardInfo').textContent = 
                `Anda akan menukarkan ${points} Saldo untuk ${rewardType}`;
            document.getElementById('reward_type').value = rewardType;
            claimModal.show();
        }

        // Simple form validation
        document.getElementById('claimForm').addEventListener('submit', function(e) {
            const nomorDana = this.elements['nomor_dana'].value;
            if (!/^\d{10,13}$/.test(nomorDana)) {
                e.preventDefault();
                alert('Nomor Dana harus berisi 10-13 digit angka');
            }
        });
    </script>
</body>
</html>