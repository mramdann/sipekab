<title>Lowongan Pekerjaan</title>
<?php
include "_header.php";
include "koneksi.php";
?>

<section class="py-5 bg-light" data-aos="fade-in">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 text-center">
                <h2> Lowongan Pekerjaan </h2>
                <p class="lead text-muted mb-6"> Pendaftaran gratis tidak di pungut biaya ! </p>
            </div>

            <?php $sql = $koneksi->query("select * from tbl_loker order by id_loker desc");
            while ($loker = $sql->fetch_assoc()) :
                $id_loker = $loker['id_loker'];
                $query = $koneksi->query("SELECT COUNT(*) AS JLH FROM tbl_lamaran_pekerjaan WHERE id_loker ='$id_loker'");
                $jlh = $query->fetch_assoc();
                $jumlah_pelamar = $jlh['JLH'];

                if (date("Y-m-d") >= $loker['tgl_berlaku']) {
                    $icon = '<span class="badge bg-muted" data-toggle="tooltip" data-placement="bottom" title="Ditutup"><span class="sr-only">Ditutup</span> Status : <i class="fa fa-fw fa-times-circle text-danger"></i></span>';
                    $status = "danger";
                } else {
                    $icon = '<span class="badge bg-muted" data-toggle="tooltip" data-placement="bottom" title="Tersedia"><span class="sr-only">Tersedia</span> Status : <i class="fa fa-fw fa-check-circle text-teal"></i></span>';
                    $status = "success";
                }

            ?>

                <div class="col-lg-6 col-xl-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card card-fluid">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <?= $icon ?>
                                <span class="badge bg-muted" data-toggle="tooltip" data-placement="bottom" title="Deadline"><span class="sr-only">Deadline</span> <i class="fa fa-calendar-alt text-muted mr-1"></i> <?= date("d M Y", strtotime($loker['tgl_berlaku'])) ?></span>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="has-badge mb-3">
                                <a href="loker_detail.php?loker_id=<?= $loker['id_loker'] ?>" class="tile tile-lg bg-<?= $status ?>">LK</a> <a href="#team" class="user-avatar user-avatar-xs"><img src="assets/images/avatars/team4.jpg" alt=""></a>
                            </div>
                            <h5 class="card-title">
                                <a href="loker_detail.php?loker_id=<?= $loker['id_loker'] ?>"><?= $loker['judul_loker'] ?></a>
                            </h5>
                            <p class="card-subtitle text-muted mb-3"> Progress in 93% - Last update 8h </p>
                            <p class="skills mb-3">
                                <a href="loker_detail.php?loker_id=<?= $loker['id_loker'] ?>" class="btn btn-xs btn-outline-secondary circle mt-1"><?= $loker['pendidikan'] ?></a>
                                <a href="loker_detail.php?loker_id=<?= $loker['id_loker'] ?>" class="btn btn-xs btn-warning circle mt-1"><?= $loker['jenis_pekerjaan'] ?></a>
                            </p>
                            <div class="my-3">
                                <a href="loker_detail.php?loker_id=<?= $loker['id_loker'] ?>" class="btn btn-<?= $status ?> btn-sm circle">View detail <i class="fa fa-arrow-right ml-1"></i></a>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <strong>Gaji</strong> <span class="d-block">Rp. <?= number_format($loker['gaji']) ?></span>
                                </div>
                                <div class="col">
                                    <strong>Pelamar</strong> <span class="d-block"><?= $jumlah_pelamar ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-xs" data-toggle="tooltip" title="93%">
                            <div class="progress-bar bg-<?= $status ?>" role="progressbar" aria-valuenow="3981" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">93% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile ?>

        </div>
    </div>
</section>

<?php
include "_footer.php";
?>