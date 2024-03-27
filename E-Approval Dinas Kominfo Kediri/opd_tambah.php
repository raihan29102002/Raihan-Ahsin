<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "Data Karyawan";
$menuparent = "master";
include("layout_top.php");
?>
<script type="text/javascript">
	function checkNppAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'id_opd=' + $("#opd").val(), // Perbaikan di sini
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}

	function autoFillIdOpd() {
		// Logika untuk memberikan nilai otomatis ke id_opd
	}

	function checkidopdAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			data: 'id_opd=' + $("#id_opd").val(), // Perbaikan di sini
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
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
				<h1 class="page-header">Data OPD</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" action="opd_insert.php" method="POST" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Nama OPD</h3>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Nama OPD</label>
							<div class="col-sm-4">
								<input type="text" name="nama_opd" class="form-control" placeholder="Nama OPD" required>
							</div>
						</div>
						<div class="panel-footer">
							<div class="form-group">
								<label class="control-label col-sm-3"></label>
								<div class="col-sm-4 text-right">
									<button type="submit" name="simpan" action="opd.php" class="btn btn-primary">Tambah</button>
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
		autoFillIdOpd();
	});

	function checkidopdAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_nppavailability.php",
			data: 'id_opd=' + $("#id_opd").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>


<?php
include("layout_bottom.php");
?>