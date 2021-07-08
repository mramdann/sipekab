<?php
$view = $_GET['aksi'];

echo "<title>" . $view . " laporan data calon karyawan</title>";
include "_header.php";
include "_menu.php";
?>
<main class="app-main">
    <div class="wrapper">
        <div class="page">
            <div class="page-inner">

                <?php if ($view == 'list' or $view == NULL) { ?>

                    <!-- tampilan laporan calon karyawan -->
                    <div class="page-section">
                        <div class="card card-fluid">
                            <div class="card-body">

                                <form method="get">
                                    <fieldset>
                                        <legend>Filter Laporan</legend>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <select name="loker" class="form-control" required>
                                                        <option value="">-- Pilih laporan berdasarkan loker --</option>
                                                        <?php
                                                        $sql = $koneksi->query("select * from tbl_loker order by id_loker desc");
                                                        while ($data = $sql->fetch_assoc()) { ?>
                                                            <option value="<?= $data['id_loker'] ?>"><?= $data['judul_loker'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1"><button class="btn btn-primary" type="submit">Tampil</button></div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($_GET['loker'])) {
                        $idloker = $_GET['loker']; ?>
                        <header class="page-title-bar">
                            <div class="d-flex justify-content-between">
                                <h1 class="page-title mr-sm-auto"> Data calon karyawan </h1>
                                <div class="btn-toolbar">
                                    <a href="cetak.php?loker=<?= $_GET['loker'] ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> <span class="ml-1">Cetak</span></a>
                                </div>
                            </div>
                        </header>
                        <div class="page-section">
                            <div class="card card-fluid">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th> No </th>
                                                <th> No Pendaftaran </th>
                                                <th> Nama Lengkap </th>
                                                <th> Jenis Kelamin </th>
                                                <th> Status Nikah </th>
                                                <th> Email </th>
                                                <th> No HP </th>
                                                <th> Pendidikan </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            $query = $koneksi->query("select * from tbl_lamaran_pekerjaan where status='Diterima' and id_loker = '$idloker' order by nama_lengkap asc");
                                            while ($data = $query->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td> <?= $no ?> </td>
                                                    <td> <?= $data['no_pendaftaran'] ?> </td>
                                                    <td> <?= $data['nama_lengkap'] ?> </td>
                                                    <td> <?= $data['jk'] ?> </td>
                                                    <td> <?= $data['status_nikah'] ?> </td>
                                                    <td> <?= $data['email'] ?> </td>
                                                    <td> <?= $data['tlp'] ?> </td>
                                                    <td> <?= $data['pendidikan_terakhir'] ?> </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- # tampilan data user -->
                <?php } ?>


            </div>
        </div>
</main>

<?php
include "_footer.php";
?>