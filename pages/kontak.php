<?php
require_once "../functions/functions.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hubungi Kami - Bank Sampah</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <?php require "../includes/navbar.php"; 
    // Cek status login untuk menentukan konten yang ditampilkan
    requireLogin();
    ?>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Kontak Informasi</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="bi bi-envelope text-success me-2"></i>
                            <strong>Email:</strong> bank.sampah@example.com
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-telephone text-success me-2"></i>
                            <strong>Telepon:</strong> +62 123 4567 8900
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-geo-alt text-success me-2"></i>
                            <strong>Alamat:</strong> Jl. Lingkungan Hijau No. 42, Jakarta
                        </div>

                        <div class="map-placeholder bg-light p-4 rounded text-center">
                            Lokasi Peta
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Kirim Pesan</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea class="form-control" id="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "../includes/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>