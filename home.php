<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php
include "./includes/nav-home.php";
?>

    <!-- Banner Carousel -->
<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <!-- Indicators/dots -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./assets/img/back1.jpg" alt="Slide 1" class="d-block w-100">
            <div class="carousel-caption">
                <h2>Kelola Sampah dengan Bijak</h2>
                <p>Mari bersama menjaga lingkungan untuk masa depan yang lebih baik.</p>
                <a href="register.php" class="btn btn-success btn-lg">Bergabung Sekarang</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/img/back2.jpg" alt="Slide 2" class="d-block w-100">
            <div class="carousel-caption">
                <h2>Bank Sampah</h2>
                <p>Ubah sampahmu menjadi penghasilan tambahan.</p>
                <a href="bank-sampah.php" class="btn btn-success btn-lg">Mulai Sekarang</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/img/back3.jpg" alt="Slide 3" class="d-block w-100">
            <div class="carousel-caption">
                <h2>Edukasi Pengelolaan Sampah</h2>
                <p>Pelajari cara mengelola sampah dengan benar.</p>
                <a href="edukasi.php" class="btn btn-success btn-lg">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
<!-- Statistik Sederhana -->
<section class="statistics bg-light py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-box">
                    <i class="fas fa-users mb-3 text-success" style="font-size: 2rem;"></i>
                    <h3>1,234</h3>
                    <p>Total Nasabah</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-box">
                    <i class="fas fa-recycle mb-3 text-success" style="font-size: 2rem;"></i>
                    <h3>5,678 kg</h3>
                    <p>Sampah Terkelola</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-box">
                    <i class="fas fa-check-circle mb-3 text-success" style="font-size: 2rem;"></i>
                    <h3>234</h3>
                    <p>Laporan Selesai</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-box">
                    <i class="fas fa-building mb-3 text-success" style="font-size: 2rem;"></i>
                    <h3>56</h3>
                    <p>Bank Sampah</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Program Unggulan -->
<section class="featured-programs bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Program Unggulan</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                    <i class="fas fa-building text-success mb-3" style="font-size: 3rem;"></i>
                        <h4>Bank Sampah</h4>
                        <p>Mengubah sampah menjadi penghasilan tambahan melalui program bank sampah.</p>
                        <a href="bank-sampah.php" class="btn btn-outline-success">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-book text-success mb-3" style="font-size: 3rem;"></i>
                        <h4>Edukasi</h4>
                        <p>Program edukasi pengelolaan sampah untuk masyarakat umum.</p>
                        <a href="edukasi.php" class="btn btn-outline-success">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-hands-helping text-success mb-3" style="font-size: 3rem;"></i>
                        <h4>Lapor Sampah</h4>
                        <p>Laporkan tumpukan sampah di sekitarmu untuk ditindaklanjuti.</p>
                        <a href="laporan.php" class="btn btn-outline-success">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "./includes/footer.php"?>
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</body>
</html>