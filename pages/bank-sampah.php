<?php
require_once "../functions/functions.php";
require_once "../includes/navbar.php";
// Cek status login untuk menentukan konten yang ditampilkan
requireLogin();
checkLogin();
if(isset($_POST['submit'])){

    if(isset($_SESSION['sign'])){

    $user = $_SESSION['user_id']; // Ambil nilai user_id dari sesi
    $jenis = $_POST['jenis'];
    $berat = $_POST['berat'];


    // $query_cek_user = "SELECT * FROM users";
    // $result = $conn->query($query_cek_user);
    // while ($row = $result->fetch_assoc()) {
    //     echo "ID: " . $row['id_user'] . 
    //          " | Nama: " . $row['email'] . 
    //          " | role: " . $row['role'] . "<br>";
    // }
    // // Tampilkan semua kategori untuk memastikan data ada
    // $query_cek_kategori = "SELECT * FROM kategori_sampah";
    // $result = $conn->query($query_cek_kategori);
    // while ($row = $result->fetch_assoc()) {
    //     echo "ID: " . $row['id_kategori'] . 
    //          " | Nama: " . $row['jenis'] . 
    //          " | Harga/Kg: " . $row['harga_per_kg'] . "<br>";
    // }

    // Query untuk mendapatkan harga per kg
    $query_kategori = "SELECT id_kategori, harga_per_kg FROM kategori_sampah WHERE jenis = ?";
    $stmt_kategori = $conn->prepare($query_kategori);

    if (!$stmt_kategori) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_kategori->bind_param("s", $jenis);
    $stmt_kategori->execute();
    $result_kategori = $stmt_kategori->get_result();

    // Cek apakah kategori ditemukan
    if ($result_kategori->num_rows === 0) {
        die("Kategori tidak ditemukan: " . $jenis);
    }

    $jenis = $result_kategori->fetch_assoc();

    // // Debug: Tampilkan informasi kategori
    // echo "Kategori ditemukan:<br>";
    // echo "ID Kategori: " . $jenis['id_kategori'] . "<br>";
    // echo "Harga per Kg: " . $jenis['harga_per_kg'] . "<br>";

    // Hitung total harga
    $harga_per_kg = $jenis['harga_per_kg'];
    $total_harga = $berat * $harga_per_kg;
    $id_kategori = $jenis['id_kategori'];

    // Query insert dengan total harga yang dihitung
    $query_insert = "INSERT INTO setor_sampah 
                    (id_user, id_kategori, berat, total_harga, tanggal_setoran) 
                    VALUES 
                    (?, ?, ?, ?, NOW())";

    $stmt_insert = $conn->prepare($query_insert);

    if (!$stmt_insert) {
        die("Prepare insert failed: " . $conn->error);
    }

    $stmt_insert->bind_param("iids", 
        $user, // Gunakan nilai dari variabel $user
        $id_kategori, 
        $berat, 
        $total_harga
    );

    // Eksekusi query
    if ($stmt_insert->execute()) {
        echo "Berhasil input setoran";
        echo "Total Harga: Rp " . number_format($total_harga, 0, ',', '.');
    } else {
        echo "Gagal input: " . $stmt_insert->error;
    }

    // Tutup statement dan conn
    $stmt_kategori->close();
    $stmt_insert->close();
}
}
$query_cek_kategori = "SELECT * FROM setor_sampah 
                        JOIN kategori_sampah ON kategori_sampah.jenis = setor_sampah.id_kategori 
                        JOIN users ON users.id_user = setor_Sampah.id_user";
$result = $conn->query($query_cek_kategori);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Main Content -->
    <div class="container my-4">
        <!-- Informasi Bank Sampah -->
        <!-- Informasi Bank Sampah -->
<section class="mb-5">
    <h2 class="mb-4">Informasi Bank Sampah</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Apa itu Bank Sampah?</h5>
            <p class="card-text">Bank Sampah adalah konsep pengelolaan sampah berbasis masyarakat yang memungkinkan warga untuk mendaur ulang dan mendapatkan nilai ekonomi dari sampah yang mereka hasilkan.</p>
            
            <h6 class="mt-3">Tujuan Bank Sampah:</h6>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Mengurangi volume sampah yang dibuang ke TPA</li>
                <li class="list-group-item">Memberdayakan masyarakat dalam pengelolaan sampah</li>
                <li class="list-group-item">Menciptakan nilai ekonomi dari sampah</li>
                <li class="list-group-item">Mendorong gaya hidup ramah lingkungan</li>
            </ul>

            <h6 class="mt-3">Cara Kerja Bank Sampah:</h6>
            <div class="row mt-2">
                <div class="col-md-4 mb-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">1. Pemilahan</h6>
                            <p class="card-text">Pilah sampah sesuai jenisnya: plastik, kertas, logam, dll.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">2. Penyetoran</h6>
                            <p class="card-text">Setorkan sampah yang sudah dipilah ke Bank Sampah</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">3. Konversi</h6>
                            <p class="card-text">Sampah dihitung dan dikonversi menjadi nilai ekonomi</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-success mt-3" role="alert">
                <strong>Tip:</strong> Semakin banyak sampah yang Anda daur ulang, semakin besar manfaat yang Anda berikan kepada lingkungan!
            </div>
        </div>
    </div>
</section>
        <!-- Form Setor Sampah (Visible only when logged in) -->
        <section class="mb-5">
            <h2 class="mb-4">Setor Sampah</h2>
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" >
                        <div class="mb-3" >
                            <label class="form-label">Jenis Sampah</label>
                            <select class="form-select" name="jenis" >
                                <option>Pilih jenis sampah</option>
                                <option>Organik</option>
                                <option>Anorganik</option>
                                <option>B3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="berat">Berat (kg)</label>
                            <input type="number" step="0.01" class="form-control" id="berat" name="berat" required>
                            <div class="invalid-feedback">Berat harus diisi.</div>
                        </div>                       
                            <button type="submit" name="submit" class="btn btn-success">Setor Sampah</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- Daftar Harga Sampah -->
        <section class="mb-5">
            <h2 class="mb-4">Daftar Harga Sampah</h2>
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Jenis Sampah</th>
                            <th>Harga per Kg</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Organik</td>
                            <td>Rp 10.000</td>
                            <td>sisa sayur, kulit pisang, buah busuk, dan kulit bawang DLL</td>
                        </tr>
                        <tr>
                            <td>Anorganik</td>
                            <td>Rp 5.000</td>
                            <td>Ban bekas, Aneka elektronik, Pembuangan pestisida, Kertas kaca DLL</td>
                        </tr>
                        <tr>
                            <td>B3</td>
                            <td>Rp 3.000</td>
                            <td>Batu baterai bekas, Pestisida, Hairspray, Deterjen pakaian, Pembersih lantai DLL</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Riwayat Setoran (Visible only when logged in) -->
        <section class="mb-5">
            <h2 class="mb-4">Riwayat Setoran</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Sampah</th>
                            <th>Berat (kg)</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()) :?>
                        <tr>
                            <td><?= $row['tanggal_setoran']; ?></td>
                            <td><?= $row['jenis']; ?></td>
                            <td><?= $row['berat']; ?></td>
                            <td>Rp. <?= $row['total_harga']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
<?php require_once "../includes/footer.php";?>
<script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>