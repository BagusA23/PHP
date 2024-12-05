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
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127504.42584789766!2d104.680391406905!3d-2.9549654867335358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b75e8fc27a3e3%3A0x3039d80b220d0c0!2sPalembang%2C%20Kota%20Palembang%2C%20Sumatera%20Selatan!5e0!3m2!1sid!2sid!4v1733367387134!5m2!1sid!2sid" width="550" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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