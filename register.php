<?php
// Sesuaikan dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "databasekonsul";

$conn = new mysqli($servername, $username, $pwd, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_register = $_POST["role_register"];
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $usia = $_POST["usia"];
    $alamat = $_POST["alamat"];
    $no_kontak = $_POST["no_kontak"];
    $pwd = $_POST["pwd"];

    // Handle registrasi logic here

    // Contoh untuk pasien
    if ($role_register == "pasien") {
        $sql = "INSERT INTO pasien (nik, namapasien, usia, alamat, no_kontak, pwdpasien)
                VALUES ('$nik', '$nama', '$usia', '$alamat', '$no_kontak', '$pwd')";

        if ($conn->query($sql) === true) {
            // Registrasi pasien berhasil
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Contoh untuk dokter
    elseif ($role_register == "dokter") {
        $id_dokter = $_POST["id_dokter"];
        $nama_dokter = $_POST["nama_dokter"];
        $no_kontak_dokter = $_POST["no_kontak_dokter"];

        $sql = "INSERT INTO dokter (id_dokter, namadokter, nokontakdokter, pwddokter)
                VALUES ('$id_dokter', '$nama_dokter', '$no_kontak_dokter', '$pwd')";

        if ($conn->query($sql) === true) {
            // Registrasi dokter berhasil
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
