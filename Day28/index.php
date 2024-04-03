<?php
require 'vendor/autoload.php';
require 'csv.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #343a40;
        color: #fff;
    }

    .container {
        margin-top: 50px;
    }

    table {
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Data Penduduk</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Alamat</th>
                    <th>Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataPenduduk as $penduduk): ?>
                <tr>
                    <td><?= $penduduk['Nama']; ?></td>
                    <td><?= $penduduk['Usia']; ?></td>
                    <td><?= $penduduk['Alamat']; ?></td>
                    <td><?= $penduduk['Pekerjaan']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="data_penduduk.csv" class="btn btn-success">Download CSV</a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>