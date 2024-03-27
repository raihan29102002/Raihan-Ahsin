<?php
include("sess_check.php");
include_once("function.php");
$pagedesc ="Master Acara";
include("layout_top.php");
include("dist/function/format_tanggal.php");
$id = $sess_admid;
?>

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
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="acara_tambah.php" class="btn btn-primary">Tambah</a>
					</div>
					<div class="panel-body">
						<?php
						// Query
						$sql = "SELECT * FROM master_acara ORDER BY id_acara DESC";
						$Qry = mysqli_query($conn, $sql);

						// Periksa apakah query berhasil dieksekusi
						if ($Qry) {
						?>
							<table class="table table-striped table-bordered table-hover" id="tabel-data">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="10%">Nama Acara</th>
										<th width="15%">Tahun</th>
										<th width="10%">Durasi (Menit)</th>
										<th width="10%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($data = mysqli_fetch_assoc($Qry)) { {
											echo '<tr>';
											echo '<td class="text-center">' . $i . '</td>';
											echo '<td class="text-center">' . $data['nama_acara'] . '</td>';
											echo '<td class="text-center">' .  $data['tahun'] . '</a></td>';
											echo '<td class="text-center">' . $data['durasi'] . '</td>';
											echo '<td class="text-center">';
											echo '<button class="btn btn-primary btn-xs" onclick="editAcara(' . $data['id_acara'] . ')">Edit</button>&nbsp;';
											echo '<button class="btn btn-danger btn-xs" onclick="deleteAcara(' . $data['id_acara'] . ')">Hapus</button>';
											echo '</td>';
											echo '</tr>';
											$i++;
										}
									}
									?>
								</tbody>
							</table>
						<?php
						} else {
							// Tambahkan penanganan kesalahan sesuai kebutuhan
							echo "Query failed: " . mysqli_error($conn);
						}
						?>

						<!-- Large modal -->
						<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-body">
										<p>Sedang memproses…</p>
									</div>
								</div>
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
	function editAcara(idAcara) {
		window.location.href = 'acara_edit.php?id=' + idAcara;
	}

	function deleteAcara(idAcara) {
		window.location.href = 'acara_hapus.php?id=' + idAcara;
	}
</script>
<script>
	function setEditAcaraMode(idAcara, namaAcara, Tahun, Durasi) {
		$("#id_acara").val(idAcara);
		$("#nama_acara").val(namaAcara);
		$("#tahun").val(Tahun);
		$("#durasi").val(Durasi);

		// Sembunyikan tombol Simpan, tampilkan tombol Edit
		$("#btnSimpan").hide();
		$("#btnEdit").show();
	}

	function cancelEditAcaraMode() {
		// Bersihkan formulir dan kembalikan ke mode tambah
		$("#id_acara").val('');
		$("#nama_acara").val('');
		$("#tahun").val('');
		$("#durasi").val('');

		// Tampilkan tombol Simpan, sembunyikan tombol Edit
		$("#btnSimpan").show();
		$("#btnEdit").hide();
	}
</script>
<script>
	function deleteAcara(idAcara) {
		var confirmation = confirm("Apakah Anda yakin ingin menghapus Acara ini?");

		if (confirmation) {
			window.location.href = 'acara_hapus.php?id=' + idAcara;
		}
	}
</script>

<?php
include("layout_bottom.php");
?>