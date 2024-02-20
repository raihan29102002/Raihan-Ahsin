<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("location: /index.php");
}

include_once("function.php");
require_once('dist/config/koneksi.php');

// Query untuk mengambil data OPD dari tabel di database
$sql_opd = "SELECT id_opd, nama_opd FROM master_opd";
$result_opd = $conn->query($sql_opd);


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $gagalArr = [];
    $gagal = [];
    $sukses = '';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Check if file was uploaded successfully
    if ($_FILES["surat_tugas"]["error"] == UPLOAD_ERR_INI_SIZE) {
        // Check file size (2 MB)
        $maxFileSize = 2 * 1024 * 1024; // 2 MB dalam bytes
        if ($_FILES["surat_tugas"]["size"] > $maxFileSize) {
            //echo "<script>alert('File size exceeds the limit of 2 MB. Please upload a smaller file.');</script>";
            $gagal[0] = 'gagal-file-size';
            array_push($gagalArr, $gagal[0]);
        } else {
            // File upload handling
            $targetDir = "surat_tugas/";
            $targetFile = $targetDir . basename($_FILES["surat_tugas"]["name"]);

            if (move_uploaded_file($_FILES["surat_tugas"]["tmp_name"], $targetFile)) {
                // Get other form data
                $nama = $_POST["nama"];
                $id_opd = $_POST["opd"];
                $id_acara = $_POST["nama_acara"];
                $email = $_POST["email"];
                $tahun_acara = $_POST["tahun_acara"];
                $tanggal_pengajuan = $_POST["tanggal_pengajuan"]; // Ambil tanggal_pengajuan dari $_POST
                $status_pengajuan = "Awaiting";

                // Insert data into the database
                $sql = "INSERT INTO pengajuan (nama, id_opd, id_acara, email, tahun_acara, tanggal_pengajuan, surat_tugas, status_pengajuan) VALUES ('$nama', '$id_opd','$id_acara', '$email', '$tahun_acara', '$tanggal_pengajuan', '$targetFile', '$status_pengajuan')";

                if ($conn->query($sql) === TRUE) {
                    $sukses = 'sukses';
                } else {
                    // echo "<script>alert('Error inserting data into the database: " . $conn->error . "');</script>";
                    $gagal[1] = 'gagal-database';
                    array_push($gagalArr, $gagal[1]);
                }
            } else {
                $gagal[2] = 'gagal-upload';
                array_push($gagalArr, $gagal[2]);
            }
        }
    }



    // Menutup koneksi
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Buat Pengajuan e-Sertifikat</title>

    <link href="/libs/images/icon-pemkab-kediri.png" rel="icon" type="images/x-icon">


    <!-- Bootstrap Core CSS -->
    <link href="/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/libs/bootstrap/dist/css/bootstrap-alert.min.css" rel="stylesheet">
    <link href="/libs/bootstrap/dist/css/alertify.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/dist/css/offline-font.css" rel="stylesheet">
    <link href="/dist/css/sertif.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="/libs/jquery/dist/jquery.min.js"></script>

    <!-- Alertify JS -->
    <script src="/libs/jquery/dist/alertify.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Your Other Scripts -->
    <script>
        $(document).ready(function() {
            // Inisialisasi datepicker pada input dengan nama "tanggal_acara"
            $('input[name="tanggal_acara"]').datepicker({
                format: 'dd MM yyyy',
                autoclose: true,
                todayHighlight: true,
                endDate: new Date() // Menetapkan tanggal maksimum sebagai tanggal sekarang
            });
        });
    </script>

</head>


<body>

    <div class="container">
        <div class="text-center">
            <img src="libs/images/logo-pemkab-kediri.png" width="64" height="auto" alt="Kominfo Logo">
            <h2>Buat Pengajuan e-Sertifikat</h2>
        </div>

        <?php if (isset($_POST) && !empty($gagal)) : ?>
            <div id="validationErrorAlert" class="alert alert-danger alert-dismissible" role="alert" style="margin-top : 20px; margin-bottom : 20px;">
                <a class="close" aria-label="close" id="validationErrorClose">&times;</a>

                <strong>Pengajuan e-Sertifikat gagal!</strong>
                <?php
                if (in_array("gagal-upload", $gagalArr)) {
                    echo "<br>Kesalahan upload pada server";
                }
                if (in_array("gagal-file-size", $gagalArr)) {
                    echo "<br>Ukuran File Melebihi 2 MB";
                }
                if (in_array("gagal-database", $gagalArr)) {
                    echo "<br>Kesalahan pada database";
                }
                ?>
                </button>
            </div>
        <?php elseif (isset($_POST) && !empty($sukses)) : ?>
            <div id="validationErrorAlert" class="alert alert-success alert-dismissible" role="alert" style="margin-top : 20px; margin-bottom : 20px;">
                <a class="close" aria-label="close" id="validationErrorClose">&times;</a>
                <strong>Pengajuan e-Sertifikat berhasil.<br>Mohon menunggu email pemberitahuan dari kami.<br>Terima kasih.</strong>
            </div>
        <?php endif; ?>
        <?php
        // Memanggil file koneksi.php
        // include("dist/config/koneksi.php");
        ?>


        <form action="pengajuan_sertifikat" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" autofocus required>
            </div>

            <div class="form-group">
                <label for="opd">OPD:</label>
                <select class="form-control" name="opd" required>
                    <option value="" disabled selected>Pilih OPD</option>
                    <?php
                    // Menyimpan hasil query ke dalam array
                    while ($row_opd = $result_opd->fetch_assoc()) {
                        echo "<option value='" . $row_opd['id_opd'] . "'>" . $row_opd['nama_opd'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="emailInput" placeholder="Masukkan Email" required>
                <div id="emailError" style="color: red; font-size: 14px; margin-top: 5px;"></div>
            </div>
            <div class="form-group">
                <label for="tahun_acara">Tahun Acara:</label>
                <select class="form-control" name="tahun_acara" required id="tahun">
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

            <div class="form-group">
                <label for="tanggal_acara"></label>
                <input type="hidden" name="tanggal_pengajuan" value="<?php echo date('Y-m-d H:i:s'); ?>">
            </div>

            <div class="form-group">
                <label for="nama_acara">Nama Acara : </label>
                <select class="form-control" name="nama_acara" id="nama_acara" required>
                    <option value="" disabled selected>Pilih Nama Acara</option>
                </select>
            </div>

            <div class="form-group">
                <label for="surat_tugas">Upload Surat Tugas (PDF): <br> Maks. 2 MB</label>
                <input type="file" class="form-control" name="surat_tugas" accept=".pdf" required>
            </div>

            <div class="form-group">
                <center><button type="submit" class="btn btn-primary">Kirim Pengajuan</button></center>
            </div>
        </form>
    </div>
    <div class="navbar-inverse navbar-fixed-bottom">
        <p class="text-center" style="color: #D1C4E9; margin: 0 0 5px; padding: 0"> <small><?= APP_TITLE ?><br>&copy; <?= date('Y') ?> &mdash; Dinas Komnikasi dan Informatika Kabupaten Kediri</p>
    </div><!-- /.footer-bottom -->

    <script>
        // Fungsi untuk memeriksa apakah email sesuai dengan kriteria
        function validateEmail() {
            var emailInput = document.getElementById('emailInput');
            var emailError = document.getElementById('emailError');
            // Regular expression untuk memeriksa format email
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            // Memeriksa apakah nilai email sesuai dengan pola
            if (!emailPattern.test(emailInput.value)) {
                // Menampilkan pesan kesalahan jika tidak sesuai
                emailError.innerHTML = 'Email tidak valid. Masukkan email dengan format yang benar.';
                return false;
            } else {
                // Menghapus pesan kesalahan jika email valid
                emailError.innerHTML = '';
                return true;
            }
        }
        // Mendengarkan perubahan pada input email dan memanggil fungsi validasi
        document.getElementById('emailInput').addEventListener('input', validateEmail);
    </script>
    <script>
        $(document).on('click', '.close', function() {
            $(this).closest('.alert').hide();
        });
    </script>
    <!-- Your Other Scripts -->
    <script>
        $(document).ready(function() {
            // Inisialisasi datepicker pada input dengan nama "tanggal_acara"
            $('input[name="tanggal_acara"]').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                startDate: new Date() // Menetapkan tanggal minimum ke tanggal sekarang
            });
        });
        // Fungsi untuk memeriksa apakah email sesuai dengan kriteria
        function validateEmail() {
            var emailInput = document.getElementById('emailInput');
            var emailError = document.getElementById('emailError');
            // Regular expression untuk memeriksa format email
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            // Memeriksa apakah nilai email sesuai dengan pola
            if (!emailPattern.test(emailInput.value)) {
                // Menampilkan pesan kesalahan jika tidak sesuai
                emailError.innerHTML = 'Email tidak valid. Masukkan email dengan format yang benar.';
                return false;
            } else {
                // Menghapus pesan kesalahan jika email valid
                emailError.innerHTML = '';
                return true;
            }
        }

        // Fungsi untuk menangani pengiriman formulir
        function validateAndSubmitForm(event) {
            // Validasi email
            if (!validateEmail()) {
                // Menampilkan alert kesalahan validasi
                document.getElementById('validationErrorAlert').style.display = 'block';
                event.preventDefault(); // Mencegah formulir dikirim jika validasi gagal
                return false;
            }
            // Validasi tanggal acara
            var selectedDate = $('input[name="tanggal_acara"]').datepicker('getDate');
            var currentDate = new Date();
            if (selectedDate > currentDate) {
                // Menampilkan alert kesalahan jika tanggal acara melebihi tanggal sekarang.
                alert("Tanggal acara tidak boleh melebihi tanggal sekarang.");
                event.preventDefault(); // Mencegah formulir dikirim jika validasi gagal
                return false;
            }
            // Sembunyikan alert kesalahan validasi jika sebelumnya ditampilkan
            document.getElementById('validationErrorAlert').style.display = 'none';
            return true;
            // Mengubah warna tombol submit menjadi biru
            var submitButton = document.querySelector('form button[type="submit"]');
            submitButton.classList.remove('btn-success'); // Menghapus kelas btn-success
            submitButton.classList.add('btn-primary'); // Menambahkan kelas btn-primary
        }

        // Hook ke acara onsubmit formulir untuk memanggil fungsi validasi
        document.querySelector('form').addEventListener('submit', validateAndSubmitForm);
    </script>

    <script>
        $(document).ready(function() {
            $("#tahun").change(function() {
                var selectedYear = $(this).val();
                var url = "<?= baseUrl('ajax.php') ?>"; // URL yang diperbaiki

                // Lakukan permintaan AJAX
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        tahun_acara: selectedYear
                    },
                    success: function(response) {
                        // Tampilkan nama acara sesuai dengan respon dari server
                        $('#nama_acara').html(response);
                    },
                    error: function() {
                        // Tangani kesalahan jika terjadi
                        alert('Terjadi kesalahan saat mengambil data nama acara.');
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>