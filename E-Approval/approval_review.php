<?php
include("sess_check.php");
include_once("function.php");

// deskripsi halaman
$pagedesc = "Approval";
$menuparent = "approval";
include("layout_top.php");
$now = date('Y-m-d');
$id_pengajuan = $_GET['no'];
$Sql = "SELECT pengajuan.*, master_opd.nama_opd, master_acara.nama_acara FROM pengajuan INNER JOIN master_opd ON pengajuan.id_opd = master_opd.id_opd INNER JOIN master_acara ON pengajuan.id_acara = master_acara.id_acara WHERE pengajuan.id_pengajuan = " . $id_pengajuan;
$Qry = mysqli_query($conn, $Sql);
$data = mysqli_fetch_array($Qry);
?>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Pengajuan</h1>
			</div>

			<div class="row">
				<div class="col-lg-8"><?php include("layout_alert.php"); ?></div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-12">
					<form class="form-horizontal" name="aproval_review" action="approval_update.php" method="POST" enctype="multipart/form-data" onSubmit="return valid();">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3>Review</h3>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="control-label col-sm-3">ID Pengajuan</label>
									<div class="col-sm-4">
										<input type="text" name="no" class="form-control" value="<?php echo $data['id_pengajuan']; ?>" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Nama</label>
									<div class="col-sm-4">
										<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?> " readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Nama OPD</label>
									<div class="col-sm-4">
										<input type="text" name="nama_opd" class="form-control" value="<?php echo ($data['nama_opd']); ?> " readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Nama Acara</label>
									<div class="col-sm-4">
										<input type="text" name="nama_opd" class="form-control" value="<?php echo ($data['nama_acara']); ?> " readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Email</label>
									<div class="col-sm-4">
										<input type="text" name="email" class="form-control" value="<?php echo ($data['email']); ?> " readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Surat Tugas</label>
									<div class="col-sm-4">
										<input type="text" name="surat_tugas" class="form-control" value="<?php echo basename($data['surat_tugas']); ?> " readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Tahun Acara</label>
									<div class="col-sm-4">
										<input type="text" name="tahun_acara" class="form-control" value="<?php echo ($data['tahun_acara']); ?> " readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Tanggal Pengajuan</label>
									<div class="col-sm-4">
										<input type="text" name="tanggal_pengajuan" class="form-control" value="<?php echo IndonesiaTgl($data['tanggal_pengajuan']); ?> " readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Aksi</label>
									<div class="col-sm-4">
										<select name="aksi" id="aksi" class="form-control" required>
											<option value="" selected>---- Pilih Aksi ----</option>
											<option value="1">Approve</option>
											<option value="2">Decline</option>
										</select>
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="form-group">
									<label class="control-label col-sm-3"></label>
									<div class="col-sm-4 text-right">
										<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$('#aksi').change(function() {
			if ($(this).val() === '2') {
				$('#reject').attr('disabled', false);
			} else {
				$('#reject').attr('disabled', 'disabled');
			}
		});
	});
</script>

<?php
include("layout_bottom.php");
?>