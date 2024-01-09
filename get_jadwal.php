<?php
// Lakukan koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databasekonsultasi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data jadwal dokter
$sql = "SELECT id_jadwal, id_dokter, hari, jam, ruangan FROM jadwal_dokter";
$result = $conn->query($sql);

// Siapkan array untuk menampung data
$data = array();

// Tambahkan data ke dalam array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Tutup koneksi
$conn->close();

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
