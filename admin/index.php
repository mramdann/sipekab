<?php
include "_header.php";
include "_menu.php";
?>
<main class="app-main">
  <div class="wrapper">
    <div id="notfound-state" class="empty-state">
      <div class="empty-state-container">
        <div class="state-figure">
          <img class="img-fluid" src="../assets/images/illustration/img-6.svg" alt="" style="max-width: 300px">
        </div>
        <h3 class="state-header"> Halaman Utama. </h3>
        <p class="state-description lead text-muted"> Jika ada poisi lowongan terbuka segera </p>
        <div class="state-action">
          <a href="loker.php?aksi=tambah" class="btn btn-primary">Posting Lowongan Kerja</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include "_footer.php";
?>