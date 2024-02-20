<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "Declined";
include("layout_top.php");
include("dist/function/format_tanggal.php");
$id = $sess_admid;
?>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Declined</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<?php
						// Query
						$sql = "SELECT pengajuan.*, master_opd.nama_opd,master_acara.nama_acara FROM pengajuan INNER JOIN master_opd ON pengajuan.id_opd = master_opd.id_opd INNER JOIN master_acara ON pengajuan.id_acara = master_acara.id_acara WHERE pengajuan.status_pengajuan = 'Declined' ORDER BY id_pengajuan DESC";
						$Qry = mysqli_query($conn, $sql);
						// Periksa apakah query berhasil dieksekusi
						if ($Qry) {
						?>
							<table class="table table-striped table-bordered table-hover" id="tabel-data">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="10%">ID Pengajuan</th>
										<th width="15%">Nama</th>
										<th width="10%">Nama OPD</th>
										<th width="10%">Nama Acara</th>
										<th width="10%">Email</th>
										<th width="10%">Surat Tugas</th>
										<th width="10%">Tahun Acara</th>
										<th width="10%">Tanggal Pengajuan</th>
										<th width="20%">Status Pengajuan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($data = mysqli_fetch_assoc($Qry)) {
										if ($data['status_pengajuan'] != 'Approved' && $data['status_pengajuan'] != 'Awaiting') {

											echo '<tr>';
											echo '<td class="text-center">' . $i . '</td>';
											echo '<td class="text-center">' . $data['id_pengajuan'] . '</td>';
											echo '<td class="text-center">' .  $data['nama'] . '</a></td>';
											echo '<td class="text-center">' . $data['nama_opd'] . '</td>';
											echo '<td class="text-center">' . $data['nama_acara'] . '</td>';
											echo '<td class="text-center">' . $data['email'] . '</td>';
											echo '<td class="text-center"><a href="javascript:void(0);" onclick="viewPDF(\'surat_tugas/' . basename($data['surat_tugas']) . '\', this);" data-file="' . basename($data['surat_tugas']) . '">Lihat Surat Tugas</a></td>';
											echo '<td class="text-center">' . $data['tahun_acara'] . '</td>';
											echo '<td class="text-center">' . date('d-M-Y H:i:s', strtotime($data['tanggal_pengajuan'])) . '</td>';
											echo '<td class="text-center">' . '<div class="label label-danger label-outlined">' . $data['status_pengajuan'] . '</div>';
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

						<!-- Modal untuk menampilkan PDF -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="pdfModalLabel">Surat Tugas</h4>
									</div>
									<div class="modal-body" id="embed-wrapper">
										<!-- <object data="" type="application/pdf" width="100%" height="768px">
                                            <embed src="" width="100%" height="768px">
                                        </object> -->
										<!-- <iframe src="http://docs.google.com/gview?url=<?= baseUrl() ?>surat_tugas/laporan.pdf&embedded=true" style="height:200px; width:100%;" frameborder="0"></iframe> -->
									</div>
								</div>
							</div>
						</div>

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
				"targets": []
			}]
		});

		$('#tabel-data').parent().addClass("table-responsive");
	});

	var app = {
		code: '0'
	};
</script>
<script>
	function viewPDF(pdfUrl, e) {
		var viewerUrl = 'surat_tugas/';
		var viewerUrlWithPDF = viewerUrl + pdfUrl;
		var datasetFile = $(e)[0].dataset.file;
		var finalUrl = '<?= baseUrl("surat_tugas/") ?>' + datasetFile + '#navpanes=0';

		console.log(datasetFile);

		$('#embed-wrapper').html('');
		$('#embed-wrapper').html(`
        <object data="` + finalUrl + `" type="application/pdf" width="100%" height="768px">
            <embed src="` + finalUrl + `" width="100%" height="768px">
        </object>`);
		$('#myModal').modal('show');
		// $('#myModal object').attr('data', '<?= baseUrl("surat_tugas/") ?>' + datasetFile + '#navpanes=0');
		// $('#myModal embed').attr('src', '<?= baseUrl("surat_tugas/") ?>' + datasetFile + '#navpanes=0');
	}
</script>
<script>
	$('[data-load-code]').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var code = $this.data('load-code');
		if (code) {
			$($this.data('remote-target')).load('surat_detail.php?code=' + code);
			app.code = code;
		}
	});
</script>

<?php
include("layout_bottom.php");
?>