<?php
$view = $_GET['aksi'];

echo "<title>" . $view . " pelamar kerja</title>";
include "_header.php";
include "_menu.php";
?>
<main class="app-main">
    <div class="wrapper">
        <div class="page">
            <div class="page-inner">

                <?php if ($view == 'list' or $view == NULL) { ?>

                    <!-- tampilan data loker -->
                    <header class="page-title-bar">
                        <div class="d-flex justify-content-between">
                            <h1 class="page-title mr-sm-auto"> Data Pelamar Kerja </h1>
                        </div>
                    </header>
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
                                                        <a href="lamaran.php?aksi=detail&id=<?= $data['id_loker'] ?>"><?= $data['judul_loker'] ?></a>
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
                                            <a href="lamaran.php?aksi=detail&id=<?= $data['id_loker'] ?>" class="btn btn-sm btn-icon btn-light mr-2"><i class="fas fa-info-circle text-info mt-2"></i></i></a>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                    </div>
                    <!-- # tampilan data loker -->

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

                    <!-- # tampilan detail data loker -->
                    <header class="page-title-bar">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    <a href="lamaran.php?aksi=list"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i> Kembali</a>
                                </li>
                            </ol>
                        </nav>
                        <div class="d-md-flex align-items-md-start">
                            <h1 class="page-title mr-sm-auto"> Daftar pelamar kerja</h1>
                        </div>
                    </header>
                    <div id="accordion2" class="card-expansion">
                        <div class="card card-expansion-item">
                            <div class="card-header border-0" id="headingOne2">
                                <button class="btn btn-reset d-flex justify-content-between w-100 collapsed" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseOne2"><span>Data lowongan kerja</span> <span class="collapse-indicator"><i class="fa fa-fw fa-chevron-down"></i></span></button>
                            </div>
                            <div id="collapseOne2" class="collapse" aria-labelledby="headingOne2" data-parent="#accordion2">
                                <div class="card-body pt-0">
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-section">
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
                                                <h2 class="section-title"> Detail Pelamar </h2>
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
                                                        <td width="210px">Email</td>
                                                        <td><?= $data['email'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="210px">Nomor Telepon </td>
                                                        <td><?= $data['tlp'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="210px">Pendidikan Terakhir</td>
                                                        <td><?= $data['pendidikan_terakhir'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="210px">Alamat</td>
                                                        <td><?= $data['alamat'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="210px">Ringkasan Profile</td>
                                                        <td><cite><?= $data['deskripsi'] ?></cite></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="210px">Berkas Lamaran (CV)</td>
                                                        <td><a target="_blank" href="../cv/<?= $data['cv'] ?>"><i class="fas fa-file"></i> <?= $data['cv'] ?></a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <?php if ($data['status'] == "Proses seleksi") {  ?>
                                                <div class="card-footer">
                                                    <a href="lamaran.php?aksi=acc&id=<?= $data['id_lamaran'] ?>" class="card-footer-item card-footer-item-bordered text-success">Terima</a>
                                                    <a href="lamaran.php?aksi=tolak&id=<?= $data['id_lamaran'] ?>" class="card-footer-item card-footer-item-bordered text-warning">Tolak</a>
                                                    <a href="lamaran.php?aksi=hapus&id=<?= $data['id_lamaran'] ?>" class="card-footer-item card-footer-item-bordered text-danger">Hapus</a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php $no++;
                                } ?>
                            </div>
                        </div>
                    </div>

                <?php } else if ($view == 'acc') { ?>
                    <!-- # syntax udapte data loker -->
                    <?php
                    $id = $_GET['id'];
                    $query_acc = $koneksi->query("UPDATE tbl_lamaran_pekerjaan SET status='Diterima' WHERE id_lamaran = '$id' ");
                    if ($query_acc) {
                        echo "<script>alert('Data lamaran berhasil diterima !')</script>";
                    } else {
                        echo "<script>alert('Data lamaran gagal diterima !')</script>";
                    }
                    echo "<script>window.history.back();location.reload();</script>";
                    ?>
                    <!-- # Syntax udapte data loker -->

                <?php } else if ($view == 'tolak') { ?>
                    <!-- # syntax udapte data loker -->
                    <?php
                    $id = $_GET['id'];
                    $query_tolak = $koneksi->query("UPDATE tbl_lamaran_pekerjaan SET status='Ditolak' WHERE id_lamaran = '$id' ");
                    if ($query_tolak) {
                        echo "<script>alert('Data lamaran berhasil ditolak !')</script>";
                    } else {
                        echo "<script>alert('Data lamaran gagal ditolak !')</script>";
                    }
                    echo "<script>window.history.back();location.reload();</script>";

                    ?>
                    <!-- # Syntax udapte data loker -->

                <?php } else if ($view == 'hapus') { ?>
                    <!-- # syntax delete data loker -->
                    <?php
                    $id = $_GET['id'];
                    $query_hapus = $koneksi->query("DELETE FROM tbl_lamaran_pekerjaan WHERE id_lamaran= '$id'");
                    if ($query_hapus) {
                        echo "<script>alert('Data lamaran berhasil di hapus !')</script>";
                    } else {
                        echo "<script>alert('Data lamaran gagal di hapus !')</script>";
                    }
                    echo "<script>window.history.back();location.reload();</script>";
                    ?>
                    <!-- # Syntax udapte data loker -->



                <?php } ?>
            </div>
        </div>
</main>

<?php
include "_footer.php";
?>