<?php
require "../functions/functions.php";
if (isset($_POST['change']) && !empty($_POST['password']) && !empty($_POST['ConfirmPassword'])) {
    if ($_POST['password'] === $_POST['ConfirmPassword']) {
        // Siapkan array data lengkap
        $data = [
            'email' => $_POST['email'],  // Asumsikan 'change' berisi email
            'username' => $_POST['email'],  // Atau username, tergantung form Anda
            'password' => $_POST['password'],
            'ConfirmPassword' => $_POST['ConfirmPassword']
        ];

        // Panggil dengan array data lengkap
        $result = updpassword($data);
        
        if ($result) {
            echo "<script>alert('Berhasil Mengganti Password);</script>";
            header("Location: login.php");
        } else {
            echo "<script>alert('Gagal Mengganti Password');</script>";
        }
    } else {
        echo "<script>alert('Password tidak sama');</script>";
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
<div class="min-h-screen bg-cyan-400 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Change Password
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
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Enter your email address">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Change Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Change your password">
                    </div>
                </div>
                <div>
                    <label for="ConfirmPassword" class="block text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <div class="mt-1">
                        <input id="ConfirmPassword" name="ConfirmPassword" type="password" autocomplete="current-password" required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Confirm your password">
                    </div>
                </div>
                <div class="text-sm">
                        <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500">
                            Sign in
                        </a>
                    </div>
                <div>
                    <button type="submit" name="change"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Change
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