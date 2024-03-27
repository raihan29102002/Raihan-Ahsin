<?php
include("sess_check.php");
include_once("function.php");

if (isset($_GET['id'])) {
    $id_acara = $_GET['id'];

    // Fetch existing data for the specified ID
    $sql_fetch = "SELECT id_acara, nama_acara, tahun, durasi FROM master_acara WHERE id_acara=?";
    $stmt_fetch = mysqli_prepare($conn, $sql_fetch);
    mysqli_stmt_bind_param($stmt_fetch, "i", $id_acara);
    mysqli_stmt_execute($stmt_fetch);
    $result_fetch = mysqli_stmt_get_result($stmt_fetch);


    // Check if data exists for the specified ID
    if ($row = mysqli_fetch_assoc($result_fetch)) {
        // Assign data to $data array for use in the form
        $data = $row;

        // deskripsi halaman
        $pagedesc = "Edit Acara";
        $menuparent = "master";
        include("layout_top.php");
?>

        <!-- top of file -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Acara</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" action="acara_update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_acara" value="<?php echo $data['id_acara']; ?>">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Edit Data</h3>
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
                                                $selected = ($year == $data['tahun']) ? 'selected' : '';
                                                echo "<option value=\"$year\" $selected>$year</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Nama Acara</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="nama_acara" class="form-control" placeholder="Acara" value="<?php echo $data['nama_acara'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Durasi (Menit)</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="durasi" class="form-control" placeholder="Durasi Dalam Satuan Menit" value="<?php echo isset($data['durasi']) ? $data['durasi'] : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-4 text-right">
                                            <button type="submit" name="perbarui" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.panel -->
                        </form>

                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->

        <!-- bottom of file -->
<?php
        include("layout_bottom.php");
    } else {
        // Handle the case where no data is found for the specified ID
        echo "Data dengan ID Acara tersebut tidak ditemukan.";
    }
} else {
    // Tangani jika ID OPD tidak diberikan
    echo "ID Acara tidak valid atau tidak diberikan.";
}

?>