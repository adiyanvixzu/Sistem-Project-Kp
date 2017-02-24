<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined("BASEPATH")) {
    echo '<script>window.location.href="../../404.html"</script>';
} else {
    if ($_SESSION['akses'] == 'admin') {
        switch (@$_GET['aksi']) {
            case "form":

                if (@$_GET['id']) {
                    $id = $_GET['id'];
                    $res = get_all_where("teknisi", "id_teknisi", $id, $con);
                    $data = mysqli_fetch_array($res);
                    $id = $data['id_teknisi'];
                    $nama = $data['nama'];
                    $jabatan = $data['jabatan'];
                    $nik = $data['nik'];
                    $aksi = 'edit';
                    $head = 'Edit Data Teknisi';
                } else {
                    $id = '';
                    $nama = '';
                    $jabatan = '';
                    $nik = '';
                    $head = 'Tambah Data Teknisi';
                    $aksi = 'tambah';
                }
                ?>
                <h3><?= $head ?></h3>
                <form action="proses/teknisi" method="post">
                    <?php
                    //hanya tampil ketika edit data
                    if (@$id != '') {
                        ?>

                        <input type="hidden" name="id" value="<?= $id ?>"> 
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" value="<?= $nik ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama Teknisi</label>
                        <input type="text" name="nama" class="form-control" value="<?= $nama ?>">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" value="<?= $jabatan ?>">
                    </div>

                    <input type="submit" name="submit" class="btn btn-success btn3d" value="Simpan">
                    <input type="hidden" name="aksi" value="<?= $aksi ?>">

                </form>
                <?php
                break;

            case "hapus" :
                $id = @$_GET['id'];

                $hapus = delete_where("detail_splitter", "teknisi", $id, $con);

                if ($hapus) {

                    $hapus2 = delete_where("teknisi", "id_teknisi", $id, $con);

                    if ($hapus2) {
                        echo '<script>
                    berhasilHapus("teknisi")
                     </script>';
                    }
                }
                break;

            default:
                ?>
                <a href="?page=teknisi&aksi=form" class="btn btn-success btn-lg btn3d"><span class="glyphicon glyphicon-plus"></span>Tambah Teknisi</a>
                <?php
                $sql = "SELECT * FROM teknisi";
                $x = query($sql, $con);
                ?>
                <hr>
                <table id="table" class="table table-striped table-bordered">
                    <thead>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>

                    <th style="width:250px">Aksi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    if (mysqli_num_rows($x) > 0) {
                        while ($data = mysqli_fetch_array($x)) {
                            ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $data['nik'] ?></td>
                                <td><?= $data['nama'] ?> </td>
                                <td><?= $data['jabatan'] ?> </td>
                                <td width="200">
                                    <?php
                                    if ($_SESSION['akses'] == 'staff') {
                                        ?>
                                        <a href="?page=teknisi&aksi=form&id=<?= $data['id_teknisi'] ?>"  class="btn btn-warning btn-lg btn3d">Edit</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="?page=teknisi&aksi=form&id=<?= $data['id_teknisi'] ?>"  class="btn btn-warning btn-lg btn3d">Edit</a> || 
                                        <button class="btn btn-danger btn-lg btn3d" onclick="hapus(<?= $data['id_teknisi'] ?>, 'teknisi')">Hapus</button>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>

                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                    </tfoot>
                    </table>
                    <?php
                } else {
                    echo 'Tidak ada data';
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
    } else {
        echo '<script>window.location.href="404.html"</script>';
    }
}
?>


