<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Acara TBN Indonesia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Acara Untuk TBN Indonesia</h2>
        <form action="input_acara.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_acara">Nama Acara:</label>
                <input type="text" class="form-control" id="nama_acara" name="nama_acara" required>
            </div>

            <div class="form-group">
                <label for="tanggal_acara">Tanggal Acara:</label>
                <input type="date" class="form-control" id="tanggal_acara" name="tanggal_acara" required>
            </div>

            <div class="form-group">
                <label for="tempat_acara">Tempat Acara:</label>
                <input type="text" class="form-control" id="tempat_acara" name="tempat_acara" required>
            </div>

            <div class="form-group">
                <label for="gambar_brosur">Gambar Brosur:</label>
                <input type="file" class="form-control-file" id="gambar_brosur" name="gambar_brosur">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Acara</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>