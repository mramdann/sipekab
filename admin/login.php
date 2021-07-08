<?php
session_start();
if (isset($_SESSION['profile'])) {
  echo "<script>location='.'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Login</title>

  <meta name="theme-color" content="#3063A0">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../assets/stylesheets/theme.min.css" data-skin="default">
  <link rel="stylesheet" href="../assets/stylesheets/theme-dark.min.css" data-skin="dark">
  <link rel="stylesheet" href="../assets/stylesheets/custom.css">
  <script>
    var skin = localStorage.getItem('skin') || 'default';
    var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
    // Disable unused skin immediately
    disabledSkinStylesheet.setAttribute('rel', '');
    disabledSkinStylesheet.setAttribute('disabled', true);
    // add loading class to html immediately
    document.querySelector('html').classList.add('loading');
  </script><!-- END THEME STYLES -->
</head>

<body>
  <main class="auth auth-floated">
    <!-- form -->
    <form class="auth-form" method="POST">
      <div class="mb-4">
        <div class="mb-3">
          <img class="rounded" src="../assets/images/logo.jpg" alt="" height="32">
        </div>
        <h1 class="h3"> Login form </h1>
      </div>

      <div class="form-group mb-4">
        <label class="d-block text-left" for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Input username" required="" autofocus="">
      </div>

      <div class="form-group mb-4">
        <label class="d-block text-left" for="pass">Password</label>
        <input type="password" id="pass" name="pass" class="form-control form-control-lg" placeholder="password" required="">
      </div>

      <div class="form-group mb-4">
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>
      </div>
      <p class="mb-0 px-3 text-muted text-center"> © 2021 All Rights Reserved. PT STARPIA CAMPAKA PURWAKARTA. By Siti Hardianti Sunarya</p>
    </form>

    <!-- Proses Login -->
    <?php
    include "../koneksi.php";
    if (isset($_POST["login"])) {
      $username = $_POST['username'];
      $pass = $_POST['pass'];

      $query = $koneksi->query("SELECT * FROM tbl_user WHERE username='$username' AND pass='$pass'");
      $hasil = $query->num_rows;

      if ($hasil == 1) {
        $profile = $query->fetch_assoc();
        $_SESSION['profile'] = $profile;

        echo "<script>alert('Login Berhasil !')</script>";
        echo "<script>location='.'</script>";
      } else {
        echo "<script>alert('Login gagal !')</script>";
        echo "<script>location='login.php'</script>";
      }
    }
    ?>

    <div id="announcement" class="auth-announcement">
      <div class="announcement-body">
        <h2 class="announcement-title"> Sistem Informasi Penerimaan Karyawan Baru PT. STARPIA ARTWORK CENTER PURWAKARTA </h2><a href="../loker.php" class="btn btn-warning"><i class="fa fa-fw fa-angle-right"></i> Check Loker</a>
      </div>
    </div>
  </main>

  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/popper.js/umd/popper.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/javascript/theme.min.js"></script>

</body>

</html>