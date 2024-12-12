<?php
require "../includes/navbar.php";
require_once "../functions/functions.php";


if(isset($_POST['kirim'])){
    // Tangkap data dari form
    $user = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $lokasi = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
    $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    
    // Proses upload foto
    $foto = ''; // Variabel untuk menyimpan nama file foto
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_file_size = 5 * 1024 * 1024; // 5MB

        // Cek tipe file
        if(!in_array($_FILES['foto']['type'], $allowed_types)) {
            $error = "Tipe file tidak diizinkan. Hanya JPEG, PNG, dan GIF yang diperbolehkan.";
        }
        // Cek ukuran file
        elseif($_FILES['foto']['size'] > $max_file_size) {
            $error = "Ukuran file terlalu besar. Maksimal 5MB.";
        }
        else {
            // Generate nama file unik
            $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $foto = uniqid() . '.' . $file_extension;
            $upload_path = 'uploads/' . $foto;

            // Pastikan direktori uploads tersedia
            if(!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            // Pindahkan file yang diupload
            if(!move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                $error = "Gagal mengupload foto.";
            }
        }
    }

    // Validasi input
    if(empty($lokasi) || empty($jenis) || empty($deskripsi)) {
        $error = "Semua field harus diisi!";
    }

    // Jika tidak ada error, proses insert
    if(!isset($error)) {
        // Gunakan prepared statement
        $stmt = $conn->prepare("INSERT INTO laporan (lokasi, deskripsi, status, tanggal_laporan, jenis, gambar) VALUES (?, ?, 'pending', NOW(), ?, ?)");
        $stmt->bind_param("ssss", $lokasi, $deskripsi, $jenis, $foto);

        // Eksekusi query
        if($stmt->execute()) {
            $success = "Laporan berhasil disimpan!";
        } else {
            $error = "Gagal menyimpan laporan: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    }
}

$query_cek_lapor = "SELECT * FROM laporan WHERE status != 'resolved'";
$stmt = $conn->prepare($query_cek_lapor);
$stmt->execute();
$result = $stmt->get_result();

$query_cek_lapor2 = "SELECT * FROM laporan WHERE status != 'pending' AND status != 'in progress'";
$stmt2 = $conn->prepare($query_cek_lapor2);
$stmt2->execute();
$result2 = $stmt2->get_result();

$i = 1;
$a = 1;

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
<?php  requireLogin(); ?>
    <div class="container my-4">
        <?php 
        // Tampilkan pesan error atau success
        if(isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
        if(isset($success)) {
            echo "<div class='alert alert-success'>$success</div>";
        }
        ?>
        
        <!-- Form Pelaporan -->
        <section class="mb-5">
            <h2 class="mb-4">Form Pelaporan Sampah</h2>
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" placeholder="Masukkan lokasi sampah" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Sampah</label>
                            <select name="jenis" class="form-select" required>
                                <option value="">Pilih jenis sampah</option>
                                <option>Sampah Rumah Tangga</option>
                                <option>Sampah Industri</option>
                                <option>Sampah B3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan detail permasalahan sampah" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                        <button type="submit" name="kirim" value="submit" class="btn btn-success">Kirim Laporan</button>
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row["tanggal_laporan"]; ?></td>
                            <td><?= $row['lokasi']; ?></td>
                            <?php if($row['status']=='pending'):?>
                            <td>
                            <span class="badge bg-danger"><?= $row['status']; ?></span>
                            </td>
                            <?php elseif($row['status']=='in progress'): ?>
                            <td>
                            <span class="badge bg-warning"><?= $row['status']; ?></span>
                            </td>
                            <?php endif; ?> 
                        </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
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
                        </tr>
                    </thead>
                    <tbody>
                       <?php if ($result2->num_rows > 0): ?>
                        <?php while ($row = $result2->fetch_assoc()): ?>
                        <tr>
                            <td><?= $a++; ?></td>
                            <td><?= $row["tanggal_laporan"]; ?></td>
                            <td><?= $row['lokasi']; ?></td>
                            <?php if($row['status']=='pending' or $row['status']=='in progress'): ?>
                            <td>
                            <span class="badge bg-warning"><?= $row['status']; ?></span>
                            </td>
                            <?php elseif($row['status'] == 'resolved'): ?>
                            <td>
                            <span class="badge bg-success"><?= $row['status']; ?></span>
                            </td>
                            <?php endif; ?> 
                        </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
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