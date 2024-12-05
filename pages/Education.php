<?php
require_once "../functions/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php
require "../includes/navbar.php";?>
        <section id="jenis" >
        <!-- Header -->
        <div class="bg-success text-white py-5">
        <div class="container">
            <h1 class="text-center">Jenis-Jenis Sampah</h1>
            <p class="text-center lead">Kenali berbagai jenis sampah untuk pengelolaan yang lebih baik</p>
        </div>
    </div>

    <!-- Content -->
    <div class="container my-5">
        <div class="row g-4">
            <!-- Sampah Organik -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <img src="../assets/img/organik.jpg" class="card-img-top" alt="Sampah Organik">
                    <div class="card-body">
                        <h5 class="card-title text-success">Sampah Organik</h5>
                        <p class="card-text">Sampah organik adalah sampah yang berasal dari sisa makhluk hidup yang mudah terurai secara alami tanpa proses campur tangan manusia.</p>
                        <h6>Contoh:</h6>
                        <ul>
                            <li>Sisa makanan</li>
                            <li>Daun-daunan</li>
                            <li>Ranting pohon</li>
                            <li>Kulit buah dan sayur</li>
                        </ul>
                        <div class="mt-3">
                            <h6>Manfaat:</h6>
                            <ul>
                                <li>Dapat dijadikan kompos</li>
                                <li>Menyuburkan tanah</li>
                                <li>Ramah lingkungan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sampah Anorganik -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <img src="../assets/img/anorganik.jpg" class="card-img-top" alt="Sampah Anorganik">
                    <div class="card-body">
                        <h5 class="card-title text-success">Sampah Anorganik</h5>
                        <p class="card-text">Sampah anorganik adalah sampah yang tidak mudah terurai secara alami dan memerlukan waktu yang sangat lama untuk dapat terurai.</p>
                        <h6>Contoh:</h6>
                        <ul>
                            <li>Plastik</li>
                            <li>Kaleng</li>
                            <li>Kaca</li>
                            <li>Kertas</li>
                        </ul>
                        <div class="mt-3">
                            <h6>Penanganan:</h6>
                            <ul>
                                <li>Dapat didaur ulang</li>
                                <li>Dijual ke bank sampah</li>
                                <li>Dibuat kerajinan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sampah B3 -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <img src="../assets/img/b3.png" class="card-img-top" alt="Sampah B3">
                    <div class="card-body">
                        <h5 class="card-title text-success">Sampah B3 (Bahan Berbahaya dan Beracun)</h5>
                        <p class="card-text">Sampah B3 adalah sampah yang mengandung bahan berbahaya dan beracun yang dapat membahayakan makhluk hidup dan lingkungan.</p>
                        <h6>Contoh:</h6>
                        <ul>
                            <li>Baterai bekas</li>
                            <li>Lampu neon</li>
                            <li>Limbah medis</li>
                            <li>Kemasan pestisida</li>
                        </ul>
                        <div class="mt-3">
                            <h6>Peringatan:</h6>
                            <ul>
                                <li>Perlu penanganan khusus</li>
                                <li>Jangan dicampur sampah lain</li>
                                <li>Bahaya bagi lingkungan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-success text-white py-5">
        <div class="container">
            <h1 class="text-center">Panduan Pemilahan Sampah</h1>
            <p class="text-center lead">Pelajari cara memilah sampah dengan benar untuk lingkungan yang lebih baik</p>
        </div>
    </div>
    </section>
    <!-- Content -->
    <section id="pemilah" >
    <div  class="container my-5">
        <!-- Panduan Pemilahan -->
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <iframe src="https://www.youtube.com/embed/4VOCL5JKlEg?si=PSgAtatjdjgc4p7O" class="img-fluid rounded shadow" frameborder="2"></iframe>
            </div>
            <div class="col-lg-6">
                <h2 class="text-success mb-4">Langkah-langkah Pemilahan Sampah</h2>
                <div class="accordion shadow" id="accordionPanduan">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                1. Siapkan Tempat Sampah Terpisah
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionPanduan">
                            <div class="accordion-body">
                                Sediakan minimal 3 tempat sampah berbeda untuk:
                                <ul>
                                    <li>Sampah organik (warna hijau)</li>
                                    <li>Sampah anorganik (warna kuning)</li>
                                    <li>Sampah B3 (warna merah)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                2. Kenali Jenis Sampah
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionPanduan">
                            <div class="accordion-body">
                                <ul>
                                    <li>Perhatikan komposisi bahan</li>
                                    <li>Cek logo daur ulang</li>
                                    <li>Perhatikan karakteristik sampah</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                3. Bersihkan Sampah
                            </button>
                        </h3>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionPanduan">
                            <div class="accordion-body">
                                <ul>
                                    <li>Cuci kontainer bekas makanan</li>
                                    <li>Keringkan sebelum dibuang</li>
                                    <li>Pisahkan komponen berbeda</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips & Trik -->
        <h2 class="text-center text-success mb-4">Tips & Trik Pemilahan Sampah</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title text-success">Tips Sampah Organik</h5>
                        <ul class="card-text">
                            <li>Pisahkan sampah basah dan kering</li>
                            <li>Manfaatkan untuk kompos</li>
                            <li>Hindari tercampur plastik</li>
                            <li>Gunakan wadah berlubang</li>
                            <li>Buang secara rutin</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title text-success">Tips Sampah Anorganik</h5>
                        <ul class="card-text">
                            <li>Lipat karton dan kardus</li>
                            <li>Pisahkan berdasarkan jenis</li>
                            <li>Bersihkan sebelum dibuang</li>
                            <li>Simpan di tempat kering</li>
                            <li>Kumpulkan hingga cukup banyak</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title text-success">Tips Sampah B3</h5>
                        <ul class="card-text">
                            <li>Simpan di wadah tertutup</li>
                            <li>Jauhkan dari jangkauan anak</li>
                            <li>Serahkan ke pengelola khusus</li>
                            <li>Gunakan sarung tangan</li>
                            <li>Jangan membakar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section>
           <!-- Header -->
    <div class="bg-success text-white py-5">
        <div class="container">
            <h1 class="text-center">Daur Ulang Sampah</h1>
            <p class="text-center lead">Pelajari cara mendaur ulang sampah dan manfaatnya bagi lingkungan</p>
        </div>
    </div>

    <!-- Content -->
    <div class="container my-5">
    <!-- Tutorial Sederhana -->
    <h2 class="text-center text-success mb-4">Tutorial Daur Ulang Sederhana</h2>
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow">
                <img src="/api/placeholder/800/400" class="card-img-top" alt="Ecobrick">
                <div class="card-body">
                    <h5 class="card-title text-success">Ecobrick</h5>
                    <p class="card-text">Membuat bata ramah lingkungan dari botol plastik bekas.</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ecobrickModal">
                        Lihat Tutorial
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow">
                <img src="../assets/img/compos.jpg" class="card-img-top" alt="Kompos">
                <div class="card-body">
                    <h5 class="card-title text-success">Kompos</h5>
                    <p class="card-text">Mengolah sampah organik menjadi pupuk kompos.</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#komposModal">
                        Lihat Tutorial
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow">
                <img src="/api/placeholder/800/400" class="card-img-top" alt="Kerajinan">
                <div class="card-body">
                    <h5 class="card-title text-success">Kerajinan</h5>
                    <p class="card-text">Membuat kerajinan dari berbagai sampah anorganik.</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#kerajinanModal">
                        Lihat Tutorial
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow">
                <img src="/api/placeholder/800/400" class="card-img-top" alt="Pengolahan Limbah">
                <div class="card-body">
                    <h5 class="card-title text-success">Pengolahan Limbah</h5>
                    <p class="card-text">Mengolah limbah menjadi produk yang lebih berguna.</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#limbahModal">
                        Lihat Tutorial
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
    <?php require "../includes/footer.php";?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>