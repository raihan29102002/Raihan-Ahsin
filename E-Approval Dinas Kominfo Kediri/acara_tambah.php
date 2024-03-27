<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "Acara Tambah";
$menuparent = "master";
include("layout_top.php");
?>
<script type="text/javascript">
	function checkNppAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'id_acara=' + $("#master_acara").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}

	function autoFillIdOpd() {
		// Logika untuk memberikan nilai otomatis ke id_acara
	}

	function checkidopdAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'id_acara=' + $("#id_acara").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}

	function autoFillIdAcara() {
		getAcaraByTahun();
	}

	function getAcaraByTahun() {
		var selectedTahun = $("select[name='tahun_acara']").val();

		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'tahun=' + selectedTahun,
			type: "POST",
			url: "master_acara.php", // Ganti ini dengan nama file PHP Anda
			success: function(data) {
				$("#daftarAcara").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Acara</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" action="acara_insert.php" method="POST" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Nama Acara</h3>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Tahun Acara</label>
							<div class="col-sm-4">
								<select class="form-control" name="tahun_acara" required>
									<option value="">Pilih Tahun Acara</option>
									<?php
									$start_year = 2023;
									$end_year = date('Y');
									for ($year = $start_year; $year <= $end_year; $year++) {
										echo "<option value=\"$year\">$year</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Nama Acara</label>
							<div class="col-sm-4">
								<input type="text" name="nama_acara" class="form-control" placeholder="Nama Acara" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Durasi (Menit)</label>
							<div class="col-sm-4">
								<input type="number" name="durasi" class="form-control" placeholder="Durasi Acara Dalam Satuan Menit" required>
							</div>
						</div>

						<div class="panel-footer">
							<div class="form-group">
								<label class="control-label col-sm-3"></label>
								<div class="col-sm-4 text-right">
									<button type="submit" name="simpan" class="btn btn-primary">Tambah</button>
								</div>
							</div>
						</div>
					</div>
			</div><!-- /.panel -->
			</form>
		</div>
	</div>
</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->

<script>
	$(document).ready(function() {
		autoFillIdAcara();
	});
</script>


<?php
include("layout_bottom.php");
?>