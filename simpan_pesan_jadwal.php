<?php
// Koneksi ke database (ganti dengan informasi koneksi yang sesuai)
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "databasekonsul";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Ambil data dari formulir
$idJadwal = $_POST['idJadwal'];
$waktuTanggal = $_POST['waktuTanggal'];

// Ambil nilai maksimum kode jadwal yang ada di database
$sqlMaxKodeJadwal = "SELECT MAX(kode_jadwal) AS max_kode FROM pesan_jadwal";
$resultMaxKode = $conn->query($sqlMaxKodeJadwal);

if ($resultMaxKode->num_rows > 0) {
    $rowMaxKode = $resultMaxKode->fetch_assoc();
    $maxKode = $rowMaxKode['max_kode'];
    $kodeJadwal = $maxKode + 1;
} else {
    // Jika belum ada data, set nilai kode jadwal menjadi 1
    $kodeJadwal = 1;
}

// Logika penyimpanan data
$sql = "INSERT INTO pesan_jadwal (kode_jadwal, id_jadwal, waktu_tanggal) VALUES ('$kodeJadwal', '$idJadwal', '$waktuTanggal')";

if ($conn->query($sql) === TRUE) {
    // Jika data berhasil disimpan
    echo "Data berhasil disimpan!";
} else {
    // Jika terjadi kesalahan
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
