if(isset($_POST['submit'])){

$user = $_POST['user_id'] = $_SESSION['user_id'];
$jenis = $_POST['jenis'];
$berat = $_POST['berat'];

// Tampilkan semua kategori untuk memastikan data ada
$query_cek_kategori = "SELECT * FROM kategori_sampah";
$result = $conn->query($query_cek_kategori);
while ($row = $result->fetch_assoc()) {
echo "ID: " . $row['id_kategori'] . 
     " | Nama: " . $row['jenis'] . 
     " | Harga/Kg: " . $row['harga_per_kg'] . "<br>";
}


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

// Debug: Tampilkan informasi kategori
echo "Kategori ditemukan:<br>";
echo "ID Kategori: " . $jenis['id_kategori'] . "<br>";
echo "Harga per Kg: " . $jenis['harga_per_kg'] . "<br>";

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

// Gunakan session atau ganti dengan ID user aktif
$user = $_SESSION['user_id']; // Contoh, harusnya dari session

$stmt_insert->bind_param("iids", 
$user, 
$jenis, 
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