<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcrud";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$uid = "";
$nama = "";
$jenis_device = "";
$pj_device = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST["uid"];
    $nama = $_POST["nama"];
    $jenis_device = $_POST["jenis_device"];
    $pj_device = $_POST["pj_device"];

    do {
        if (empty($uid) || empty($nama) || empty($jenis_device) || empty($pj_device)) {
            $errorMessage = "Semua kolom harus diisi";
            break;
        }

        // add new client to db
        $sql = "INSERT INTO device (uid, nama, jenis_device, pj_device)" .
            "VALUES ('$uid', '$nama', '$jenis_device', '$pj_device')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "query error: " . $conn->error;
            break;
        }

        $uid = "";
        $nama = "";
        $jenis_device = "";
        $pj_device = "";

        $successMessage = "Client added correctly";

        header("location: index.php");
        exit;
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Device Account</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-none p-md-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SDT</a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-white ms-auto" href="create.php">Add Device</a>
                    </li> -->
                    <li class="nav-item ms-4">
                        <button class="btn btn-primary">
                            <a class="text-white ms-auto link-offset-2 link-underline link-underline-opacity-0" href="logout.php">LogOut</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container my-5">
        <div class="col-sm-7 mx-auto">
            <h1 class="fw-bold mb-4 text-center">New Device Account</h1>

            <?php
            if (!empty($errorMessage)) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }

            ?>

            <form method="post">
                <div class="row mb-3">
                    <label for="col-sm-3 col-form-label" class="fw-bold">UID</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="uid" value="<?php echo $uid; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="col-sm-3 col-form-label" class="fw-bold">Nama</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="col-sm-3 col-form-label" class="fw-bold">Jenis Device</label>
                    <div class="col-md-12">
                        <select class="form-control" name="jenis_device">
                            <option value="">- Jenis Device -</option>
                            <option value="HP" <?php if ($jenis_device == "HP") echo "selected" ?>>HP</option>
                            <option value="LP" <?php if ($jenis_device == "LP") echo "selected" ?>>LP</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="col-sm-3 col-form-label" class="fw-bold">Pj Device</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="pj_device" value="<?php echo $pj_device; ?>">
                    </div>
                </div>

                <?php
                if (!empty($successMessage)) {
                    echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
                }

                ?>

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class='btn btn-outline-primary' href='index.php' role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>