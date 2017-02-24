<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//untuk keperluan db
$jenis_splitter = array("1:2", "1:4", "1:8");

if (!defined("BASEPATH")) {
    echo '<script>window.location.href="../../404.html"</script>';
} else {
    switch (@$_GET['aksi']) {
        case "form":
            if (@$_GET['id']) {
                $id = $_GET['id'];
                $res = query("SELECT * FROM detail_splitter JOIN splitter ON detail_splitter.splitter = splitter.id_splitter JOIN teknisi ON detail_splitter.teknisi = teknisi.id_teknisi WHERE detail_splitter.id = '$id'", $con);
                $data = mysqli_fetch_array($res);
                $id = $data['id'];
                $id_split = $data['id_splitter'];
                $jenis = $data['jenis_splitter'];
                $serial = $data['serial'];
                $merk = $data['merk_splitter'];
                $teknisi = $data['nama'];
                $odc = $data['odc'];
                $odp = $data['odp'];
                $id_teknisi = $data['id_teknisi'];
                $tanggal = $data['tanggal'];
                $aksi = 'edit';
                $head = 'Edit Data Splitter';
            } else {
                $id = '';
                $jenis = '';
                $serial = '';
                $merk = '';
                $teknisi = '';
                $tanggal = '';
                $id_teknisi = '';
                $odc = '';
                $odp = '';
                $head = 'Tambah Data Splitter';
                $aksi = 'tambah';
            }
            ?>
            <a href="javascript:history.back()" class="btn btn-default btn3d">Kembali</a>
            <h3><?= $head ?></h3>
            <form action="proses/splitter" method="post">
                <?php
                //hanya dikirim ketika edit data
                if (@$id != '') {
                    ?>
                    <input type="hidden" name="id_split" value="<?= $id_split ?>"> 
                    <input type="hidden" name="id" value="<?= $id ?>"> 
                    <?php
                }
                ?>
                <div class="form-group">
                    <label>Jenis Splitter</label>
                    <select name="jenis" class="form-control input-sm" style="width:50%">
                        <?php
                        foreach ($jenis_splitter as $j) {
                            ?>
                            <option value="<?= $j ?>"><?= $j ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Serial Number</label>
                    <input type="text" name="serial" class="form-control" value="<?= $serial ?>">
                </div>
                <div class="form-group">
                    <label>Merk</label>
                    <input type="text" name="merk" class="form-control" value="<?= $merk ?>">
                </div>
                <div class="form-group">
                    <label>Tanggal Pemasangan</label>
                    <input type="date" name="tanggal" class="form-control" style="width: 30%" value="<?= $tanggal ?>">
                </div>
                <div class="form-group">
                    <label>Teknisi</label>
                    <select name="teknisi" class="form-control input-sm" style="width:50%">
                        <?php
                        $q = get_all("teknisi", $con);
                        while ($x = mysqli_fetch_array($q)) {
                            ?>
                            <option value="<?= $x['id_teknisi'] ?>"
                            <?php
                            if ($id_teknisi == $x['id_teknisi']) {
                                echo 'selected';
                            }
                            ?> 
                                    ><?= $x['nama'] ?></option>
                                    <?php
                                }
                                ?>
                    </select>

                </div>
                <div class="form-group">
                    <label>ODC</label>
                    <input type="text" name="odc" class="form-control" value="<?= $odc ?>">
                </div>
                <div class="form-group">
                    <label>ODP</label>
                    <input type="text" name="odp" class="form-control" value="<?= $odp ?>">
                </div>


                <input type="submit" name="submit" value="Simpan" class="btn btn-success btn3d">
                <input type="hidden" name="aksi" value="<?= $aksi ?>">

            </form>
            <?php
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = $_SESSION['user'];
            $keterangan = 'Masuk ke halaman form data splitter';

            $data = array(
                "user" => $user,
                "ip" => $ip,
                "waktu" => $date,
                "keterangan" => $keterangan
            );

            insert("aktivitas", $data, $con);
            break;

        case "hapus" :
            $id = @$_GET['id'];

            $hapus = delete_where("detail_splitter", "id", $id, $con);

            if ($hapus) {
                echo '<script>
                    berhasilHapus(splitter);
                     </script>';
            }
            break;

        default:
            ?>
            <a href="?page=splitter&aksi=form" class="btn btn-success btn-lg btn3d"><span class="glyphicon glyphicon-plus"></span>Tambah Data Splitter</a>
            <hr>
            <?php
            $sql = "SELECT * FROM detail_splitter JOIN splitter ON splitter.id_splitter = detail_splitter.splitter JOIN teknisi ON detail_splitter.teknisi = teknisi.id_teknisi";
            $x = query($sql, $con);
            ?>

            <table id="table" class="table table-striped table-bordered">
                <thead>
                <th>No</th>
                <th>Jenis Splitter</th>
                <th>Merk Splitter</th>
                <th>Teknisi</th>
                <th>Tangggal Pemasangan</th>
                <th>ODC</th>
                <th>ODP</th>

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
                            <td><?= $data['jenis_splitter'] ?></td>
                            <td><?= $data['merk_splitter'] ?> </td>
                            <td><?= $data['nama'] ?> </td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['odc'] ?></td>
                            <td><?= $data['odp'] ?></td>
                            <td width="200">
                                <?php
                                if ($_SESSION['akses'] == 'staff') {
                                    ?>
                                    <a href="?page=splitter&aksi=form&id=<?= $data['id'] ?>"  class="btn btn-warning btn-lg btn3d">Edit</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="?page=splitter&aksi=form&id=<?= $data['id'] ?>"  class="btn btn-warning btn-lg btn3d">Edit</a> || 

                                    <button class="btn btn-danger btn-lg btn3d" onclick="hapus(<?= $data['id'] ?>, 'splitter')">Hapus</button>
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
                <th>Jenis Splitter</th>
                <th>Merk Splitter</th>
                <th>Teknisi</th>
                <th>Tanggal Pemasangan</th>
                <th>ODC</th>
                <th>ODP</th>
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
            $keterangan = 'Masuk ke halaman data splitter';

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


