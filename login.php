<?php
// Sesuaikan dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "databasekonsultasi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["role"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Handle login logic here

    // Contoh untuk pasien
    if ($role == "pasien") {
        $sql = "SELECT * FROM pasien WHERE nik='$username' AND pwdpasien='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Pasien ditemukan, arahkan ke halaman pasien.html
            header("Location: pasien.html");
            exit();
        } else {
            echo "Login gagal. Silakan coba lagi.";
        }
    }

    // Contoh untuk dokter
    elseif ($role == "dokter") {
        $sql = "SELECT * FROM dokter WHERE id_dokter='$username' AND pwddokter='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Dokter ditemukan, arahkan ke halaman dokter.html
            header("Location: dokter.html");
            exit();
        } else {
            echo "Login gagal. Silakan coba lagi.";
        }
    }
}

$conn->close();
?>
