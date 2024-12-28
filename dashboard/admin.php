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
// Konfigurasi Pagination
$batas_data = 10; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$posisi = ($halaman - 1) * $batas_data;

// Hitung total data
$query_total = "SELECT COUNT(*) AS total FROM setor_sampah";
$total_result = $conn->query($query_total);
$total_data = $total_result->fetch_assoc()['total'];
$total_halaman = ceil($total_data / $batas_data);

// Query dengan pagination
$stmt = $conn->prepare("SELECT setor_sampah.*, users.email, kategori_sampah.jenis
                        FROM setor_sampah 
                        INNER JOIN users ON setor_sampah.id_user = users.id_user
                        INNER JOIN kategori_sampah ON setor_sampah.id_kategori = kategori_sampah.jenis
                        LIMIT ?, ?");
$stmt->bind_param("ii", $posisi, $batas_data);
$stmt->execute();
$result = $stmt->get_result();
$i = 1;

// Konfigurasi Pagination
$batas_data1 = 10; // Jumlah data per halaman
$halaman1 = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$posisi1 = ($halaman1 - 1) * $batas_data1;

// Hitung total data
$query_total1 = "SELECT COUNT(*) AS total FROM laporan";
$total_result1 = $conn->query($query_total1);
$total_data1 = $total_result1->fetch_assoc()['total'];
$total_halaman1 = ceil($total_data1 / $batas_data1);

$stmt1 = $conn->prepare("SELECT laporan.*, users.email
                                FROM laporan
                                INNER JOIN users ON laporan.id_user = users.id_user
                                LIMIT ?, ?");
$stmt1->bind_param("ii", $posisi1, $batas_data1);
$stmt1->execute();
$result1 = $stmt1->get_result();
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
                            <a class="nav-link active" href="admin.php">
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
                            <a class="nav-link" href="Laporan.php">
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
                                    <h6 class="card-title mb-1">Total Reward</h6>
                                    <h2 class="mb-0"><?= reward(); ?></h2>
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
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($row1 = $result1->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row1['tanggal_laporan']; ?></td>
                                        <td><?= $row1['email']; ?></td>
                                        <td><?= $row1['lokasi']; ?></td>
                                        <td><?= $row1['jenis']; ?></td>
                                        <td><?='<img src="../pages/uploads/' . $row1['gambar'] .' "height="50px" alt="Gambar Laporan">'; ?></td>
                                        <?php if($row1['status'] == 'pending'): ?>
                                        <td>
                                            <span class="badge bg-danger">pending</span>
                                        </td>
                                        <?php elseif($row1['status'] == 'in progress'): ?>
                                        <td>
                                            <span class="badge bg-warning">in_progress</span>
                                        </td>
                                        <?php elseif($row1['status'] == 'resolved'): ?>
                                        <td>
                                            <span class="badge bg-success">resolved</span>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                            <div class="pagination d-flex justify-content-center mt-3">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php 
                                        // Tombol Previous
                                        if($halaman1 > 1){
                                            echo "<li class='page-item'><a class='page-link' href='?halaman=".($halaman1-1)."'>Previous</a></li>";
                                        }

                                        // Nomor halaman
                                        for($x = 1; $x <= $total_halaman1; $x++){
                                            $active = ($x == $halaman1) ? 'active' : '';
                                            echo "<li class='page-item $active'><a class='page-link' href='?halaman=$x'>$x</a></li>";
                                        }

                                        // Tombol Next
                                        if($halaman1 < $total_halaman1){
                                            echo "<li class='page-item'><a class='page-link' href='?halaman=".($halaman1+1)."'>Next</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- bank sampah-->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Bank-sampah</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Pengguna</th>
                                        <th>Jenis Sampah</th>
                                        <th>Berat</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <?php $idSetor = $row['id_setor']; ?>
                                        <td><?= $row['tanggal_setoran']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['jenis']; ?></td>
                                        <td><?= $row['berat']; ?></td>
                                        <td><?= "Rp ". number_format($row['total_harga'], 0, ',', '.') ?></td>  
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
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                            <div class="pagination d-flex justify-content-center mt-3">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php 
                                        // Tombol Previous
                                        if($halaman > 1){
                                            echo "<li class='page-item'><a class='page-link' href='?halaman=".($halaman-1)."'>Previous</a></li>";
                                        }

                                        // Nomor halaman
                                        for($x = 1; $x <= $total_halaman; $x++){
                                            $active = ($x == $halaman) ? 'active' : '';
                                            echo "<li class='page-item $active'><a class='page-link' href='?halaman=$x'>$x</a></li>";
                                        }

                                        // Tombol Next
                                        if($halaman < $total_halaman){
                                            echo "<li class='page-item'><a class='page-link' href='?halaman=".($halaman+1)."'>Next</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>