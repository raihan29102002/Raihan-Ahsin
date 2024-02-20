<?php
session_start(); // jangan lupa ini wajib~
require "function.php";

if (isset($_POST)) {
    $nama = $_POST["nama"];
    $id_opd = $_POST["opd"];
    $email = $_POST["email"];
    $tahun_acara = $_POST["tahun_acara"];
    $tanggal_pengajuan = date("Y-m-d H:i:s");
    $status_pengajuan = "Awaiting";

    // File handling
    $targetDir = "surat_tugas/";
    $targetFile = $targetDir . basename($_FILES["surat_tugas"]["name"]);

    if (empty($nama) or empty($email) or empty($id_opd) or empty($tahun_acara) or empty($file)) {
        create_validasi(
            "Form Tidak Lengkap",
            "Kelihatannya belum semua kolom diisi dengan benar, silakan dicek lagi..",
            "pengajuan_sertifikat.php"
        );
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            create_validasi(
                "Invalid Email",
                "Email yang anda masukkan tidak valid, silakan dicek lagi..",
                "pengajuan_sertifikat.php"
            );
        } else {
            // Lakukan perintah penyimpanan disini
            // Contoh menyimpan file, sesuaikan dengan kebutuhan
            if (move_uploaded_file($_FILES["surat_tugas"]["tmp_name"], $targetFile)) {
                // Setelah selesai, dibuat alert success
                create_validasi(
                    "Success!!!",
                    "Anda sudah terdaftar di sistem kami",
                    "pengajuan_sertifikat.php"
                );
            } else {
                create_validasi(
                    "Error Upload",
                    "Gagal mengupload file, silakan coba lagi..",
                    "pengajuan_sertifikat.php"
                );
            }
        }
    }
}

