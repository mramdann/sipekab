<?php
include "../koneksi.php";
$idloker = $_GET['loker'];

$query = $koneksi->query("select * from tbl_loker where id_loker = '$idloker'");
$data = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Calon Karyawan</title>
</head>

<body>
    <center><br><br>
        <h3>Data Calon Karyawan<br>
            Redaksi : <?= $data['judul_loker'] ?></h3><br>
        <table border="1">
            <thead class="thead-light">
                <tr>
                    <th> No </th>
                    <th> No Pendaftaran </th>
                    <th> Nama Lengkap </th>
                    <th> Jenis Kelamin </th>
                    <th> Status Nikah </th>
                    <th> Email </th>
                    <th> No HP </th>
                    <th> Pendidikan </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = $koneksi->query("select * from tbl_lamaran_pekerjaan where status='Diterima' and id_loker = '$idloker' order by nama_lengkap asc");
                while ($data = $query->fetch_assoc()) {
                ?>
                    <tr>
                        <td> <?= $no ?> </td>
                        <td> <?= $data['no_pendaftaran'] ?> </td>
                        <td> <?= $data['nama_lengkap'] ?> </td>
                        <td> <?= $data['jk'] ?> </td>
                        <td> <?= $data['status_nikah'] ?> </td>
                        <td> <?= $data['email'] ?> </td>
                        <td> <?= $data['tlp'] ?> </td>
                        <td> <?= $data['pendidikan_terakhir'] ?> </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </center>
    <script>
        window.print();
    </script>
</body>

</html>