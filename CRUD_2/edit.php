<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcrud";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$id = "";
$uid = "";
$nama = "";
$jenis_device = "";
$pj_device = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET mehod: show the data of the client

    if (!isset($_GET["id"])) {
        header("location: index.php");
        exit;
    }

    $id = $_GET["id"];

    // read the row of he selected client from db table
    $sql = "SELECT * FROM device WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: index.php");
        exit;
    }

    $id = $row["id"];
    $uid = $row["uid"];
    $nama = $row["nama"];
    $jenis_device = $row["jenis_device"];
    $pj_device = $row["pj_device"];
} else {
    // POST method: Update the data of the client

    $id = $_POST["id"];
    $uid = $_POST["uid"];
    $nama = $_POST["nama"];
    $jenis_device = $_POST["jenis_device"];
    $pj_device = $_POST["pj_device"];

    do {
        if (empty($id) || empty($nama) || empty($jenis_device) || empty($pj_device) || empty($uid)) {
            $errorMessage = "Semua kolom harus diisi";
            break;
        }

        $sql = "UPDATE device " .
            "SET uid = '$uid', nama = '$nama', jenis_device = '$jenis_device', pj_device = '$pj_device' " .
            "WHERE id = $id";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "query error: " . $conn->error;
            break;
        }

        $successMessage = "Client update correctly";

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
    <title>Edit Device Account</title>
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
                        <button class="btn btn-primary" type="submit">
                            <a class="text-white ms-auto link-offset-2 link-underline link-underline-opacity-0" href="/logout.php">LogOut</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="col-md-7 mx-auto">
            <h1 class="fw-bold mb-4 text-center">Edit Device Account</h1>

            <?php
            if (!empty($errorMessage)) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }

            ?>

            <form method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row mb-3">
                    <label for="col-sm-3 col-form-label" class="fw-bold">UID</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="uid" value="<?php echo $uid; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="col-sm-3 col-form-label" class="fw-bold">Nama</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="col-sm-3 col-form-label" class="fw-bold">Jenis Device</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="jenis_device">
                            <option value="">- Jenis Device -</option>
                            <option value="HP" <?php if ($jenis_device == "HP") echo "selected" ?>>HP</option>
                            <option value="LP" <?php if ($jenis_device == "LP") echo "selected" ?>>LP</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="col-sm-3 col-form-label" class="fw-bold">Pj Device</label>
                    <div class="col-sm-12">
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