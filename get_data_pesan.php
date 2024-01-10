<?php
// Memulai session
session_start();

// Periksa apakah session "nik" sudah diinisialisasi
if (!isset($_SESSION["nik"])) {
    // Jika belum, beri respons kosong atau arahkan ke halaman login
    http_response_code(401); // Unauthorized
    exit();
}

// Sesuaikan dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databasekonsultasi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil NIK dari session
$nik = $_SESSION["nik"];

// Query untuk mengambil data pesan berdasarkan NIK
$sql = "SELECT kode_jadwal, id_jadwal, tanggal_waktu, nik FROM jadwal_konsultasi WHERE nik = '$nik'";
$result = $conn->query($sql);

if ($result === FALSE) {
    http_response_code(500); // Internal Server Error
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
}

// Siapkan array untuk menyimpan data pesan
$pesanData = array();

// Loop melalui hasil query dan tambahkan ke array
while ($row = $result->fetch_assoc()) {
    $pesanData[] = $row;
}

// Konversi array ke format JSON dan kirimkan sebagai respons
header('Content-Type: application/json');
echo json_encode($pesanData);

$conn->close();
?>
