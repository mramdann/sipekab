<?php session_start();
if (empty($_SESSION['profile'])) {
  echo "<script>location='../login.php'</script>";
}
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Halaman utama admin </title>

  <meta name="theme-color" content="#3063A0">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/open-iconic/font/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../assets/stylesheets/theme.min.css" data-skin="default">
  <link rel="stylesheet" href="../assets/vendor/summernote/summernote-bs4.min.css" data-skin="default">
  <link rel="stylesheet" href="../assets/stylesheets/theme-dark.min.css" data-skin="dark">
  <link rel="stylesheet" href="../assets/stylesheets/custom.css">
  <script>
    var skin = localStorage.getItem('skin') || 'default';
    var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
    disabledSkinStylesheet.setAttribute('rel', '');
    disabledSkinStylesheet.setAttribute('disabled', true);
    document.querySelector('html').classList.add('loading');
  </script>
</head>

<body>
  <div class="app">
    <header class="app-header app-header-dark">
      <div class="top-bar">
        <div class="top-bar-brand">
          <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle aside menu -->
          <a href=".">
            <img class="rounded" src="../assets/images/logo.jpg" alt="" height="32">
          </a>
        </div>
        <div class="top-bar-list">
          <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
            <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
          </div>
          <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">

            <div class="dropdown d-none d-md-flex">
              <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="user-avatar user-avatar-md">
                  <img src="../assets/images/avatars/team4.jpg" alt=""></span>
                <span class="account-summary pr-lg-4 d-none d-lg-block">
                  <span class="account-name"><?= $_SESSION['profile']['username'] ?></span>
                  <span class="account-description"><?= $_SESSION['profile']['nama_user'] ?></span>
                </span>
              </button>
              <div class="dropdown-menu">
                <div class="dropdown-arrow d-lg-none" x-arrow=""></div>
                <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                <h6 class="dropdown-header d-none d-md-block d-lg-none"> Sihar </h6>
                <a class="dropdown-item" href="logout.php"><span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>