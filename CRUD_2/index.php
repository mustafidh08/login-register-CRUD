<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SDT Sekolah Impian</title>
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
                    <li class="nav-item">
                        <a class="nav-link text-white ms-auto" href="create.php">Add Device</a>
                    </li>
                    <li class="nav-item ms-4">
                        <button class="btn btn-primary" type="submit">
                            <a class="text-white ms-auto link-offset-2 link-underline link-underline-opacity-0" href="logout.php">LogOut</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="fw-bold mb-4">Device List</h1>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>UID</th>
                    <th>Nama</th>
                    <th>Jenis Device</th>
                    <th>PJ Device</th>
                    <th>Jam Pengambilan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbcrud";

                // create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // check conn
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // read all row from db table
                $sql = "SELECT * from device";
                $result = $conn->query($sql);

                if (!$result) {
                    die("query error: " . $conn->error);
                }

                // read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[uid]</td>
                        <td>$row[nama]</td>
                        <td>$row[jenis_device]</td>
                        <td>$row[pj_device]</td>
                        <td>$row[jam_pengambilan]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Hapus</a>
                        </td>
                    </tr>
                    ";
                }

                ?>


            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>