<?php
include("sess_check.php");
include_once("function.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['perbarui'], $_POST['tahun_acara'], $_POST['nama_acara'], $_POST['durasi'], $_POST['id_acara'])) {
    $nama_acara = $_POST['nama_acara'];
    $tahun_acara = $_POST['tahun_acara'];
    $durasi_acara = $_POST['durasi'];
    $id_acara = $_POST['id_acara'];

    // Lakukan pembaruan data acara
    $sql_update = "UPDATE master_acara SET nama_acara=?, tahun=?, durasi=? WHERE id_acara=?";
    $stmt_update = mysqli_prepare($conn, $sql_update);

    // Periksa apakah prepare statement berhasil
    if ($stmt_update) {
        mysqli_stmt_bind_param($stmt_update, "sssi", $nama_acara, $tahun_acara, $durasi_acara, $id_acara);   // 'sssi' untuk string, string, string, dan integer
        $result_update = mysqli_stmt_execute($stmt_update);

        if ($result_update) {
            header("Location: master_acara.php?act=update&msg=success");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Hapus prepared statement setelah digunakan
        mysqli_stmt_close($stmt_update);
    } else {
        echo "Prepare statement failed: " . mysqli_error($conn);
    }
} else {
    echo "Data yang dibutuhkan tidak lengkap.";
}
