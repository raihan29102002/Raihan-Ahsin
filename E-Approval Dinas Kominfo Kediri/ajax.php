<?php
require_once('dist/config/koneksi.php');

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan nilai tahun dari inputan user
$tahun = $_POST['tahun_acara'];  // Pastikan variabel ini sesuai dengan yang diharapkan

// Membuat query untuk mengambil data subdistricts berdasarkan tahun
$query = "SELECT id_acara, nama_acara FROM master_acara WHERE tahun = " . $tahun . "";
$result = $conn->query($query);

$data = "";

// Membuat opsi dropdown berdasarkan hasil query
while ($row = $result->fetch_assoc()) {
    $data .= "<option value='" . $row['id_acara'] . "'>" . $row['nama_acara'] . "</option>";
}

echo $data;

// Menutup koneksi
$conn->close();
