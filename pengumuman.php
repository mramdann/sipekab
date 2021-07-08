<?php
include "_header.php";
include "koneksi.php";
?>


<section class="py-5 bg-light">
    <div class="container">
        <div class="card card-fluid">
            <div class="card-body text-center mb-4">
                <h2 class="card-title mb-4"> Pengumuman Hasil Seleksi </h2>
                <form method="get">
                    <div class="form-group">
                        <div class="input-group input-group-lg circle">
                            <div class="input-group-prepend">
                                <button class="btn btn-reset text-primary" type="submit">CK-</button>
                            </div>
                            <input type="number" name="cari" class="form-control" placeholder="Masukan no pendaftaran" required="" autofocus="">
                            <div class="input-group-prepend">
                                <button class="btn btn-reset text-primary px-3" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['cari'])) {
        $nopendaftaran = "CK-" . $_GET['cari'];
        $sql = $koneksi->query("SELECT * FROM tbl_lamaran_pekerjaan WHERE no_pendaftaran = '$nopendaftaran'");
        $hasil = $sql->num_rows;
        $data = $sql->fetch_assoc();
        if ($data['status'] == "Diterima") {
            $status = '<p class="display-4 text-center"><span class="badge badge-success">Diterima</span></p>';
        } else if ($data['status'] == "Proses seleksi") {
            $status = '<p class="display-4 text-center"><span class="badge badge-warning">Proses seleksi</span></p>';
        } else {
            $status = '<p class="display-4 text-center"><span class="badge badge-danger">Ditolak</span></p>';
        }

    ?>
        <main class="auth">
            <div class="container text-center mb-3">
                Hasil pencarian dengan no pendaftaran : <strong> <cite><?= $nopendaftaran ?></cite> </strong>
            </div>
            <form class="card auth-form">
                <?php if ($hasil == 1) { ?>
                    <div class="text-center">
                        <span class="tile tile-circle tile-xxl"><i class="fas fa-user fa-lg"></i></span>
                        <h2 class="card-title mt-4"> <?= $data['nama_lengkap'] ?> </h2>
                        <p> <?= $data['email'] ?> <br> <?= $data['tlp'] ?> <br> <?= $data['jk'] ?> <br> <?= $data['pendidikan_terakhir'] ?></p>
                    </div>
                    <?= $status ?>
                <?php } else { ?>
                    <h3 class="state-header text-center"> Data tidak ditemukan! </h3>
                <?php } ?>

            </form>
        </main>
    <?php } ?>

</section>

<?php
include "_footer.php";
?>