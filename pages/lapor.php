<?php
require_once "../functions/functions.php";

if(isset($_GET['kirim'])){

}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php
require "../includes/navbar.php";
requireLogin();
?>
    <!-- Main Content -->
    <div class="container my-4">
        <!-- Form Pelaporan -->
        <section class="mb-5">
            <h2 class="mb-4">Form Pelaporan Sampah</h2>
            <div class="card">
                <div class="card-body">
                    <form action="" method="get" >
                        <div class="mb-3" name="lokasi" >
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" placeholder="Masukkan lokasi sampah">
                        </div>
                        <div class="mb-3"name="jenis" >
                            <label class="form-label">Jenis Sampah</label>
                            <select class="form-select">
                                <option>Pilih jenis sampah</option>
                                <option>Sampah Rumah Tangga</option>
                                <option>Sampah Industri</option>
                                <option>Sampah B3</option>
                            </select>
                        </div>
                        <div class="mb-3" name="deskripsi" >
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="3" placeholder="Jelaskan detail permasalahan sampah"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" name="foto" >Upload Foto</label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>
                        <button type="submit" name="kirim" class="btn btn-success">Kirim Laporan</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Status Laporan -->
        <section class="mb-5">
            <h2 class="mb-4">Status Laporan</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Laporan</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#12345</td>
                            <td>2024-03-20</td>
                            <td>Jl. Contoh No. 123</td>
                            <td><span class="badge bg-warning">Dalam Proses</span></td>
                            <td><button class="btn btn-sm btn-info">Detail</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Riwayat Laporan -->
        <section class="mb-5">
            <h2 class="mb-4">Riwayat Laporan</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Laporan</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#12344</td>
                            <td>2024-03-15</td>
                            <td>Jl. Sample No. 456</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>2024-03-18</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php require "../includes/footer.php";?>
<script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>