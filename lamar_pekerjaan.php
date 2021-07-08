<?php
include "_header.php";
include "koneksi.php";

if (isset($_GET['loker_id'])) {

    $id_loker = $_GET['loker_id'];
    $sql = $koneksi->query("select * from tbl_loker where id_loker = '$id_loker'");
    $loker = $sql->fetch_assoc();

    if (date("Y-m-d") >= $loker['tgl_berlaku']) {
        $status = "danger";
    } else {
        $status = "success";
    }

    // Syntax untuk menyimpan data ke tbl_lamaran_pekerjaan jika tombol simpan ditekan
    if (isset($_POST['kirim'])) {

        $nopendaftaran      = "CK-" . date('dmyHi');
        $nama_lengkap       = $_POST['nama_lengkap'];
        $jk                 = $_POST['jk'];
        $status_nikah       = $_POST['status_nikah'];
        $email              = $_POST['email'];
        $tlp                = $_POST['tlp'];
        $pendidikan_terakhir = $_POST['pendidikan_terakhir'];
        $alamat             = $_POST['alamat'];
        $deskripsi          = $_POST['deskripsi'];

        $cek = $koneksi->query("SELECT * FROM tbl_lamaran_pekerjaan WHERE id_loker ='$id_loker' AND email = '$email'")->num_rows;

        echo $cek;
        if ($cek >= 1) {
            echo    '<div class="page-message" role="alert">
                        <i class="fas fa-info-circle"></i> Gagal kirim lamaran : Email yang di inputkan sudah pernah di daftrakan.
                        <a href="#" class="btn btn-sm btn-icon btn-warning ml-1" aria-label="Close" onclick="$(this).parent().fadeOut()">
                            <span aria-hidden="true">
                                <i class="fa fa-times"></i>
                            </span>
                        </a>
                    </div>';
        } else {

            $cv                 = $_FILES['cv']['name'];
            $lokasi             = $_FILES['cv']['tmp_name'];
            move_uploaded_file($lokasi, "cv/" . $cv);

            $query_simpan = $koneksi->query("INSERT INTO tbl_lamaran_pekerjaan (id_loker, no_pendaftaran, nama_lengkap, jk, status_nikah, email, tlp, pendidikan_terakhir, alamat, deskripsi, cv, status) 
                                        VALUES ('$id_loker','$nopendaftaran','$nama_lengkap','$jk','$status_nikah','$email','$tlp','$pendidikan_terakhir','$alamat','$deskripsi','$cv','Proses seleksi')");

            if ($query_simpan) {
                echo "<script>alert('Lamaran berhasil di kirim !')</script>";
                echo "<script>location='lamar_pekerjaan.php?&sukses=$nopendaftaran'</script>";
            } else {
                echo "<script>alert('Lamaran gagal di kirim !')</script>";
                echo "<script>location='lamar_pekerjaan.php?loker_id=$id_loker'</script>";
            }
        }
    } ?>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="card card-fluid">
                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Lamar Pekerjaan : <?= $loker['judul_loker'] ?></legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Nama Lengkap </label>
                                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Input nama lengkap" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin </label>
                                        <select name="jk" class="form-control" id="jk" required>
                                            <option value="">Pilih jenis kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status_nikah">Status Pernikahan </label>
                                        <select name="status_nikah" class="form-control" id="status_nikah" required>
                                            <option value="">Pilih status pernikahan</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Belum Menikah">Belum Menikah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Input email aktif" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tlp">Nomor Telepon </label>
                                        <input type="number" class="form-control" name="tlp" id="tlp" placeholder="Input no handphone aktif" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                        <select class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir" required>
                                            <option value="SMA/SMK/STM Sederajat">SMA/SMK/STM Sederajat</option>
                                            <option value="Diploma (D1/D2/D3)">Diploma (D1/D2/D3)</option>
                                            <option value="Sarjana (S1)">Sarjana (S1)</option>
                                            <option value="Magister (S2)">Magister (S2)</option>
                                            <option value="Doktor (S3)">Doktor (S3)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Input alamat lengkap" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="deskripsi">Promosikan diri anda</label>
                                        <div class="alert alert-primary has-icon" role="alert">
                                            <div class="alert-icon">
                                                <span class="fas fa-info-circle"></span>
                                            </div>Beritahu perusahaan mengapa anda paling cocok untuk posisi ini. Sebutkan keterampilan khusus dan bagaimana anda berkontribusi. Hindari hal umum seperti <cite>"Saya bertanggung jawab ..."</cite>
                                        </div>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cv">Upload curriculum vitae (CV) / Resume anda</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="cv" id="cv" accept="application/pdf" required> <label class="custom-file-label" for="tf3">Pilih file cv</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions mt-4">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="kirim">Kirim Lamaran</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

<?php } else if (isset($_GET['sukses'])) { ?>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="jumbotron">
                <center>
                    <p class="lead"> Lamaran Berhasil dikirim ! <br> <b>No Pendaftaran kamu adalah :</b> </p>
                    <h1 class="display-1"> <?= $_GET['sukses'] ?> </h1>
                    <p class="lead"> Harap catat dan simpan no pendataran kamu ! No pendaftaran diatas diperlukan untuk mengecek hasil seleksi lamaran pekerjaan kamu di menu <b><a href="pengumuman.php">pengumuman</a></b></p>
                </center>
            </div>
        </div>
    </section>
<?php } ?>


<?php
include "_footer.php";
?>