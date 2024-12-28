<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- bagian akhir dari index.php -->
    <footer class="site-footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">
                    <!-- Informasi Kontak -->
                    <div class="footer-section">
                        <h3>Kontak Kami</h3>
                        <ul class="contact-info">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Jl. Contoh No. 123, Kota, Provinsi</span>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <span>+62 123 4567 890</span>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <span>info@banksampah.com</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Menu Cepat -->
                    <div class="footer-section">
                        <h3>Menu Cepat</h3>
                        <ul class="quick-links">
                            <li><a href="<?php echo $GLOBALS['base_url']; ?>/pages/about.php">Tentang Kami</a></li>
                            <li><a href="<?php echo $GLOBALS['base_url']; ?>/pages/bank-sampah.php">Bank Sampah</a></li>
                            <li><a href="<?php echo $GLOBALS['base_url']; ?>/pages/Education.php">Edukasi</a></li>
                            <li><a href="<?php echo $GLOBALS['base_url']; ?>/pages/lapor.php">Lapor Sampah</a></li>
                            <!-- <?php if(isset($_SESSION['sign']) && $_SESSION['sign'] === true): ?>
                            <li><a href="<?php echo $GLOBALS['base_url']; ?>/pages/kontak.php">Kontak</a></li>
                            <?php endif; ?> -->
                        </ul>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="footer-section">
                        <h3>Jam Operasional</h3>
                        <ul class="operation-hours">
                            <li>
                                <span class="day">Senin - Jumat:</span>
                                <span class="hours">08:00 - 16:00</span>
                            </li>
                            <li>
                                <span class="day">Sabtu:</span>
                                <span class="hours">08:00 - 13:00</span>
                            </li>
                            <li>
                                <span class="day">Minggu:</span>
                                <span class="hours">Tutup</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div class="footer-section">
                        <h3>Media Sosial</h3>
                        <div class="social-links">
                            <a href="https://facebook.com/" target="_blank" class="social-link">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://instagram.com/" target="_blank" class="social-link">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://twitter.com/" target="_blank" class="social-link">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://youtube.com/" target="_blank" class="social-link">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p class="copyright">
                        &copy; <?php echo date('Y'); ?> Bank Sampah. Hak Cipta Dilindungi.
                    </p>
                    <div class="footer-links">
                        <a href="#">Kebijakan Privasi</a>
                        <a href="#">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
        <!-- Scripts -->
    <script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>