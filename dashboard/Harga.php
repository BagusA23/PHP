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

if(isset($_POST['simpan'])){
    global $conn; // Gunakan koneksi global
    $id = $_POST['id_kategori'] ?? 0;
    $jenis = $_POST['jenis'] ?? '';
    $harga_per_kg = $_POST['harga_per_kg'] ?? 0;

    // Validate input
    if (empty($id) || empty($jenis) || $harga_per_kg <= 0) {
        $_SESSION['error'] = "Gagal Mengupdate data";
        header('Location: Harga.php');
        exit;
    }

    // Prepare and execute SQL
    $stmt = $conn->prepare("UPDATE kategori_sampah SET jenis = ?, harga_per_kg = ? WHERE id_kategori = ?");
    $stmt->bind_param("sdi", $jenis, $harga_per_kg, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Harga Berhasil Diperbarui!";
    } else {
        $_SESSION['error'] = "Gagal memperbarui kategori sampah: " . $stmt->error;
    }

    $stmt->close();
    header('Location: Harga.php');
    exit;
}

requireAdmin();

$stmt = $conn->prepare("SELECT * FROM kategori_sampah");
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
                            <a class="nav-link" href="Laporan.php">
                                <i class="bi bi-flag-fill me-2"></i>
                                Laporan Sampah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Harga.php">
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

                <!-- Latest Reports -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between ">
                        <h5 class="mb-0">Harga Sampah</h5>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis sampah</th>
                                        <th>Harga Per Kg</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['jenis']; ?></td>
                                        <td><?= "Rp ". number_format($row['harga_per_kg'], 0, ',', '.') ?></td>                                        <td>
                                        <button class="btn btn-sm btn-primary me-1 edit-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal"
                                                data-id="<?= $row['id_kategori'] ?>"
                                                data-jenis="<?= $row['jenis'] ?>"
                                                data-harga="<?= $row['harga_per_kg'] ?>">
                                                <i class="bi bi-pencil"></i>
                                            </button>                                       
                                            <!-- <button class="btn btn-sm btn-danger delete-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal"
                                                data-id="<?= $row['id_kategori'] ?>"
                                                data-jenis="<?= $row['jenis'] ?>">
                                                <i class="bi bi-trash"></i>
                                            </button> -->
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
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Kategori Sampah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" id="edit-id_kategori" name="id_kategori">
                        <div class="mb-3">
                            <label for="edit-jenis" class="form-label">Jenis Sampah</label>
                            <input type="text" class="form-control" id="edit-jenis" name="jenis" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit-harga" class="form-label">Harga per Kg</label>
                            <input type="number" class="form-control" id="edit-harga" name="harga_per_kg" required min="0" step="0.01">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Konfirmasi Hapus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" id="delete-id" name="id">
                        <p>Apakah Anda yakin ingin menghapus kategori sampah: <strong id="delete-jenis"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Edit modal population script
        document.addEventListener('DOMContentLoaded', function() {
            const editBtns = document.querySelectorAll('.edit-btn');
            const deleteBtns = document.querySelectorAll('.delete-btn');

            editBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    document.getElementById('edit-id_kategori').value = this.dataset.id;
                    document.getElementById('edit-jenis').value = this.dataset.jenis;
                    document.getElementById('edit-harga').value = this.dataset.harga;
                });
            });

            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    document.getElementById('delete-id').value = this.dataset.id;
                    document.getElementById('delete-jenis').textContent = this.dataset.jenis;
                });
            });
        });
    </script>
</body>
</html>
