<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Raleway', sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 70px;
        }
    </style>
</head>

<body>
    <div class="container login-container shadow p-5 bg-white">

        <?php
        session_start();

        // Koneksi ke database MySQL (sesuaikan dengan informasi koneksi Anda)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login_register";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Tangkap data dari formulir login
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validasi input
            $username = isset($_POST["fullname"]) ? $_POST["fullname"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";

            if (empty($username) || empty($password)) {
                echo "<div class='alert alert-warning'>Mohon lengkapi semua formulir!</div>";
            } else {
                // Cari pengguna berdasarkan username
                $sql = "SELECT * FROM users WHERE full_name='$username'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    // Ambil data pengguna
                    $row = $result->fetch_assoc();
                    $storedPassword = $row["password"];

                    // Periksa apakah kata sandi cocok
                    if (password_verify($password, $storedPassword)) {
                        // Mulai sesi untuk pengguna dan arahkan ke halaman dashboard
                        $_SESSION["fullname"] = $row["fullname"];
                        header("Location: index.php");
                    } else {
                        echo "<div class='alert alert-danger'>username atau password salah!</div>";;
                    }
                } else {
                    echo "<div class='alert alert-danger'>Pengguna tidak ditemukan!</div>";;
                }
            }
        }

        // Tutup koneksi
        $conn->close();
        ?>

        <h2 class="text-center fw-bold mb-4">Login</h2>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="loginUserName" class="form-label">Username</label>
                <input type="text" class="form-control" id="loginUN" aria-describedby="UsernameHelp" name="fullname" placeholder="User Name" required>
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <button type="submit" class="btn btn-success btn-block">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="registrasi.php">Sign Up</a></p>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>