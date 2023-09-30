<?php 
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbcrud";

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM device WHERE id=$id";
    $conn->query($sql);
}

header("location: index.php");
exit;
