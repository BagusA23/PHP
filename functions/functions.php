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

function totaluser(){
    global $conn;
    $sql = "SELECT COUNT(*) AS total_users FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_users = $row["total_users"];
    echo  $total_users;
    }else {
    echo "No users found.";
    }
}

function totalsampah(){
    global $conn;
    $sql = "SELECT SUM(berat) AS total_sampah FROM setor_sampah";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_sampah = $row["total_sampah"];
        echo  $total_sampah." Kg";
    }else {
        echo "No data found.";
    }
}
function register($data) {
    global $conn;
    
    // Bersihkan input
    $email = filter_var(strtolower(trim($data['email'])), FILTER_SANITIZE_EMAIL);
    $password = $data['password'];
    $confirmpassword = $data['ConfirmPassword'];

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

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data dengan prepared statement
    $stmt = $conn->prepare("INSERT INTO users ( email, password) VALUES ( ?, ?)");
    $stmt->bind_param("ss",  $email, $hashedPassword);
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
            $_SESSION['user_id'] = $user['id'];
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

function laporsampah($data){
    global $conn;
    $lokasi = filter_var(strtolower(trim($data['lokasi'])),FILTER_FLAG_EMPTY_STRING_NULL);
    $jenis = $data['jenis'];
    $deskripsi = $data['deskripsi'];
    $foto = $data['foto'];


    
}
