<?php
// Sesuaikan dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databasekonsultasi";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dokter
$query = "SELECT id_dokter, namadokter, nokontakdokter FROM dokter";
$result = $conn->query($query);

// Mengonversi hasil query menjadi array assosiatif
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Mengirim data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

// Menutup koneksi
$conn->close();
?>
