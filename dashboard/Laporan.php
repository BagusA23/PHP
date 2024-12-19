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
$stmt = $conn->prepare("SELECT laporan.*, users.email
                                FROM laporan
                                INNER JOIN users ON laporan.id_user = users.id_user");
$stmt->execute();
$result = $stmt->get_result();

$i = 1;
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
                
                <!-- Latest Reports -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Laporan Terbaru</h5>
                        <button class="btn btn-sm btn-primary">
                            Lihat Semua
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Pelapor</th>
                                        <th>Lokasi</th>
                                        <th>Jenis</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['tanggal_laporan']; ?>></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['lokasi']; ?></td>
                                        <td><?= $row['jenis']; ?></td>
                                        <td><?='<img src="../pages/uploads/' . $row['gambar'] .' "height="50px" alt="Gambar Laporan">'; ?></td>
                                        <?php if($row['status'] == 'pending'): ?>
                                        <td>
                                            <span class="badge bg-danger">pending</span>
                                        </td>
                                        <?php elseif($row['status'] == 'in_progress'): ?>
                                        <td>
                                            <span class="badge bg-warning">in_progress</span>
                                        </td>
                                        <?php elseif($row['status'] == 'resolved'): ?>
                                        <td>
                                            <span class="badge bg-success">resolved</span>
                                        </td>
                                        <?php endif; ?>
                                        <td>
                                        <button class="btn btn-sm btn-info me-1 lihat-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#lihatModal"
                                                data-id="<?= $row['id_laporan'] ?>"
                                                data-email="<?= $row['email'] ?>"
                                                data-lokasi="<?= $row['lokasi'] ?>"
                                                data-jenis="<?= $row['jenis'] ?>"
                                                data-gambar="<?='../pages/uploads/' . $row['gambar']; ?>">
                                                <i class="bi bi-eye"></i>
                                            </button> 
                                            <button class="btn btn-sm btn-primary me-1"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- lihat Modal -->
    <div class="modal fade" id="lihatModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Detail Laporan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="readonly">
                        <input type="hidden" id="lihat-laporan" name="lihat">
                        <div class="mb-3">
                            <label for="edit-jenis" class="form-label">Pelapor</label>
                            <input type="text" class="form-control" id="lihat-email" name="email" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit-harga" class="form-label">lokasi</label>
                            <input type="text" class="form-control" id="lihat-lokasi" name="lokasi" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit-harga" class="form-label">jenis</label>
                            <input type="text" class="form-control" id="lihat-jenis" name="jenis" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit-harga" class="form-label">gambar</label>
                            <input type="image" class="form-control" id="lihat-gambar" name="gambar" readonly>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script>
        //edit modal
        document.addEventListener('DOMContentLoaded',function(){
            const lihatbtns = document.querySelectorAll('.lihat-btn');
            const editbtns = document.querySelectorAll('.editModal');
            const deletebtns = document.querySelectorAll('.deleteModal');

            lihatbtns.forEach(btn => {
                btn.addEventListener('click',function(){
                    document.getElementById('lihat-laporan').value = this.dataset.id;
                    document.getElementById('lihat-email').value = this.dataset.email;
                    document.getElementById('lihat-lokasi').value = this.dataset.lokasi;
                    document.getElementById('lihat-jenis').value = this.dataset.jenis;
                    document.getElementById('lihat-gambar').src = this.dataset.gambar
            });
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>