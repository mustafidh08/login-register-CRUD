<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

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

        .signup-container {
            max-width: 400px;
            margin: auto;
            margin-top: 70px;
        }
    </style>
</head>

<body>
    <div class="container signup-container shadow p-5 bg-white">
        <?php
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

        // Tangkap data dari formulir pendaftaran
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = isset($_POST["fullname"]) ? $_POST["fullname"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";

            if (empty($username) || empty($email) || empty($password)) {
                echo "<div class='alert alert-warning'>Mohon lengkapi semua formulir!</div>";
            } else {
                // Hash kata sandi
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Periksa apakah pengguna sudah ada dengan nama pengguna atau email yang sama
                $checkUserQuery = "SELECT * FROM users WHERE full_name='$username' OR email='$email'";
                $checkUserResult = $conn->query($checkUserQuery);

                if ($checkUserResult->num_rows > 0) {
                    echo  "<div class='alert alert-danger'>Username atau email sudah digunakan. Silakan coba lagi.</div>";
                } else {
                    // Masukkan data pengguna ke dalam tabel pengguna
                    $sql = "INSERT INTO users (full_name, email, password) VALUES ('$username', '$email', '$hashedPassword')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<div class='alert alert-primary'>Registrasi berhasil!</div>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        }

        // Tutup koneksi
        $conn->close();
        ?>

        <h2 class="text-center fw-bold mb-4">Sign Up</h2>
        <form action="registrasi.php" method="post">
            <div class="mb-3">
                <label for="fullName" class="form-label">Username</label>
                <input type="text" class="form-control" id="fullName" name="fullname" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label for="signupEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="signupEmail" aria-describedby="emailHelp" name="email" placeholder="Email address" required>
            </div>
            <div class="mb-3">
                <label for="signupPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="signupPassword" name="password" placeholder="Password" required>
            </div>
            <button type="submit" value="Register" name="submit" class="btn btn-success btn-block">Sign Up</button>
        </form>
        <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>