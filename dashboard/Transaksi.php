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
// Konfigurasi Pagination
$batas_data = 10; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$id = $_SESSION['user_id'];
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
$stmt->bind_param("ii",$posisi, $batas_data);
$stmt->execute();
$result = $stmt->get_result();

//set status harus sama dengan di databases
$statusus = ['pending', 'selesai', 'batal'];

if (isset($_POST['simpan'])) {
    global $conn;
    $id = $_POST['id_pengeluaran'];
    $status = $_POST['status'];

    if (in_array($status, $statusus)) {
        $stmt = $conn->prepare("UPDATE pengeluaran SET status = ? WHERE id_pengeluaran = ?");
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Status berhasil diperbarui.";
        } else {
            $_SESSION['error'] = "Gagal memperbarui status: " . $conn->error;
        }
        
        // Redirect with URL parameters to maintain pagination
        $current_page = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
        header("Location: " . $_SERVER['PHP_SELF'] . "?halaman=" . $current_page);
        exit();
    } else {
        $_SESSION['error'] = "Status tidak valid.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if(isset($_POST['hapus'])){
    global $conn;
    $id = $_POST['id_pengeluaran']; //mengambil id_pengeluaran

    $stmt = $conn->prepare("DELETE FROM pengeluaran WHERE id_pengeluaran = ?");
    $stmt->bind_param('i',$id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Berhasil Menghapus Data .";
    } else {
        $_SESSION['error'] = "Gagal menghapus data: " . $conn->error;
    }
    
    // Redirect with URL parameters to maintain pagination
    $current_page = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
    header("Location: " . $_SERVER['PHP_SELF'] . "?halaman=" . $current_page);
    exit();
}
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
                            <a class="nav-link active" href="Transaksi.php">
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
                 <!-- Flasher messages -->
                <div class="flash-messages">
                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $_SESSION['success'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['error'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                </div>
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
                 <!-- Riwayat Klaim -->
                 <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Reward bank-sampah</h5>
                        <button class="btn btn-sm btn-primary">
                            Lihat Semua
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pengguna</th>
                                    <th>Reward</th>
                                    <th>Nomor Dana</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tbody>
                                <tr>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= "Rp ". number_format($row['jumlah'], 0, ',', '.') ?></td>   
                                    <td><?= $row['Nomor_dana']; ?></td>
                                    <?php if($row['status'] == 'batal'): ?>
                                        <td>
                                        <span class="badge bg-danger">batal</span>
                                        </td>
                                    <?php elseif($row['status'] == 'pending'): ?>
                                        <td>
                                            <span class="badge bg-warning">pending</span>
                                        </td>
                                    <?php elseif($row['status'] == 'selesai'): ?>
                                        <td>
                                            <span class="badge bg-success">selesai</span>
                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <button class="btn btn-sm btn-info me-1 lihat-btn"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#lihatModal"
                                            data-id="<?= $row['id_pengeluaran']; ?>"
                                            data-email="<?= $row['email']; ?>"
                                            data-nomor_dana="<?= $row['Nomor_dana']; ?>"
                                            data-jumlah="<?= $row['jumlah']; ?>">
                                            <i class="bi bi-eye"></i>
                                        </button> 
                                        <button class="btn btn-sm btn-primary me-1 edit-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal"
                                            data-id="<?= $row['id_pengeluaran']; ?>"
                                            data-email="<?= $row['email']; ?>"
                                            data-nomor_dana="<?= $row['Nomor_dana']; ?>"
                                            data-jumlah="<?= $row['jumlah']; ?>"
                                            data-status="<?= $row['status']; ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>  
                                        <button class="btn btn-sm btn-danger me-1 delete-btn"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal"
                                            data-id="<?= $row['id_pengeluaran']; ?>"
                                            data-email="<?= $row['email']; ?>"
                                            data-nomor_dana="<?= $row['Nomor_dana']; ?>"
                                            data-jumlah="<?= $row['jumlah']; ?>" >
                                            <i class="bi bi-trash"></i>
                                        </button>                                        
                                    </td>
                                </tr>
                            </tbody>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            </div>
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
            <!-- lihat Modal -->
            <div class="modal fade" id="lihatModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel">Detail Reward</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                <input type="hidden" name="action" value="readonly">
                                <input type="hidden" id="lihat-pengeluaran" name="lihat">
                                <div class="mb-3">
                                    <label for="edit-jenis" class="form-label">Pengguna</label>
                                    <input type="text" class="form-control" id="lihat-email" name="email" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-harga" class="form-label">Reward</label>
                                    <input type="number" class="form-control" id="lihat-Reward" name="Reward" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-harga" class="form-label">Nomor</label>
                                    <input type="number" class="form-control" id="lihat-Nomor" name="Nomor" readonly>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel">Detail Reward</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post" >
                            <div class="modal-body">
                                <input type="hidden" name="id_pengeluaran" id="edit-pengeluaran">
                                <div class="mb-3">
                                    <label for="edit-jenis" class="form-label">Pengguna</label>
                                    <input type="text" class="form-control" id="edit-email" name="email" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-harga" class="form-label">Reward</label>
                                    <input type="number" class="form-control" id="edit-Reward" name="Reward" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-harga" class="form-label">Nomor</label>
                                    <input type="number" class="form-control" id="edit-Nomor" name="Nomor" readonly>
                                </div>
                                <select name="status" class="form-select" id="status" aria-label="Default select example">
                                <?php foreach($statusus as $status): ?>
                                    <option value="<?= $status ?>"><?= $status ?></option>
                                <?php endforeach; ?>
                                </select>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="simpan"  class="btn btn-primary">selesai transaksi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Konfirmasi Hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <!-- Hidden inputs -->
                                <input type="hidden" name="id_pengeluaran" id="delete-pengeluaran">
                                <input type="hidden" class="form-control" id="delete-email" name="email" readonly>
                                <input type="hidden" class="form-control" id="delete-Reward" name="Reward" readonly>
                                <input type="hidden" class="form-control" id="delete-Nomor" name="Nomor" readonly>
                        
                        <div class="modal-body">
                            <p class="text-center mb-0">Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <button type="submit" name="hapus" class="btn btn-danger">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded',function(){
                const lihatbtns = document.querySelectorAll('.lihat-btn');
                const editbtns = document.querySelectorAll('.edit-btn');
                const deletebtns = document.querySelectorAll('.delete-btn');

                lihatbtns.forEach(btn => {
                    btn.addEventListener('click',function(){
                    document.getElementById('lihat-pengeluaran').value = this.dataset.id;
                    document.getElementById('lihat-email').value = this.dataset.email;
                    document.getElementById('lihat-Reward').value = this.dataset.jumlah;
                    document.getElementById('lihat-Nomor').value = this.dataset.nomor_dana;
                    });
                });
                editbtns.forEach(btn => {
                    btn.addEventListener('click',function(){
                        document.getElementById('edit-pengeluaran').value = this.dataset.id;
                        document.getElementById('edit-email').value = this.dataset.email;
                        document.getElementById('edit-Reward').value = this.dataset.jumlah;
                        document.getElementById('edit-Nomor').value = this.dataset.nomor_dana;
                        document.getElementById('status').value = this.dataset.status;
                    });
                });
                deletebtns.forEach(btn => {
                    btn.addEventListener('click',function(){
                        document.getElementById('delete-pengeluaran').value = this.dataset.id;
                        document.getElementById('delete-email').value = this.dataset.email;
                        document.getElementById('delete-Reward').value = this.dataset.jumlah;
                        document.getElementById('delete-Nomor').value = this.dataset.nomor_dana;
                    })
                });
                setTimeout(function() {
                    const flashMessages = document.querySelectorAll('.alert');
                    flashMessages.forEach(function(message) {
                        const alert = new bootstrap.Alert(message);
                        alert.close();
                    });
                }, 5000);
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</div>
</div>
</div>
</body>
</html>