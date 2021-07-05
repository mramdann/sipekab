<?php
include "_header.php";
include "koneksi.php";

$id_loker = $_GET['loker_id'];
$sql = $koneksi->query("select * from tbl_loker where id_loker = '$id_loker'");
$loker = $sql->fetch_assoc();

if (date("Y-m-d") >= $loker['tgl_berlaku']) {
    $status = "danger";
} else {
    $status = "success";
}
?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="card card-fluid">
            <div class="card-body">
                <header class="page-title-bar">
                    <div class="row text-center text-sm-left">
                        <div class="col-sm-auto col-12 mb-2">
                            <span class="tile tile-xl bg-<?= $status ?>">LK</span>
                        </div>

                        <div class="col">
                            <h1 class="page-title"> <?= $loker['judul_loker'] ?> </h1>

                            <ul class="timeline timeline-fluid mt-4">
                                <li class="timeline-item">
                                    <div class="timeline-figure">
                                        <span class="tile tile-circle tile-sm"><i class="fas fa-user-graduate fa-lg"></i></span>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="mb-0">
                                                    Pendidikan : <a href="#"><?= $loker['pendidikan'] ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <div class="timeline-figure">
                                        <span class="tile tile-circle tile-sm"><i class="fa fa-tasks fa-lg"></i></span>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="mb-0">
                                                    Jenis Pekerjaan : <a href="#"><?= $loker['jenis_pekerjaan'] ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <div class="timeline-figure">
                                        <span class="tile tile-circle tile-sm"><i class="fa fa-money-bill-wave fa-lg"></i></span>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="mb-0">
                                                    Gaji : <a href="#">Rp. <?= number_format($loker['gaji']) ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <div class="timeline-figure">
                                        <span class="tile tile-circle tile-sm bg-<?= $status ?>"><i class="far fa-calendar-times fa-lg"></i></span>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="mb-0">
                                                    Tgl Berlaku Loker : <a href="#"> <?= date("d F, Y", strtotime($loker['tgl_berlaku'])) ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <div class="timeline-figure">
                                        <span class="tile tile-circle tile-sm"><i class="far fa-calendar-alt fa-lg"></i></span>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="mb-0">
                                                    Tgl Update : <a href="#"> <?= date("d F, Y", strtotime($loker['tgl_update'])) ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
            <div class="card-body border-top">
                <?= $loker['deskripsi_pekerjaan'] ?>
            </div>
            <?php if (date("Y-m-d") <= $loker['tgl_berlaku']) { ?>
                <div class="card-body border-top">
                    <a href="lamar_pekerjaan.php?loker_id=<?= $loker['id_loker'] ?>" class="btn btn-primary btn-lg btn-block">Lamar Pekerjaan</a>
                </div>
            <?php } ?>
        </div>

    </div>
</section>

<?php
include "_footer.php";
?>