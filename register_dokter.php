<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databasekonsultasi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_dokter = $_POST["id_dokter"];
    $nama_dokter = $_POST["nama_dokter"];
    $no_kontak_dokter = $_POST["no_kontak_dokter"];
    $pwddokter = $_POST["pwddokter"];

    $stmt = $conn->prepare("INSERT INTO dokter (id_dokter, namadokter, nokontakdokter, pwddokter) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id_dokter, $nama_dokter, $no_kontak_dokter, $pwddokter);

    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
