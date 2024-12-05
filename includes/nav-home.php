<?php require "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">
                <img src="<?php echo BASE_URL; ?>assets/img/Logo.png"  alt="Logo" width="30" height="30"> 
                Waste Management
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Menu Publik -->
    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>pages/about.php">Tentang Kami</a>
                    </li>
    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Edukasi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="jenis-sampah.php">Jenis Sampah</a></li>
                            <li><a class="dropdown-item" href="cara-pilah.php">Cara Memilah</a></li>
                            <li><a class="dropdown-item" href="daur-ulang.php">Daur Ulang</a></li>
                        </ul>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>pages/bank-sampah.php">Bank Sampah</a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>pages/lapor.php">Lapor Sampah</a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>pages/kontak.php">Kontak</a>
                    </li>
                </ul>
    
                <!-- Menu Login/Register -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i>
                            Admin
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>