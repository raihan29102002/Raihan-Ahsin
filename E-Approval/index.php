<?php
include("sess_check.php");
include_once("function.php");

$sql_all = "SELECT id_pengajuan FROM pengajuan";
$ress_all = mysqli_query($conn, $sql_all);

// Periksa apakah query berhasil dieksekusi
if ($ress_all) {
	$all = mysqli_num_rows($ress_all);
} else {
	// Tambahkan penanganan kesalahan sesuai kebutuhan
	die("Query failed: " . mysqli_error($conn));
}
$sql_app = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Approved'";
$ress_app = mysqli_query($conn, $sql_app);

// Periksa apakah query berhasil dieksekusi
if ($ress_app) {
	$app = mysqli_num_rows($ress_app);
} else {
	// Tambahkan penanganan kesalahan sesuai kebutuhan
	die("Query failed: " . mysqli_error($conn));
}

$sql_wait = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Awaiting'";
$ress_wait = mysqli_query($conn, $sql_wait);

// Periksa apakah query berhasil dieksekusi
if ($ress_wait) {
	$wait = mysqli_num_rows($ress_wait);
} else {
	// Tambahkan penanganan kesalahan sesuai kebutuhan
	die("Query failed: " . mysqli_error($conn));
}

$sql_dec = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Declined'";
$ress_dec = mysqli_query($conn, $sql_dec);

// Periksa apakah query berhasil dieksekusi
if ($ress_dec) {
	$dec = mysqli_num_rows($ress_dec);
} else {
	// Tambahkan penanganan kesalahan sesuai kebutuhan
	die("Query failed: " . mysqli_error($conn));
}

// deskripsi halaman
$pagedesc = "Beranda";
include("layout_top.php");
?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-6 col-md-6">
				<a href="app_wait.php">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="panel panel-yellow">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="glyphicon glyphicon-time fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo $wait; ?></div>
											<div>
												<h4>Awaiting<h4>
											</div>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-6 col-md-6">
				<a href="app.php">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="panel panel-green">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="glyphicon glyphicon-ok-circle fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo $app; ?></div>
											<div>
												<h4>Approved</h4>
											</div>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-6 col-md-6">
				<a href="app_decline.php">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="panel panel-red">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="glyphicon glyphicon-remove-circle fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo $dec; ?></div>
											<div>
												<h4>Declined<h4>
											</div>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-6 col-md-6">
				<a href="app_all.php">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="glyphicon glyphicon-stats fa-3x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"><?php echo $all; ?></div>
											<div>
												<h4>Semua Data</h4>
											</div>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<?php
include("layout_bottom.php");
?>