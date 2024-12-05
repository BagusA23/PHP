<?php  
session_start();
require "../functions/functions.php";

if(isset($_COOKIE['PPHSDW']) && isset($_COOKIE['PPHSDE'])){
    $PPHSDW = $_COOKIE['PPHSDW'];
    $PPHSDE = $_COOKIE['PPHSDE'];

    // Prepare statement
    $stmt = mysqli_prepare($conn, "SELECT email FROM users WHERE id_user = ?");
    
    if (!$stmt) {
        // Handle preparation error
        die("Prepare failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $PPHSDW);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            // Check cookie and username
            if($PPHSDE === hash('sha256', $row['email'])){
                $_SESSION['sign'] = true;
            }
        } else {
            // No user found
            error_log("No user found with ID: " . $PPHSDW);
        }
    } else {
        // Query failed
        error_log("Query failed: " . mysqli_error($conn));
    }
}

if(isset($_SESSION['sign']) && $_SESSION['sign'] === true){
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['sign'])) {
    global $conn;
    $email = filter_var(strtolower(trim($_POST['email'])), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

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
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if (isset($_POST['remember'])) {
                // Simpan informasi lebih detail
                setcookie('PPHSDW', hash('sha256',$user['id_user']), time() + 60 * 60 * 24 * 30, '/');
                setcookie('PPHSDE', hash('sha256',$user['email']), time() + 60 * 60 * 24 * 30, '/');

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
<?php redirectIfLoggedIn(); ?>
<div class="min-h-screen bg-cyan-400 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Sign in to your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600 max-w">
            Or
            <a href="register.php" class="font-medium text-blue-600 hover:text-blue-500">
                create an account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email"  autocomplete="email" required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Enter your email address">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Enter your password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="change.php" class="font-medium text-blue-600 hover:text-blue-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" name="sign"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

                        Sign in
                    </button>
                </div>
            </form>
            <div class="mt-6">

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>