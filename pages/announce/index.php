<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined("BASEPATH")) {
    echo '<script>window.location.href="../../404.html"</script>';
} else {
     
    switch (@$_GET['aksi']) {
        case "form":
            if ($_SESSION['akses'] == 'admin') {
            if (@$_GET['id']) {
                $id = $_GET['id'];
                $res = get_all_where("berita", "id", $id, $con);
                $data = mysqli_fetch_array($res);
                $judul = $data['judul'];
                $isi = $data['berita'];
                $aksi = 'edit';
                $head = 'Edit Pengumuman';
            } else {
                $judul = '';
                $isi = '';
                $head = 'Tambah Pengumuman';
                $aksi = 'tambah';
            }
            ?>
            <h3><?= $head ?></h3>
            <form action="proses/pengumuman" method="post">
                <?php
                //hanya tampil ketika edit data
                if (@$id != '') {
                    ?>
                    <div class="form-group">
                        <label>ID Pengumuman (Otomatis)</label>
                        <input type="text" name="id" class="form-control" value="<?= $id ?>" readonly> 
                    </div>

                    <?php
                }
                ?>
                <div class="form-group">
                    <label>Judul Pengumuman</label>
                    <input type="text" class="form-control" name="judul" value="<?= $judul ?>">
                </div>

                <?php
                //tampil jika tambah data pengumuman
                if ($judul == '') {
                    ?>
                    <div class="form-group has-error">
                        <label>Tanggal (Otomatis)</label>
                        <input type="date" name="tanggal" class="form-control" readonly value="<?= date("Y-m-d") ?>">
                    </div>

                    <div class="form-group has-error">
                        <label>Jam (Otomatis)</label>
                        <input type="time" name="jam" class="form-control" readonly value="<?= date("H:i:s") ?>">
                    </div>

                    <?php
                }
                ?>
                <div class="form-group">
                    <label>Isi Pengumuman</label>
                    <textarea cols="80" rows="8" class="form-control" name="isi"><?= $isi ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success btn-lg btn3d" value="Simpan">
                    <input type="hidden" name="aksi" value="<?= $aksi ?>">
                </div>

                <?php
                /*
                 * Untuk keperluan log, judul lama dikirim
                 * Dengan pertimbangan seandainya judul pengumuman di edit
                 */
                if (@$id != '') {
                    ?>
                    <input type="hidden" name="lama" value="<?= $judul ?>">
                    <?php
                }
                ?>
            </form>
            <?php
    }
            break;

        case "hapus" :
            $id = @$_GET['id'];

            $hapus = delete_where("berita", "id", $id, $con);

            if ($hapus) {
                echo '<script>
                    berhasilHapus("berita");
                     </script>';
                
            }else{
                echo mysqli_error($con);
            }
            break;
    
        default:

            
            if ($_SESSION['akses'] == 'admin') {
                ?>
                <a href="?page=berita&aksi=form"  class="btn btn-default btn-lg btn3d"><span class="glyphicon glyphicon-plus"></span> Tambah Pengumuman</a>
                <hr>
                <?php
            }
            $sql = "SELECT * FROM berita ORDER BY waktu DESC";
            $x = query($sql, $con);
            if ($x) {
                while ($data = mysqli_fetch_array($x)) {
                    ?>
                    <div>
                        <label><b><?= $data['judul'] ?></b></label><br>
                        <?php
                        $sql = "SELECT nama_lengkap from user JOIN berita ON user.id = berita.pengirim";
                        $y = query($sql, $con);
                        $res = mysqli_fetch_array($y);
                        ?>
                        <h5>Pengirim : <?= $res['nama_lengkap'] ?></h5>
                        <h5>Dipos pada : <?= $data['waktu'] ?></h5>
                        <blockquote class="quote-card red-card">
                            <p>
                                <label>Berita</label><br>
                                <?= $data['berita'] ?>
                            </p>
                        </blockquote>

                        <br>
                        <?php
                        if ($_SESSION['akses'] == 'admin') {
                            ?>

                            <a href="?page=berita&aksi=form&id=<?= $data['id'] ?>" class="btn btn-warning btn-lg btn3d"><span class="glyphicon glyphicon-pencil"></span> Edit Pengumuman?</a> ||
                            <button class="btn btn-danger btn-lg btn3d" onclick="hapus(<?= $data['id'] ?>,'berita')"><span class="glyphicon glyphicon-trash"></span> Hapus Pengumuman?</button>
                            
                            <?php
                        }
                        ?>
                    </div>
                    <hr>
                    
                    <?php
                }
            }
//log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = $_SESSION['user'];
            $keterangan = 'Masuk ke halaman beranda (pengumuman)';

            $data = array(
                "user" => $user,
                "ip" => $ip,
                "waktu" => $date,
                "keterangan" => $keterangan
            );

            insert("aktivitas", $data, $con);
    }
}
?>


