<?php
$host = "localhost";
$username = "root";
$password = "";
$databasename = "db_sihar";
$koneksi = mysqli_connect($host, $username, $password) or die("kesalahan koneksi...!!");
mysqli_select_db($koneksi, $databasename) or die("Databasenya Error");
