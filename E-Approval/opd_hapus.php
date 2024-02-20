<?php
include("sess_check.php");
include_once("function.php");

if (isset($_GET['id'])) {
	$id_opd = mysqli_real_escape_string($conn, $_GET['id']);

	// Lakukan penghapusan data dari database
	$sql_delete = "DELETE FROM master_opd WHERE id_opd='$id_opd'";
	$result_delete = mysqli_query($conn, $sql_delete);

	if ($result_delete) {
		header("location: opd.php?act=delete&msg=success");
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
} else {
	echo "ID OPD tidak valid.";
}
