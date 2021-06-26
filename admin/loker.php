<?php
$view = $_GET['aksi'];

echo "<title>" . $view . " data loker</title>";
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
                            <h1 class="page-title mr-sm-auto"> Data Lowongan Pekerjaan </h1>
                            <div class="btn-toolbar">
                                <a href="loker.php?aksi=tambah" class="btn btn-success"><i class="fa fa-plus"></i> <span class="ml-1">Tambah</span></a>
                            </div>
                        </div>
                    </header>
                    <div class="page-section">

                        <header class="page-navs bg-primary shadow-sm">
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
                                while ($data = $sql->fetch_assoc()) { ?>
                                    <div class="list-group-item mb-2">
                                        <div class="list-group-item-figure">
                                            <a href="javascript:void(0)" class="tile tile-circle bg-indigo text-white mr-1"><?= strtoupper(substr($data['judul_loker'], 0, 1)) ?></a>
                                        </div>
                                        <div class="list-group-item-body">
                                            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                                                <div class="team">
                                                    <h4 class="list-group-item-title">
                                                        <a href="loker.php?aksi=edit&id=<?= $data['id_loker'] ?>"><?= $data['judul_loker'] ?></a>
                                                    </h4>
                                                    <span class="timeline-date">
                                                        <span class="text-muted"><i class="far fa-fw fa-calendar-plus"></i> <?= date("M d, Y", strtotime($data['tgl_update'])) ?> </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item-figure">
                                            <a href="loker.php?aksi=edit&id=<?= $data['id_loker'] ?>" class="btn btn-sm btn-icon btn-light mr-2"><i class="oi oi-pencil text-primary mt-1"></i></a>
                                            <a href="loker.php?aksi=hapus&id=<?= $data['id_loker'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-icon btn-light mr-2"><i class="oi oi-trash text-danger mt-1"></i></a>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                    </div>
                    <!-- # tampilan data loker -->


                <?php } else if ($view == 'tambah') {

                    // Syntax untuk menyimpan data ke tbl_loker jika tombol simpan ditekan
                    if (isset($_POST['simpan'])) {
                        $judul_loker         = $_POST['judul_loker'];
                        $deskripsi_pekerjaan = $_POST['deskripsi_pekerjaan'];
                        $pendidikan          = $_POST['pendidikan'];
                        $gaji                = $_POST['gaji'];
                        $jenis_pekerjaan     = $_POST['jenis_pekerjaan'];
                        $tgl_berlaku         = $_POST['tgl_berlaku'];

                        $query_simpan = $koneksi->query("INSERT INTO tbl_loker (judul_loker, deskripsi_pekerjaan, pendidikan, gaji, jenis_pekerjaan, tgl_update, tgl_berlaku) 
                                                        VALUES ('$judul_loker', '$deskripsi_pekerjaan', '$pendidikan', '$gaji', '$jenis_pekerjaan', NOW(), '$tgl_berlaku')");

                        if ($query_simpan) {
                            echo "<script>alert('Data berhasil disimpan !')</script>";
                            echo "<script>location='loker.php?aksi=list'</script>";
                        } else {
                            echo "<script>alert('Data gagal disimpan !')</script>";
                            echo "<script>location='loker.php?aksi=tambah'</script>";
                        }
                    } ?>

                    <!-- # tampilan Tambah data loker -->
                    <header class="page-title-bar">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    <a href="loker.php?aksi=list"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i> Kembali</a>
                                </li>
                            </ol>
                        </nav>
                        <div class="d-md-flex align-items-md-start">
                            <h1 class="page-title mr-sm-auto"> Tambah Data loker </h1>
                        </div>
                    </header>

                    <form method="post">
                        <div class="section-block">
                            <div class="card">
                                <div class="card-body">
                                    <div class="publisher">
                                        <label for="judul" class="publisher-label">Judul loker</label>
                                        <div class="publisher-input">
                                            <textarea name="judul_loker" class="form-control" placeholder="Tulis judul loker" required></textarea>
                                        </div>
                                        <div class="publisher-actions">
                                            <div class="publisher-tools mr-auto"> </div>
                                            <button name="simpan" type="submit" class="btn btn-primary mr-3">Publish</button>
                                            <a href="loker.php?aksi=list" class="btn btn-light">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-block">
                            <div class="card">
                                <div class="card card-fluid">
                                    <textarea name="deskripsi_pekerjaan" data-toggle="summernote" data-placeholder="Tuliskan deskripsi pekerjaan disni..." data-height="500"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="section-block">
                            <div class="card">
                                <div class="card-body">
                                    <legend>Detail Kualifikasi</legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pendidikan">Pendidikan </label>
                                                <select class="form-control" name="pendidikan" required>
                                                    <option value="SMA/SMK/STM Sederajat">SMA/SMK/STM Sederajat</option>
                                                    <option value="Diploma (D1/D2/D3)">Diploma (D1/D2/D3)</option>
                                                    <option value="Sarjana (S1)">Sarjana (S1)</option>
                                                    <option value="Magister (S2)">Magister (S2)</option>
                                                    <option value="Doktor (S3)">Doktor (S3)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="gaji">Jumlah Upah/Gaji </label>
                                                <input type="number" class="form-control" name="gaji" placeholder="Input jumlah upah/gaji" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jenis_pekerjaan">Jenis Pekerjaan </label>
                                                <select class="form-control" name="jenis_pekerjaan" required>
                                                    <option value="Kontrak">Kontrak</option>
                                                    <option value="Full Time (Penuh Waktu)">Full Time (Penuh Waktu)</option>
                                                    <option value="Karyawan Tetap">Karyawan Tetap</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_berlaku">Loker berlaku s/d </label>
                                                <input type="date" class="form-control" name="tgl_berlaku" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- # tampilan Tambah data loker -->

                <?php } else if ($view == 'edit') {
                    // menangkap id yang akan di edit dari url 
                    $id = $_GET['id'];
                    // ambil data berdasarkan id yang dikirim url lalu tampilkan di form edit
                    $sql = $koneksi->query("SELECT * FROM tbl_loker WHERE id_loker = '$id'");
                    $data = $sql->fetch_assoc();

                    // Syntax untuk update/edit data ke tbl_loker jika tombol simpan di tekan
                    if (isset($_POST['update'])) {
                        $judul_loker         = $_POST['judul_loker'];
                        $deskripsi_pekerjaan = $_POST['deskripsi_pekerjaan'];
                        $pendidikan          = $_POST['pendidikan'];
                        $gaji                = $_POST['gaji'];
                        $jenis_pekerjaan     = $_POST['jenis_pekerjaan'];
                        $tgl_berlaku         = $_POST['tgl_berlaku'];

                        $query_simpan = $koneksi->query("UPDATE tbl_loker SET judul_loker='$judul_loker', deskripsi_pekerjaan='$deskripsi_pekerjaan', pendidikan='$pendidikan', gaji='$gaji', jenis_pekerjaan='$jenis_pekerjaan', tgl_update=NOW(), tgl_berlaku='$tgl_berlaku' WHERE id_loker = '$id'");

                        if ($query_simpan) {
                            echo "<script>alert('Data berhasil diedit !')</script>";
                            echo "<script>location='loker.php?aksi=list'</script>";
                        } else {
                            echo "<script>alert('Data gagal diedit !')</script>";
                            echo "<script>location='loker.php?aksi=edit&id=$id'</script>";
                        }
                    }  ?>

                    <!-- # tampilan Edit data loker -->
                    <header class="page-title-bar">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    <a href="loker.php?aksi=list"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i> Kembali</a>
                                </li>
                            </ol>
                        </nav>
                        <div class="d-md-flex align-items-md-start">
                            <h1 class="page-title mr-sm-auto"> Edit Data loker </h1>
                        </div>
                    </header>
                    <form method="post">
                        <div class="section-block">
                            <div class="card">
                                <div class="card-body">
                                    <div class="publisher">
                                        <label for="judul" class="publisher-label">Judul loker</label>
                                        <div class="publisher-input">
                                            <textarea name="judul_loker" class="form-control" placeholder="Tulis judul loker" required><?= $data['judul_loker'] ?></textarea>
                                        </div>
                                        <div class="publisher-actions">
                                            <div class="publisher-tools mr-auto"> </div>
                                            <button name="update" type="submit" class="btn btn-primary mr-3">Publish</button>
                                            <a href="loker.php?aksi=list" class="btn btn-light">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-block">
                            <div class="card">
                                <div class="card card-fluid">
                                    <textarea name="deskripsi_pekerjaan" data-toggle="summernote" data-placeholder="Tuliskan deskripsi pekerjaan disni..." data-height="500"><?= $data['deskripsi_pekerjaan'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="section-block">
                            <div class="card">
                                <div class="card-body">
                                    <legend>Detail Kualifikasi</legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pendidikan">Pendidikan </label>
                                                <select class="form-control" value="<?= $data['pendidikan'] ?>" name="pendidikan" required>
                                                    <option value="SMA/SMK/STM Sederajat">SMA/SMK/STM Sederajat</option>
                                                    <option value="Diploma (D1/D2/D3)">Diploma (D1/D2/D3)</option>
                                                    <option value="Sarjana (S1)">Sarjana (S1)</option>
                                                    <option value="Magister (S2)">Magister (S2)</option>
                                                    <option value="Doktor (S3)">Doktor (S3)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="gaji">Jumlah Upah/Gaji </label>
                                                <input type="number" class="form-control" name="gaji" value="<?= $data['gaji'] ?>" placeholder="Input jumlah upah/gaji" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jenis_pekerjaan">Jenis Pekerjaan </label>
                                                <select class="form-control" name="jenis_pekerjaan" value="<?= $data['jenis_pekerjaan'] ?>" required>
                                                    <option value="Kontrak">Kontrak</option>
                                                    <option value="Full Time (Penuh Waktu)">Full Time (Penuh Waktu)</option>
                                                    <option value="Karyawan Tetap">Karyawan Tetap</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_berlaku">Loker berlaku s/d </label>
                                                <input type="date" class="form-control" value="<?= $data['tgl_berlaku'] ?>" name="tgl_berlaku" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- # tampilan Edit data loker -->

                <?php } else if ($view == 'hapus') { ?>
                    <!-- # syntax Hapus data loker -->
                    <?php
                    $id = $_GET['id'];
                    $query_hapus = $koneksi->query("delete from tbl_loker where id_loker = '$id' ");
                    if ($query_hapus) {
                        echo "<script>alert('Data berhasil dihapus dari database !')</script>";
                    } else {
                        echo "<script>alert('Data gagal dihapus dari database !')</script>";
                    }
                    echo "<script>location='loker.php?aksi=list'</script>";
                    ?>
                    <!-- # Syntax Hapus data loker -->
                <?php } ?>


            </div>
        </div>
</main>

<?php
include "_footer.php";
?>