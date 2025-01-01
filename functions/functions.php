<?php 
$host = "localhost";     // hostname
$username = "root";      // username database
$password = "samsunga33";          // password database 
$database = "bank_sampah";   // nama database

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    // echo "Koneksi berhasil";
}

// Close connection when not in use
// $koneksi->close();


function reward(){
    global $conn;
    $sql = "SELECT SUM(jumlah) as jumlah FROM pengeluaran WHERE status = 'selesai'";
    $result = $conn->query($sql);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $total = "Rp. " . number_format($row['jumlah'], 0, ',', '.');
        return $total;
    }else{
        return 0;
    }
}
function formatreward() {
    $saldo = reward();
    return "Rp. " . number_format($saldo, 0, ',', '.');
}

function totaluser(){
    global $conn;
    $sql = "SELECT COUNT(*) AS total_users FROM users WHERE role = 'user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_users = $row["total_users"];
        return $total_users;
    } else {
        return 0;
    }
}

// function user(){
//     global $conn;
//     $stmt = $conn->prepare("SELECT * FROM users");
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if($result->num_rows > 0){
//         while($row = $result->fetch_assoc()){
//             $row["id"]. " " .$row["name"]. " " .$row["email"]."".$row['role']."<br>";
//         }
//     } else {
//         echo "No users found.";
//     }
// }

function totalsampah(){
    global $conn;
    $sql = "SELECT SUM(berat) AS total_sampah 
                FROM setor_sampah 
                WHERE status = 'selesai'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_sampah = $row["total_sampah"];
        echo  $total_sampah." Kg";
    }else {
        echo "No data found.";
    }
}
//menghtung total saldo berdasarkan login
function totalsaldo(){
    global $conn;
    // Ambil ID user yang sedang login
    $user_id = $_SESSION['user_id'];

    // Query untuk menjumlahkan total harga hanya untuk user yang login
    $sql = "SELECT 
                (SELECT COALESCE(SUM(total_harga), 0) 
                FROM setor_sampah 
                WHERE id_user = ? 
                AND status = 'selesai') - 
                (SELECT COALESCE(SUM(jumlah), 0) 
                FROM pengeluaran 
                WHERE id_user = ?) 
            AS saldo_bersih";
    
    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $user_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Tambahkan pengecekan null dan konversi ke float
        $total_sampah = $row["saldo_bersih"] !== null ? floatval($row["saldo_bersih"]) : 0;
        $stmt->close();
        return $total_sampah; // Return nilai numerik
    } 
    
    $stmt->close();
    return 0; // Return 0 jika tidak ada data
}

// Function untuk menampilkan saldo dalam format rupiah
function formatSaldo() {
    $saldo = totalsaldo();
    return "Rp. " . number_format($saldo, 0, ',', '.');
}
//menghitung total sampah berdasrkan login
function totalsampahuser(){
    global $conn;
    // Ambil ID user yang sedang login
    $user_id = $_SESSION['user_id'];

    // Query untuk menjumlahkan total harga hanya untuk user yang login
    $sql = "SELECT SUM(berat) AS total_sampah FROM setor_sampah WHERE id_user = ? AND status = 'selesai'";
    
    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_sampah = $row["total_sampah"] !== null ? floatval($row['total_sampah']) : 0 ;
        echo  $total_sampah." Kg";
    }else {
        echo "No data found.";
    }
    
    $stmt->close();
}
function totallapor(){
    global $conn;
    $sql = "SELECT SUM(CASE WHEN status = 'resolved' THEN 1 ELSE 0 END) AS total_lapor FROM laporan";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_sampah = $row["total_lapor"];
        echo  $total_sampah;
    }else {
        echo "No data found.";
    }
}
function totallapor2(){
    global $conn;
    $query = "SELECT SUM(CASE WHEN status = 'pending' or status = 'in progress' THEN 1 ELSE 0 END) AS total_lapor FROM laporan";
    $result = $conn->query($query);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $total_lapor = $row["total_lapor"];
        echo $total_lapor;
    }else{
        echo "No data found.";
    }
}
function register($data) {
    global $conn;
    
    // Bersihkan input
    $email = filter_var(strtolower(trim($data['email'])), FILTER_SANITIZE_EMAIL);
    $password = $data['password'];
    $confirmpassword = $data['ConfirmPassword'];

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

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email tidak valid');</script>";
        return false;
    }

    // Cek username dengan prepared statement
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->fetch_assoc()) {
        echo "<script>alert('username sudah ada');</script>";
        return false;
    }
    $stmt->close();

    // Cek password
    if ($password !== $confirmpassword) {
        echo "<script>alert('Password tidak sama');</script>";
        return false;
    }
    $foto = '../assets/img/nophoto.png'; // Variabel untuk menyimpan nama file foto
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

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data dengan prepared statement
    $stmt = $conn->prepare("INSERT INTO users (gambar, email, password) VALUES ( ?,?, ?)");
    $stmt->bind_param("sss", $foto , $email, $hashedPassword);
    $stmt->execute();
    
    $affected_rows = $stmt->affected_rows;
    $stmt->close();
    
    return $affected_rows;
}


function login($data){
    global $conn;
    $email = filter_var(strtolower(trim($data['email'])), FILTER_SANITIZE_EMAIL);
    $password = $data['password'];
    $cook = $data['remember'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // cek password
        if (password_verify($password, $user["password"])) {
            // Set session
            $_SESSION['sign'] = true;
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['role'] = $user['role'];

            if (isset($cook) && $cook === 'on') {
                // Simpan informasi lebih detail
                setcookie('sign', $user['id'], time() + 60 * 60 * 24 * 30, '/');
            }
            // Redirect berdasarkan role
            switch ($user['role']) {
                case 'admin':
                    header('Location: ../dashboard/admin.php');
                    break;
                case 'user':
                    header('Location: ../index.php');
                    break;
                default:
                    header('Location: ../index.php');

            }
            exit;
        } else {
            $error = "Username atau password salah";
        }
    } else {
        $error = "Username atau password salah";
    }

    if (isset($error)) {
        echo "<script>alert('$error');</script>";
    }
}

// Fungsi untuk mengecek halaman yang memerlukan login
function requireLogin() {
    if (!isset($_SESSION['sign']) || $_SESSION['sign'] !== true) {
        header("Location: " . $GLOBALS['base_url'] . "/user/login.php");
        exit;
    }
}

// Fungsi untuk redirect user yang sudah login jika mencoba akses halaman login/register
function redirectIfLoggedIn() {
    if (isset($_SESSION['sign']) && $_SESSION['sign'] === true) {
        header("Location: " . $GLOBALS['base_url'] . "../index.php");
        exit;
    }
}

// functions.php atau config.php
function checkLogin() {
    if (!isset($_SESSION['sign']) || $_SESSION['sign'] !== true) {
        // Jika mencoba mengakses halaman selain index.php dan belum login
        $currentPage = basename($_SERVER['PHP_SELF']);
        if ($currentPage != '/index.php' && $currentPage != 'login.php' && $currentPage != 'register.php') {
            header("Location: " . $GLOBALS['base_url'] . "/index.php");
            exit;
        }
    }
}

// auth.php
function checkUserAccess() {
    // Fungsi ini akan digunakan di halaman-halaman yang membutuhkan login
    if (!isset($_SESSION['sign']) || $_SESSION['sign'] !== true) {
        header("Location: " . $GLOBALS['base_url'] . "/login.php");
        exit;
    }
}

function isLoggedIn() {
    // Fungsi untuk mengecek status login
    return isset($_SESSION['sign']) && $_SESSION['sign'] === true;
}

function getUserRole() {
    // Fungsi untuk mendapatkan role user
    return isset($_SESSION['role']) ? $_SESSION['role'] : null;
}

function requireAdmin() {
    // Fungsi untuk halaman yang hanya bisa diakses admin
    if (!isset($_SESSION['sign']) || $_SESSION['role'] !== 'admin') {
        header("Location: " . $GLOBALS['base_url'] . "dashboard/admin.php");
        exit;
    }
}

function updpassword($data){
    // Fungsi untuk mengupdate password user
    global $conn;
    $email = filter_var(strtolower(trim($data['email'])), FILTER_SANITIZE_EMAIL);
    $password = $data['password'];
    $confpassword = $data['ConfirmPassword'];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email tidak valid');</script>";
        return false;
    }

    // Cek username dengan prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email, );
    $stmt->execute();
    $result = $stmt->get_result();
    
    if (!$result->fetch_assoc()) {
        echo "<script>alert('Email tidak ditemukan');</script>";
        return false;
    }
    $stmt->close();

    // Cek password
    if ($password !== $confpassword) {
        echo "<script>alert('Password tidak sama');</script>";
        return false;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update password dengan prepared statement
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email, );
    $stmt->execute();
    
    $affected_rows = $stmt->affected_rows;
    $stmt->close();
    
    return $affected_rows;
}

function Lapor($data){
    global $conn;
    $lokasi = $data["lokasi"];
    $jenis = $data["jenis"];
    $deskripsi = $data["deskripsi"];
    $gambar = $data["gambar"];
    
    $stmt = $conn->prepare("INSERT INTO laporan (lokasi, deskripsi, status, tanggal_laporan, jenis, gambar) VALUES (?, ?, '', NOW(), ?, ?)");
    $stmt->bind_param("ssss", $lokasi, $deskripsi, $jenis, $gambar);

    if($stmt->execute()){
        return true;
    } else {
        return false;
    }
}

function user(){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users");
    $result = $stmt->get_result();
    var_dump($result);

}


function uploadFotoProfil($user_id, $foto) {
    // Direktori penyimpanan foto
    $target_dir = "../user/upload/";
    
    // Pastikan direktori uploads ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Cek apakah file adalah gambar
    $check = getimagesize($foto["tmp_name"]);
    if($check === false) {
        echo "<script>alert('File yang dipilih bukan gambar.');</script>";
        return false;
    }

    // Validasi ukuran file (misalnya maks 5MB)
    if ($foto["size"] > 5000000) {
        echo "<script>alert('Ukuran file terlalu besar. Maks 5MB.');</script>";
        return false;
    }

    // Generate nama file unik
    $nama_file_asli = basename($foto["foto"]);
    $ekstensi = strtolower(pathinfo($nama_file_asli, PATHINFO_EXTENSION));
    $nama_file_baru = $user_id . "_profile_" . uniqid() . "." . $ekstensi;
    $target_path = $target_dir . $nama_file_baru;

    // Validasi tipe file
    $tipe_file_valid = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($ekstensi, $tipe_file_valid)) {
        echo "<script>alert('Tipe file tidak diizinkan. Gunakan JPG, JPEG, PNG, atau GIF.');</script>";
        return false;
    }

    // Upload file
    if (move_uploaded_file($foto["tmp_name"], $target_path)) {
        global $conn; // Gunakan koneksi global
        
        // Hapus foto lama jika ada
        $query_cek_foto_lama = "SELECT gambar FROM users WHERE id = ?";
        $stmt_cek = $conn->prepare($query_cek_foto_lama);
        $stmt_cek->bind_param("i", $user_id);
        $stmt_cek->execute();
        $result = $stmt_cek->get_result();
        $row = $result->fetch_assoc();
        
        // Hapus file foto lama jika bukan default
        if ($row['gambar'] && $row['gambar'] != 'uploads/default_avatar.png') {
            if (file_exists($row['gambar'])) {
                unlink($row['gambar']);
            }
        }

        // Update path foto di database
        $query = "UPDATE users SET gambar = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $target_path, $user_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('Upload foto berhasil!');</script>";
            return true;
        } else {
            echo "<script>alert('Gagal menyimpan foto ke database.');</script>";
            return false;
        }
    } else {
        echo "<script>alert('Gagal upload foto.');</script>";
        return false;
    }
}

// Function to update trash category
function updateTrashCategory($data) {
    global $conn; // Gunakan koneksi global
    $id = $_POST['id_kategori'] ?? 0;
    $jenis = $_POST['jenis'] ?? '';
    $harga_per_kg = $_POST['harga_per_kg'] ?? 0;

    // Validate input
    if (empty($id) || empty($jenis) || $harga_per_kg <= 0) {
        $_SESSION['error'] = "Invalid input. Please fill all fields correctly.";
        header('Location: Harga.php');
        exit;
    }

    // Prepare and execute SQL
    $stmt = $conn->prepare("UPDATE kategori_sampah SET jenis = ?, harga_per_kg = ? WHERE id_kategori = ?");
    $stmt->bind_param("sdi", $jenis, $harga_per_kg, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Kategori sampah berhasil diperbarui!";
    } else {
        $_SESSION['error'] = "Gagal memperbarui kategori sampah: " . $stmt->error;
    }

    $stmt->close();
    header('Location: Harga.php');
    exit;
}

// Assuming you have a database connection established
function getStatusOptions($conn, $currentStatus = null) {
    
    $statuses = ['pending', 'progress', 'resolved'];
    
    $statusOptions = '';
    foreach ($statuses as $status) {
        $active = ($status == $currentStatus) ? 'active' : '';
        $statusOptions .= "<li>
            <button class='dropdown-item {$active}' type='button' data-status='{$status}'>
                " . ucfirst($status) . "
            </button>
        </li>";
    }
    
    return $statusOptions;
}