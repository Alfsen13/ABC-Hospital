<?php
// Memulai session
session_start();

// Periksa apakah session "nik" sudah diinisialisasi
if (!isset($_SESSION["nik"])) {
    // Jika belum, arahkan ke halaman login atau tindakan lain yang sesuai
    echo "Session 'nik' belum diinisialisasi. Harap login terlebih dahulu.";
    exit();
}

// Sesuaikan dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databasekonsultasi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jadwal = $_POST["id_jadwal"];
    $hari_tanggal = $_POST["hari_tanggal"];
    $nik = $_SESSION["nik"];

    // Logika penomoran kode jadwal
    $sqlKodeJadwal = "SELECT MAX(kode_jadwal) as max_kode FROM jadwal_konsultasi";
    $resultKodeJadwal = $conn->query($sqlKodeJadwal);

    if ($resultKodeJadwal === FALSE) {
        echo "Error: " . $sqlKodeJadwal . "<br>" . $conn->error;
        exit();
    }

    $rowKodeJadwal = $resultKodeJadwal->fetch_assoc();
    $nextKodeJadwal = $rowKodeJadwal["max_kode"] + 1;

    // Simpan data ke dalam tabel jadwal_konsultasi
    $sql = "INSERT INTO jadwal_konsultasi (kode_jadwal, id_jadwal, tanggal_waktu, nik) VALUES ('$nextKodeJadwal', '$id_jadwal', '$hari_tanggal', '$nik')";

    if ($conn->query($sql) === TRUE) {
        echo "Pemesanan jadwal berhasil.";
        // Tambahkan kode JavaScript untuk mengarahkan ke halaman pasien.html
        echo "<script>window.location.href = 'pasien.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
