<?php
// Sesuaikan dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databasekonsultasi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari database
$sql = "SELECT * FROM jadwal_konsultasi";
$result = $conn->query($sql);

$pesananArray = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pesananArray[] = $row;
    }
}

// Mengembalikan data pesanan dalam format JSON
echo json_encode($pesananArray);

$conn->close();
?>
