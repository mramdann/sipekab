<?php
$view = $_GET['aksi'];
include "_header.php";
include "koneksi.php";
?>


<section class="py-5 bg-light">
    <div class="container">
        <?php if ($view == 'list' or $view == NULL) { ?>

            <h1 class="page-title text-center"> Pengumuman Hasil Seleksi </h1>
            <div class="card card-fluid mt-4">
                <div class="card-body">
                    <div class="page-section">
                        <header class="page-navs bg-success shadow-sm">
                            <div class="input-group has-clearable">
                                <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                                <label class="input-group-prepend" for="searchClients"><span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span></label>
                                <input type="text" class="form-control" id="searchClients" data-filter=".board .list-group-item" placeholder="Cari data loker ...">
                            </div>
                        </header>

                        <div class="board p-0 perfect-scrollbar">
                            <div class="list-group list-group-flush list-group-bordered list-group-divider shadow-sm" data-toggle="radiolist">

                                <?php
                                $sql = $koneksi->query("select * from tbl_loker order by id_loker desc");
                                while ($data = $sql->fetch_assoc()) {
                                    $id_loker = $data['id_loker'];
                                    $query = $koneksi->query("SELECT COUNT(*) AS JLH FROM tbl_lamaran_pekerjaan WHERE id_loker ='$id_loker'");
                                    $jlh = $query->fetch_assoc();
                                    $jumlah_pelamar = $jlh['JLH']; ?>
                                    <div class="list-group-item mb-2">
                                        <div class="list-group-item-figure">
                                            <a href="javascript:void(0)" class="tile tile-circle bg-indigo text-white mr-1"><?= strtoupper(substr($data['judul_loker'], 0, 1)) ?></a>
                                        </div>
                                        <div class="list-group-item-body">
                                            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                                                <div class="team">
                                                    <h4 class="list-group-item-title">
                                                        <a href="pengumuman.php?aksi=detail&id=<?= $data['id_loker'] ?>"><?= $data['judul_loker'] ?></a>
                                                    </h4>
                                                    <span class="timeline-date">
                                                        <span class="text-muted"><i class="far fa-fw fa-calendar"></i> <?= date("M d, Y", strtotime($data['tgl_update'])) ?> </span>
                                                    </span>
                                                </div>
                                                <ul class="list-inline text-muted mb-0">
                                                    <li class="list-inline-item">
                                                        <i class="fas fa-users"></i> Jumlah pelamar <?= $jumlah_pelamar ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="list-group-item-figure">
                                            <a href="pengumuman.php?aksi=detail&id=<?= $data['id_loker'] ?>" class="btn btn-sm btn-icon btn-light mr-2"><i class="fas fa-info-circle text-info mt-2"></i></i></a>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        <?php } else if ($view == 'detail') {
            // menangkap id yang akan di edit dari url 
            $id = $_GET['id'];
            // ambil data berdasarkan id yang dikirim url lalu tampilkan
            $sql = $koneksi->query("select * from tbl_loker where id_loker = '$id'");
            $loker = $sql->fetch_assoc();

            if (date("Y-m-d") >= $loker['tgl_berlaku']) {
                $status = "danger";
            } else {
                $status = "success";
            } ?>

            <h1 class="page-title text-center"> Pengumuman Hasil Seleksi </h1>
            <h1 class="page-title text-center"> <?= $loker['judul_loker'] ?> </h1>

            <div class="page-section mt-4">
                <div class="card">
                    <div id="accordion" class="card-expansion">
                        <?php $no = 1;
                        $id = $_GET['id'];
                        $query = $koneksi->query("select * from tbl_lamaran_pekerjaan WHERE id_loker= '$id' order by id_lamaran desc");
                        while ($data = $query->fetch_assoc()) {
                            if ($data['status'] == "Proses seleksi") {
                                $warna = "warning";
                            } else if ($data['status'] == "Diterima") {
                                $warna = "success";
                            } else {
                                $warna = "danger";
                            }
                        ?>

                            <div class="card card-expansion-item">
                                <div class="card-header border-0" id="heading<?= $no ?>">
                                    <button class="btn btn-reset d-flex justify-content-between w-100 collapsed" data-toggle="collapse" data-target="#collapse<?= $no ?>" aria-expanded="false" aria-controls="collapse<?= $no ?>"><a href="#" class="btn-account" role="button">
                                            <div class="user-avatar">
                                                <i class="far fa-user"></i>
                                            </div>
                                            <div class="account-summary">
                                                <h5 class="account-name mb-2"> <?= $data['nama_lengkap'] ?> </h5>
                                                <p class="account-description"> <span class="badge badge-<?= $warna ?>"><?= $data['status'] ?></span> · <?= $data['jk'] ?> <span class="mx-1"> · </span> <?= $data['pendidikan_terakhir'] ?></span></p>
                                            </div>
                                        </a>
                                        <span class="collapse-indicator"><i class="fa fa-fw fa-chevron-down"></i></span>
                                    </button>
                                </div>
                                <div id="collapse<?= $no ?>" class="collapse" aria-labelledby="heading<?= $no ?>" data-parent="#accordion">
                                    <div class="card-body pt-0">
                                        <h2 class="section-title"> Detail Data Pelamar </h2>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="210px">Nama Lengkap</td>
                                                <td><?= $data['nama_lengkap'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width="210px">Jenis Kelamin</td>
                                                <td><?= $data['jk'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width="210px">Status Pernikahan </td>
                                                <td><?= $data['status_nikah'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width="210px">Pendidikan Terakhir</td>
                                                <td><?= $data['pendidikan_terakhir'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width="210px">Alamat</td>
                                                <td><?= $data['alamat'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php $no++;
                        } ?>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</section>

<?php
include "_footer.php";
?>