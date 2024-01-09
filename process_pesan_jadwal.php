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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hari_tanggal = $_POST["hari_tanggal"];
    $id_jadwal = $_POST["id_jadwal"];
    $nik = $_POST["nik"];

    // Misalnya, mengisi kode_jadwal secara otomatis berdasarkan urutan penginputan data
    $queryMaxKodeJadwal = "SELECT MAX(kode_jadwal) as max_kode FROM jadwal_konsultasi";
    $resultMaxKode = $conn->query($queryMaxKodeJadwal);
    
    if ($resultMaxKode->num_rows > 0) {
        $rowMaxKode = $resultMaxKode->fetch_assoc();
        $kode_jadwal = $rowMaxKode["max_kode"] + 1;
    } else {
        $kode_jadwal = 1;
    }

    // Simpan data ke database
    $sql = "INSERT INTO jadwal_konsultasi (kode_jadwal, id_jadwal, hari_tanggal, nik) 
            VALUES ('$kode_jadwal', '$id_jadwal', '$hari_tanggal', '$nik')";

    if ($conn->query($sql) === true) {
        // Redirect ke halaman pasien.html setelah berhasil pemesanan
        header("Location: pasien.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
