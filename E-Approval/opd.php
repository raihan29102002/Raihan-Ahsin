<?php
include("sess_check.php");
include_once("function.php");

// deskripsi halaman
$pagedesc = "Data Karyawan";
include("layout_top.php");
include("dist/function/format_tanggal.php");

?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data OPD</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="opd_tambah.php" class="btn btn-primary">Tambah</a>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover" id="tabel-data">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th width="10%">Nama OPD</th>
									<th width="5%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$sql = "SELECT * FROM master_opd ORDER BY id_opd ASC";
								$ress = mysqli_query($conn, $sql);
								while ($data = mysqli_fetch_array($ress)) {
									echo '<tr>';
									echo '<td class="text-center">' . $i . '</td>';
									echo '<td class="text-center">' . $data['nama_opd'] . '</td>';
									echo '<td class="text-center">';
									echo '<button class="btn btn-primary btn-xs" onclick="editOpd(' . $data['id_opd'] . ')">Edit</button>&nbsp;';
									echo '<button class="btn btn-danger btn-xs" onclick="deleteOpd(' . $data['id_opd'] . ')">Hapus</button>';
									echo '</td>';
									echo '</tr>';
									$i++;
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						<button type="button" name="edit" class="btn btn-primary" id="btnEdit" style="display:none;">Edit</button>
					</div>
					<!-- Large modal -->
					<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-body">
									<p>One fine body…</p>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.panel -->
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<!-- bottom of file -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [{
				"orderable": false,
				"targets": [1]
			}]
		});

		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
<script>
	var app = {
		code: '0'
	};

	$('[data-load-code]').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var code = $this.data('load-code');
		if (code) {
			$($this.data('remote-target')).load('karyawan_detail.php?code=' + code);
			app.code = code;

		}
	});
</script>
<script>
	function editOpd(idOpd) {
		window.location.href = 'opd_edit.php?id=' + idOpd;
	}

	function deleteOpd(idOpd) {
		window.location.href = 'opd_hapus.php?id=' + idOpd;
	}
</script>
<script>
	function setEditOpdMode(idOpd, namaOpd) {
		$("#id_opd").val(idOpd);
		$("#nama_opd").val(namaOpd);

		// Sembunyikan tombol Simpan, tampilkan tombol Edit
		$("#btnSimpan").hide();
		$("#btnEdit").show();
	}

	function cancelEditOpdMode() {
		// Bersihkan formulir dan kembalikan ke mode tambah
		$("#id_opd").val('');
		$("#nama_opd").val('');

		// Tampilkan tombol Simpan, sembunyikan tombol Edit
		$("#btnSimpan").show();
		$("#btnEdit").hide();
	}
</script>
<script>
	function deleteOpd(idOpd) {
		var confirmation = confirm("Apakah Anda yakin ingin menghapus OPD ini?");

		if (confirmation) {
			window.location.href = 'opd_hapus.php?id=' + idOpd;
		}
	}
</script>


<?php
include("layout_bottom.php");
?>