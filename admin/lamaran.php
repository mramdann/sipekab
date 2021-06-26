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
                                                        <span class="text-muted"><i class="far fa-fw fa-calendar"></i> <?= date("M d, Y", strtotime($data['tgl_update'])) ?> </span>
                                                    </span>
                                                </div>
                                                <ul class="list-inline text-muted mb-0">
                                                    <li class="list-inline-item">
                                                        <i class="fas fa-users"></i> Jumlah pelamar 15
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="list-group-item-figure">
                                            <a href="loker.php?aksi=edit&id=<?= $data['id_loker'] ?>" class="btn btn-sm btn-icon btn-light mr-2"><i class="fas fa-info-circle text-info mt-2"></i></i></a>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                    </div>
                    <!-- # tampilan data loker -->


                <?php } else if ($view == 'tambah') {

                    // Syntax untuk menyimpan data ke tbl_user jika tombol simpan ditekan
                    if (isset($_POST['simpan'])) {
                        $username = $_POST['username'];
                        $nama_user = $_POST['nama_user'];
                        $pass = $_POST['pass'];

                        $query_simpan = $koneksi->query("INSERT INTO tbl_user (username, pass, nama_user) VALUES ('$username','$pass','$nama_user')");

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
                                        <input type="hidden" name="id_loker" id="id_loker">
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
                    </form>
                    <!-- # tampilan Tambah data loker -->

                <?php } else if ($view == 'edit') {
                    // menangkap id yang akan di edit dari url 
                    $id = $_GET['id'];
                    // ambil data berdasarkan id yang dikirim url lalu tampilkan di form edit
                    $sql = $koneksi->query("SELECT * FROM tbl_user WHERE id_user = '$id'");
                    $data = $sql->fetch_assoc();

                    // Syntax untuk update/edit data ke tbl_user jika tombol simpan di tekan
                    if (isset($_POST['update'])) {
                        $username = $_POST['username'];
                        $nama_user = $_POST['nama_user'];
                        $pass = $_POST['pass'];

                        $query_simpan = $koneksi->query("UPDATE tbl_user SET username='$username', pass='$pass', nama_user='$nama_user' WHERE id_user = '$id'");

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
                    <div class="page-section">
                        <div class="card card-fluid">
                            <div lass="card">
                                <div class="card-body">

                                    <form method="POST">
                                        <fieldset>
                                            <legend>Form Edit User</legend>
                                            <div class="form-group">
                                                <label for="username">Username </label>
                                                <input type="text" class="form-control" name="username" id="username" value="<?= $data['username'] ?>" placeholder="Input username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_user">Nama Lengkap </label>
                                                <input type="text" class="form-control" name="nama_user" id="nama_user" value="<?= $data['nama_user'] ?>" placeholder="Input nama lengkap" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pass">Password </label>
                                                <input type="password" class="form-control" name="pass" id="pass" value="<?= $data['pass'] ?>" placeholder="Input password" required>
                                            </div>
                                        </fieldset>
                                        <div class="form-actions text-center">
                                            <button class="btn btn-primary" type="submit" name="update">Simpan</button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- # tampilan Edit data loker -->

                <?php } else if ($view == 'hapus') { ?>
                    <!-- # syntax Hapus data loker -->
                    <?php
                    $id = $_GET['id'];
                    $query_hapus = $koneksi->query("delete from tbl_user where id_user = '$id' ");
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