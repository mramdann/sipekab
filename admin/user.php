<?php
$view = $_GET['aksi'];

echo "<title>" . $view . " data user</title>";
include "_header.php";
include "_menu.php";
?>
<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">

        <?php if ($view == 'list' or $view == NULL) { ?>
          <!-- tampilan data user -->
          <header class="page-title-bar">
            <div class="d-md-flex align-items-md-start">
              <h1 class="page-title mr-sm-auto"> Data User </h1>
              <div class="btn-toolbar">
                <a href="user.php?aksi=tambah" class="btn btn-success"><i class="fa fa-plus"></i> <span class="ml-1">Tambah User</span></a>
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
                      <th> Username </th>
                      <th> Password </th>
                      <th> Nama User </th>
                      <th> Aksi </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    $query = $koneksi->query("select * from tbl_user order by id_user desc");
                    while ($data = $query->fetch_assoc()) {
                    ?>
                      <tr>
                        <td> <?= $no ?> </td>
                        <td> <?= $data['username'] ?> </td>
                        <td> <?= $data['pass'] ?> </td>
                        <td> <?= $data['nama_user'] ?> </td>
                        <td>
                          <a href="user.php?aksi=hapus&id=<?= $data['id_user'] ?>" onclick="return confirm('Yakin akan mengahapus data ini ?')" class="btn btn-light btn-sm text-danger">Hapus</a>
                          <a href="user.php?aksi=edit&id=<?= $data['id_user'] ?>" class="btn btn-light btn-sm text-primary">Edit</a>
                        </td>
                      </tr>
                    <?php $no++;
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- # tampilan data user -->


        <?php } else if ($view == 'tambah') {

          // Syntax untuk menyimpan data ke tbl_user jika tombol simpan ditekan
          if (isset($_POST['simpan'])) {
            $username = $_POST['username'];
            $nama_user = $_POST['nama_user'];
            $pass = $_POST['pass'];

            $query_simpan = $koneksi->query("INSERT INTO tbl_user (username, pass, nama_user) VALUES ('$username','$pass','$nama_user')");

            if ($query_simpan) {
              echo "<script>alert('Data berhasil disimpan !')</script>";
              echo "<script>location='user.php?aksi=list'</script>";
            } else {
              echo "<script>alert('Data gagal disimpan !')</script>";
              echo "<script>location='user.php?aksi=tambah'</script>";
            }
          } ?>

          <!-- # tampilan Tambah data user -->
          <header class="page-title-bar">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                  <a href="user.php?aksi=list"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i> Kembali</a>
                </li>
              </ol>
            </nav>
            <div class="d-md-flex align-items-md-start">
              <h1 class="page-title mr-sm-auto"> Tambah Data User </h1>
            </div>
          </header>
          <div class="page-section">
            <div class="card card-fluid">
              <div lass="card">
                <div class="card-body">

                  <form method="POST">
                    <fieldset>
                      <legend>Form Tambah User</legend>
                      <div class="form-group">
                        <label for="username">Username </label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Input username" required>
                      </div>
                      <div class="form-group">
                        <label for="nama_user">Nama Lengkap </label>
                        <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Input nama lengkap" required>
                      </div>
                      <div class="form-group">
                        <label for="pass">Password </label>
                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Input password" required>
                      </div>
                    </fieldset>
                    <div class="form-actions text-center">
                      <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                    </div>

                  </form>
                </div>
              </div>

            </div>
          </div>
          <!-- # tampilan Tambah data user -->

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
              echo "<script>location='user.php?aksi=list'</script>";
            } else {
              echo "<script>alert('Data gagal diedit !')</script>";
              echo "<script>location='user.php?aksi=edit&id=$id'</script>";
            }
          }  ?>

          <!-- # tampilan Edit data user -->
          <header class="page-title-bar">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                  <a href="user.php?aksi=list"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i> Kembali</a>
                </li>
              </ol>
            </nav>
            <div class="d-md-flex align-items-md-start">
              <h1 class="page-title mr-sm-auto"> Edit Data User </h1>
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
          <!-- # tampilan Edit data user -->

        <?php } else if ($view == 'hapus') { ?>
          <!-- # syntax Hapus data user -->
          <?php
          $id = $_GET['id'];
          $query_hapus = $koneksi->query("delete from tbl_user where id_user = '$id' ");
          if ($query_hapus) {
            echo "<script>alert('Data berhasil dihapus dari database !')</script>";
          } else {
            echo "<script>alert('Data gagal dihapus dari database !')</script>";
          }
          echo "<script>location='user.php?aksi=list'</script>";
          ?>
          <!-- # Syntax Hapus data user -->
        <?php } ?>


      </div>
    </div>
</main>

<?php
include "_footer.php";
?>