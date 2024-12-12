<?php
require_once "../functions/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/about.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php
require "../includes/navbar.php";?>

  <!-- Header Section -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Tentang Kami</h1>
            <p class="page-subtitle">Mengelola sampah untuk masa depan yang lebih baik</p>
        </div>
    </header>

    <!-- Vision Mission Section -->
    <section class="vision-mission">
        <div class="container">
            <h2 class="section-title">Visi & Misi</h2>
            <div class="vm-container">
                <div class="vm-card">
                    <h3>Visi</h3>
                    <p>Menjadi pusat pengelolaan sampah terdepan yang mendukung terciptanya lingkungan bersih dan berkelanjutan di Indonesia.</p>
                </div>
                <div class="vm-card">
                    <h3>Misi</h3>
                    <ul>
                        <li>Mengedukasi masyarakat tentang pentingnya pengelolaan sampah</li>
                        <li>Mengembangkan sistem bank sampah yang efektif dan efisien</li>
                        <li>Mendorong partisipasi aktif masyarakat dalam pengelolaan sampah</li>
                        <li>Menciptakan nilai ekonomi dari pengelolaan sampah</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- History Section -->
    <section class="history">
        <div class="container">
            <h2 class="section-title">Sejarah Kami</h2>
            <div class="timeline">
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <h3>2020</h3>
                        <p>Pendirian Bank Sampah sebagai respons terhadap permasalahan sampah di wilayah kami.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <h3>2021</h3>
                        <p>Pengembangan sistem manajemen sampah digital dan peluncuran program edukasi masyarakat.</p>
                    </div>
                </div>
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <h3>2022</h3>
                        <p>Perluasan jaringan dan kerjasama dengan berbagai komunitas dan institusi.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <h3>2023</h3>
                        <p>Implementasi teknologi terbaru dalam pengelolaan sampah dan pencapaian 1000+ anggota aktif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team">
        <div class="container">
            <h2 class="section-title">Tim Kami</h2>
            <div class="team-grid">
                <div class="team-card">
                    <img src="../assets/img/fo.jpg" height="500px" alt="Direktur" class="team-img">
                    <div class="team-info">
                        <h3 class="team-name">Bagus Ardiansyah</h3>
                        <p class="team-position">Direktur</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-card">
                    <img src="../assets/img/foto2.jpg" alt="Direktur" class="team-img">
                    <div class="team-info">
                        <h3 class="team-name">Fina Septia Anggraeni</h3>
                        <p class="team-position">Koordinator Bank-sampah</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-card" height="300px" >
                    <img src="../assets/img/foto3.jpg" alt="Manajer Operasional" class="team-img">
                    <div class="team-info">
                        <h3 class="team-name">Raka Valeriane</h3>
                        <p class="team-position">Manajer Operasional</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-card">
                    <img src="../assets/img/foto4.jpg" height="100px" alt="Koordinator Edukasi" class="team-img">
                    <div class="team-info">
                        <h3 class="team-name">Muhammad Azramadhana</h3>
                        <p class="team-position">Koordinator Edukasi</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
        <div class="container">
            <h2 class="section-title">Galeri Kegiatan</h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="../assets/img/about1.jpg" alt="Kegiatan 1" class="gallery-img">
                    <div class="gallery-caption">Sosialisasi Bank Sampah</div>
                </div>
                <div class="gallery-item">
                    <img src="../assets/img/about2.jpg" alt="Kegiatan 2" class="gallery-img">
                    <div class="gallery-caption">Pelatihan Daur Ulang</div>
                </div>
                <div class="gallery-item">
                    <img src="../assets/img/about3.jpg" alt="Kegiatan 3" class="gallery-img">
                    <div class="gallery-caption">Kerja Sama Komunitas</div>
                </div>
                <div class="gallery-item">
                    <img src="../assets/img/about4.jpg" alt="Kegiatan 4" class="gallery-img">
                    <div class="gallery-caption">Program Edukasi Sekolah</div>
                </div>
            </div>
        </div>
    </section>

<?php require "../includes/footer.php"; ?>  
<script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>