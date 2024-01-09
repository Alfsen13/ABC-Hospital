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
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $usia = $_POST["usia"];
    $alamat = $_POST["alamat"];
    $no_kontak = $_POST["no_kontak"];
    $pwd = $_POST["pwd"];

    $stmt = $conn->prepare("INSERT INTO pasien (nik, nama, usia, alamat, no_kontak, pwdpasien) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $nik, $nama, $usia, $alamat, $no_kontak, $pwd);

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
