<?php
include("sess_check.php");
include_once("function.php");
$pagedesc = "Approved";
include("layout_top.php");
include("dist/function/format_tanggal.php");
$id = $sess_admid;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPengajuan = $_POST['id_pengajuan'];
    $emailPenerima = $_POST['email'];
    $nama = $_POST['nama'];
    $subject = 'Pemberitahuan hasil pengajuan e-Sertifikat Dinas Kominfo Kabupaten Kediri';
    $message = 'Kepada Yth. ' . $nama . '<br>di tempat.<br><br>' .
        'Dengan ini kami memberitahukan bahwa Anda telah <strong>lulus validasi</strong> terkait pengajuan e-Sertifikat sebagai peserta dalam acara yang diselenggarakan oleh Dinas Kominfo Kabupaten Kediri.<br>' .
        'Untuk mengunduh e-Sertifikat, silakan klik tautan berikut dan cari sesuai nama Anda:<br><br>' .
        '&emsp;<a href="https://s.id/DaftarE-Sertifikat" target="_blank"><strong>https://s.id/DaftarE-Sertifikat</strong></a>.<br>' .
        '&emsp;Password Akses: <strong>PemkabKediri123!</strong><br><br>' .
        'Atas perhatian Bapak/Ibu kami ucapkan terima kasih.<br><br>' .
        '<table border=0>' .
        '<tr><th style="background-color:#af3e3e; color:#fff;">Mohon jangan membalas melalui e-mail ini karena tidak akan kami tanggapi.</th></tr>' .
        '</table>' .
        '<hr>' .
        'Salam Hormat,<br>' .
        'Bidang Aptika<br><br>' .
        '<strong>DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN KEDIRI</strong>';
    // Pengaturan pengiriman email menggunakan PHPMailer
    $mail = new PHPMailer(true);
    $statusKirim = "";
    try {
        $mail->SMTPDebug  = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = '172.16.16.74';                             // ip lokal zimbra agar tidak terblokir DMZ
        $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
        $mail->Username   = 'no-reply.diskominfo@kedirikab.go.id';      //SMTP username
        $mail->Password   = 'vn+9#3Mr[%';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;             // Menggunakan STARTTLS untuk Gmail
        $mail->Port = 587;                                              // Menggunakan port 587 untuk STARTTLS
        $mail->SMTPDebug = 0;


        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('no-reply.diskominfo@kedirikab.go.id', 'Dinas Kominfo Kab Kediri');
        $mail->addAddress($emailPenerima);                              // Menggunakan alamat email dari data pengajuan
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);  // Set format email ke HTML

        $mail->send();

        //update dbnya di sini cakkkk
        $stt = 1;
        $sql = "UPDATE pengajuan SET
                status_email='" . $stt . "'
                WHERE id_pengajuan='" . $idPengajuan . "'";
        $ress = mysqli_query($conn, $sql);
        $statusKirim = 'Email berhasil dikirim.';
    } catch (Exception $e) {
        $statusKirim = 'Gagal mengirim email. Error: ' . $mail->ErrorInfo;
    }
}
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Approved</h1>
            </div>

            <div class="row">
                <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="app.php" method="GET">
                    <div class="col-lg-2" style="margin-top: 20px; margin-bottom: 10px;">
                        <label for="selectYear">Pilih Tahun:</label>
                        <select class="form-control" id="selectYear" name="selectYear" required>
                            <option value="">Pilih Tahun Acara</option>
                            <?php
                            $start_year = 2023;
                            $end_year = date('Y');
                            $getYear = (isset($_GET['selectYear']) && is_numeric($_GET['selectYear'])) ? $_GET['selectYear'] : '';
                            for ($year = $start_year; $year <= $end_year; $year++) {
                                $selected = ($year == $getYear) ? 'selected="selected"' : '';
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px; margin-bottom: 5px;">
                        <br>
                        <button type="submit" class="btn btn-primary" id="searchButton">Tampilkan</button>
                        <button type="button" class="btn btn-primary" onclick="exportData()" id="exportButton" style="display: none;">Export</button>
                        <br>
                        <a href="" id="download-link" style="display: none;"></a>
                    </div>
                </form>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php
                        // Query
                        $sql = "SELECT pengajuan.*, master_opd.nama_opd,master_acara.nama_acara FROM pengajuan INNER JOIN master_opd ON pengajuan.id_opd = master_opd.id_opd INNER JOIN master_acara ON pengajuan.id_acara = master_acara.id_acara WHERE pengajuan.status_pengajuan = 'Approved'";
                        if (isset($_GET['selectYear']) && is_numeric($_GET['selectYear'])) {
                            $selectedYear = mysqli_real_escape_string($conn, $_GET['selectYear']); // Ganti menjadi $_GET

                            $sql .= " AND pengajuan.tahun_acara = '{$selectedYear}'";
                            echo '<script>$("#exportButton").show();</script>';
                        }
                        $sql .= " ORDER BY id_pengajuan DESC";
                        $Qry = mysqli_query($conn, $sql);
                        // Periksa apakah query berhasil dieksekusi
                        if ($Qry) {
                        ?>
                            <table class="table table-striped table-bordered table-hover" id="tabel-data">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="5%">ID Pengajuan</th>
                                        <th width="15%">Nama</th>
                                        <th width="10%">Nama OPD</th>
                                        <th width="10%">Nama Acara</th>
                                        <th width="10%">Email</th>
                                        <th width="10%">Surat Tugas</th>
                                        <th width="10%">Tahun Acara</th>
                                        <th width="10%">Tanggal Pengajuan</th>
                                        <th width="10%">Status Pengajuan</th>
                                        <th width="10%">Status Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($data = mysqli_fetch_assoc($Qry)) {
                                        if ($data['status_pengajuan'] != 'Awaiting' && $data['status_pengajuan'] != 'Declined') {
                                            echo '<tr>';
                                            echo '<td class="text-center">' . $i . '</td>';
                                            echo '<td class="text-center">' . $data['id_pengajuan'] . '</td>';
                                            echo '<td class="text-center">' . $data['nama'] . '</a></td>';
                                            echo '<td class="text-center">' . $data['nama_opd'] . '</td>';
                                            echo '<td class="text-center">' . $data['nama_acara'] . '</td>';
                                            echo '<td class="text-center">' . $data['email'] . '</td>';
                                            echo '<td class="text-center"> <a href="javascript:void(0);" onclick="viewPDF(\'surat_tugas/' . basename($data['surat_tugas']) . '\', this);" data-file="' . basename($data['surat_tugas']) . '">Lihat Surat Tugas</a></td>';
                                            echo '<td class="text-center">' . $data['tahun_acara'] . '</td>';
                                            echo '<td class="text-center">' . date('d-M-Y H:i:s', strtotime($data['tanggal_pengajuan'])) . '</td>';
                                            echo '<td class="text-center">' . '<div class="label label-success label-outlined">' . $data['status_pengajuan'] . '</div>';
                                            echo '<td class="text-center">';
                                            if ($data['status_email'] == '0') {
                                                echo '<form class="form-horizontal" action="app.php" method="POST" enctype="multipart/form-data" onSubmit="return confirm(\'Apakah Anda yakin?\');">';
                                                echo '<input type="hidden" name="email" value="' . $data['email'] . '">';
                                                echo '<input type="hidden" name="nama" value="' . $data['nama'] . '">';
                                                echo '<input type="hidden" name="id_pengajuan" value="' . $data['id_pengajuan'] . '">';
                                                echo '<button type="submit" class="btn btn-primary btn-sm">Kirim Notifikasi</button>';
                                                echo '</form>';
                                            } elseif ($data['status_email'] == '1') {
                                                echo '<div class="label label-success label-outlined">Telah Menerima Email</div>';
                                            }
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
    function searchData() {
        var selectedYear = $('#selectYear').val();
        if (selectedYear !== '') {
            window.location.href = 'app.php?selectYear=' + selectedYear;
        }
    }

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
    }

    function exportData() {
        var selectedYear = $('#selectYear').val();
        if (selectedYear !== '') {
            // Kirim permintaan AJAX ke export_data.php
            $.ajax({
                url: 'export_data.php',
                type: 'POST',
                data: {
                    selectYear: selectedYear
                },
                success: function(response) {
                    console.log(response);
                    $('#download-link').attr('href', response);
                    $('#download-link')[0].click();
                    // Jika berhasil, aktifkan unduhan file


                },
                error: function(error) {
                    // Tampilkan pesan kesalahan jika ada
                    console.error('Error exporting data:', error);
                }
            });
        } else {
            alert('Pilih tahun terlebih dahulu.');
        }
    }
</script>


<?php
include("layout_bottom.php");
?>