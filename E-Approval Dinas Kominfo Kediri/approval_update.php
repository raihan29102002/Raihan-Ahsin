<?php
include("sess_check.php");
include_once("function.php");
include("dist/config/koneksi.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $aksi = $_POST['aksi'];
    $nama = $_POST['nama'];
    $emailPenerima = $_POST['email']; // Ambil alamat email dari data pengajuan

    // Proses pengiriman email berdasarkan nilai aksi
    if ($aksi == 1) {
/*         $subject = 'Pemberitahuan hasil pengajuan e-Sertifikat Dinas Kominfo Kabupaten Kediri';
        $message = 'Kepada Yth. ' . $nama . '<br>di tempat.<br><br>' .
            'Dengan ini kami memberitahukan bahwa Anda telah <strong>lulus validasi</strong> terkait pengajuan e-Sertifikat sebagai peserta dalam acara yang diselenggarakan oleh Dinas Kominfo Kabupaten Kediri.<br>' .
            'Untuk mengunduh e-Sertifikat, silakan klik tautan berikut dan cari sesuai nama Anda:<br><br>' .
            '&emsp;<a href="https://s.id/DaftarE-Sertifikat" target="_blank"><strong>https://s.id/DaftarE-Sertifikat</strong></a>.<br>' .
            '&emsp;Password Akses: <strong>PemkabKediri123!</strong><br><br>' .
            'Atas perhatian Bapak/Ibu kami ucapkan terima kasih.<br><br>' .
            '<table border=0>' .
            '<tr><th style="background-color:#af3e3e; color:#fff;">Mohon jangan membalas melalui e-mail ini karena tidak akan kami tanggapi.</th></tr>' .
            '</table>' .
            '<hr>' .
            'Salam Hormat,<br>' .
            'Bidang Aptika<br><br>' .
            '<strong>DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN KEDIRI</strong>'; */
    } elseif ($aksi == 2) {
        $subject = 'Pemberitahuan hasil pengajuan e-Sertifikat Dinas Kominfo Kabupaten Kediri';
        $message = 'Kepada Yth. ' . $nama . '<br>di tempat.<br><br>' .
            'Dengan ini kami memberitahukan bahwa pengajuan e-Sertifikat Anda ' . ' <strong>tidak lulus validasi</strong>.<br>' .
            'Adapun beberapa faktor yang dapat menyebabkan Anda <strong>tidak lulus</strong> adalah sebagai berikut:<br>' .
            '<ol>' .
            '<li>Pengisian identitas peserta tidak sesuai dengan Surat Perintah Tugas yang diunggah.</li>' .
            '<li>Surat Perintah Tugas yang diunggah tidak sesuai dengan acara yang diikuti.</li>' .
            '</ol>' .
            'Atas perhatian Bapak/Ibu kami ucapkan terima kasih.<br><br>' .
            '<table border=0>' .
            '<tr><th style="background-color:#af3e3e; color:#fff;">Mohon jangan membalas melalui e-mail ini karena tidak akan kami tanggapi.</th></tr>' .
            '</table>' .
            '<hr>' .
            'Salam Hormat,<br>' .
            'Bidang Aptika<br><br>' .
            '<strong>DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN KEDIRI</strong>';
    } else {
        // Jika aksi tidak valid
        echo 'Pilih aksi yang valid.';
        exit;
    }

    // Pengaturan pengiriman email menggunakan PHPMailer
    $mail = new PHPMailer(true);
    try {
        //$mail->SMTPDebug  = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = '172.16.16.74';                             // ip lokal zimbra agar tidak terblokir DMZ
        $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
        $mail->Username   = 'no-reply.diskominfo@kedirikab.go.id';      //SMTP username
        $mail->Password   = 'vn+9#3Mr[%';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;             // Menggunakan STARTTLS untuk Gmail
        $mail->Port = 587;                                              // Menggunakan port 587 untuk STARTTLS
        $mail->SMTPDebug = 2;


        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('no-reply.diskominfo@kedirikab.go.id', 'Dinas Kominfo Kab Kediri');
        $mail->addAddress($emailPenerima);                              // Menggunakan alamat email dari data pengajuan
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);  // Set format email ke HTML

        $mail->send();
        echo 'Email berhasil dikirim.';
    } catch (Exception $e) {
        echo 'Gagal mengirim email. Error: ' . $mail->ErrorInfo;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging: Cek nilai dari $_POST
    $no = $_POST['no'];
    $aksi = $_POST['aksi'];
    $reject = isset($_POST['decline']) ? $_POST['decline'] : '';

    if ($aksi == "2") {
        // Aksi Decline
        $stt = "Declined";
        $sql = "UPDATE pengajuan SET
                status_pengajuan='" . $stt . "',
                keterangan_decline='" . $reject . "'
                WHERE id_pengajuan='" . $no . "'";
        $ress = mysqli_query($conn, $sql);

        // Debugging: Cek hasil query
        if ($ress) {
            echo "Query berhasil dijalankan. Status Pengajuan diubah menjadi Declined.";
        } else {
            echo "Query gagal dijalankan. Error: " . mysqli_error($conn);
        }

        header("location: app_wait.php?act=update&msg=success");
    } elseif ($aksi == "1") {
        // Aksi Approved
        $stt = "Approved";
        $sql = "UPDATE pengajuan SET
                status_pengajuan='" . $stt . "',
                keterangan_decline=NULL
                WHERE id_pengajuan='" . $no . "'";
        $ress = mysqli_query($conn, $sql);

        // Debugging: Cek hasil query
        if ($ress) {
            echo "Query berhasil dijalankan. Status Pengajuan diubah menjadi Approved.";
        } else {
            echo "Query gagal dijalankan. Error: " . mysqli_error($conn);
        }

        header("location: app_wait.php?act=update&msg=success");
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request method.";
}
