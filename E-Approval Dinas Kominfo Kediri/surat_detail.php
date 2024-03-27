<!-- Printing -->
<link rel="stylesheet" href="css/printing.css">

<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
include_once("function.php");

if ($_GET && isset($_GET['code'])) {
    $kode = $_GET['code'];
    $sql = "SELECT pengajuan.*, master_opd.nama_opd, master_acara.nama_acara FROM pengajuan INNER JOIN master_opd ON pengajuan.id_opd = master_opd.id_opd INNER JOIN master_acara ON pengajuan.id_acara = master_acara.id_acara WHERE pengajuan.id_pengajuan = '$kode'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $result = mysqli_fetch_array($query);
    } else {
        // Handle error jika query tidak berhasil dieksekusi
        die("Error: " . mysqli_error($conn));
    }
}
?>

<html>

<head>
</head>

<body>
	<div id="section-to-print">
		<div id="only-on-print">
		</div>
		<div><br />
			<table width="100%">
				<tr>
					<td width="20%"><b>ID Pengajuan</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo $result['id_pengajuan']; ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%"><b>Nama</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo $result['nama']; ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%"><b>Nama OPD</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo $result['nama_opd']; ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%"><b>Nama Acara</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo $result['nama_acara']; ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%"><b>Email</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo $result['email']; ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%"><b>Surat Tugas</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo basename($result['surat_tugas']); ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%"><b>Tahun Acara</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo $result['tahun_acara']; ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%"><b>Tangal Pengajuan</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo IndonesiaTgl($result['tanggal_pengajuan']); ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%"><b>Status Pengajuan</b></td>
					<td width="2%"><b>:</b></td>
					<td width="78%"><?php echo $result['status_pengajuan']; ?></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>

</body>

</html>