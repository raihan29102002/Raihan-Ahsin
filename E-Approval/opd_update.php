<?php
include("sess_check.php");
include_once("function.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['perbarui'], $_POST['nama_opd'], $_POST['id_opd'])) {
    $nama_opd = $_POST['nama_opd'];
    $id_opd = $_POST['id_opd'];

    // Lakukan pembaruan nama OPD
    $sql_update = "UPDATE master_opd SET nama_opd=? WHERE id_opd=?";
    $stmt_update = mysqli_prepare($conn, $sql_update);

    // Periksa apakah prepare statement berhasil
    if ($stmt_update) {
        mysqli_stmt_bind_param($stmt_update, "si", $nama_opd, $id_opd); // 'si' untuk string dan integer
        $result_update = mysqli_stmt_execute($stmt_update);

        if ($result_update) {
            header("Location: opd.php?act=update&msg=success");
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
