<aside class="app-aside app-aside-expand-md app-aside-light">
  <div class="aside-content">
    <header class="aside-header d-block d-md-none">
      <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
        <span class="user-avatar user-avatar-lg">
          <img src="../assets/images/avatars/team4.jpg" alt=""></span>
        <span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span> <span class="account-summary">
          <span class="account-name"><?= $_SESSION['profile']['username'] ?></span>
          <span class="account-description"><?= $_SESSION['profile']['nama_user'] ?></span>
        </span>
      </button>
      <div id="dropdown-aside" class="dropdown-aside collapse">
        <div class="pb-3">
          <a class="dropdown-item" href="logout.php"><span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
        </div>
      </div>
    </header>
    <div class="aside-menu overflow-hidden">
      <nav id="stacked-menu" class="stacked-menu">
        <ul class="menu">
          <li class="menu-item">
            <a href="." class="menu-link"><span class="menu-icon fas fa-home"></span> <span class="menu-text">Dashboard</span></a>
          </li>
          <li class="menu-item">
            <a href="user.php?aksi=list" class="menu-link"><span class="menu-icon fas fa-user"></span> <span class="menu-text">User</span></a>
          </li>
          <li class="menu-item">
            <a href="loker.php?aksi=list" class="menu-link"><span class="menu-icon oi oi-browser"></span> <span class="menu-text">Posting Lowongan</span></a>
          </li>
          <li class="menu-item">
            <a href="lamaran.php?aksi=list" class="menu-link"><span class="menu-icon fas fa-clipboard-check"></span> <span class="menu-text">Seleksi Lamaran</span></a>
          </li>
          <li class="menu-item">
            <a href="laporan.php?aksi=list" class="menu-link"><span class="menu-icon fas fa-print"></span> <span class="menu-text">Laporan</span></a>
          </li>
        </ul>
      </nav>
    </div>
    <footer class="aside-footer border-top p-2">
      <button class="btn btn-light btn-block text-primary" data-toggle="skin"><span class="d-compact-menu-none">Night mode</span> <i class="fas fa-moon ml-1"></i></button>
    </footer>
  </div>
</aside>