<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sociallogin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nama_acara = $_POST['nama_acara'];
$tanggal_acara = $_POST['tanggal_acara'];
$tempat_acara = $_POST['tempat_acara'];
$deskripsi = $_POST['deskripsi'];

$gambar_brosur = null;
if ($_FILES['gambar_brosur']['size'] > 0) {
    $gambar_brosur = $_FILES['gambar_brosur']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar_brosur"]["name"]);

    move_uploaded_file($_FILES["gambar_brosur"]["tmp_name"], $target_file);
}

$sql = "INSERT INTO acara (nama_acara, tanggal_acara, tempat_acara, gambar_brosur, deskripsi) VALUES ('$nama_acara', '$tanggal_acara', '$tempat_acara', '$gambar_brosur', '$deskripsi')";

if ($conn->query($sql) === TRUE) {
    echo "Acara berhasil ditambahkan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();