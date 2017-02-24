<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined("BASEPATH")) {
    echo '<script>window.location.href="../../404.html"</script>';
} else {
    $akses = array('admin', 'staff');
    switch (@$_GET['aksi']) {
        case "form":
            if (@$_GET['id']) {
                //jika ada id ->edit data
                $id = $_GET['id'];
                $res = get_all_where("user", "id", $id, $con);
                $data = mysqli_fetch_array($res);
                $user = $data['user'];
                $pass = $data['pass'];
                $nama = $data['nama_lengkap'];
                $hak = $data['hak_akses'];
                $blok = $data['blokir'];
                $aksi = 'edit';
                $head = 'Edit User Sistem';
            } else {
                //tambah data baru
                $user = '';
                $nama = '';
                $pass = '';
                $hak = '';
                $blok = '';
                $head = 'Tambah User Sistem';
                $aksi = 'tambah';
            }
            ?>
            <h3><?= $head ?></h3>
            <form action="proses/user" method="post">
                <?php
                //hanya tampil ketika edit data
                if (@$id != '') {
                    ?>
                    <input type="hidden" name="id" value="<?= $id ?>"> 
                    <?php
                }
                ?>
                <div class="form-group">                    
                    <label>Username</label>
                    <input type="text" name="user" class="form-control" value="<?= $user ?>">                    
                </div>
                <?php
                if (!@$_GET['id']) {
                    ?>
                    <div class="form-group">
                        <label>Password</label>
                        <div id="pass">  
                            <input id="pass_ku" type="password" class="form-control" name="pass" value="<?= $pass ?>" style="width: 90%">
                        </div>
                        <br>
                        <a href="#" onclick="lihat()" class="btn btn-default">Lihat Password</a>
                    </div>
                    <script>
                        function lihat() {
                            var pass = document.getElementById('pass');
                            var pass_ku = document.getElementById('pass_ku').value;
                            pass.innerHTML = '<input  type="text" class="form-control" name="pass" value="' + pass_ku + '" style="width: 90%">';
                            
                            
                        }
                    </script>
                    <?php
                }
                ?>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $nama ?>">
                </div>

                <div class="form-group">
                    <label>Hak Akses</label>
                    <select name="hak" class="form-control input-lg" style="width:50%">
                        <?php
                        foreach ($akses as $a) {
                            ?>
                            <option value="<?= $a ?>"><?= $a ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <?php
                if ($_SESSION['akses'] == 'admin' && @$_GET['id']) {
                    ?>
                    <div class="form-group">
                        <label>Status Blokir</label>
                        <div class="radio">
                            <label>
                                <input type="radio"  name="blokir" value="Y"
                                <?php
                                if ($blok == 'Y') {
                                    echo 'checked';
                                }
                                ?>
                                       > Yes
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio"  name="blokir" value="N"

                                       <?php
                                       if ($blok == 'N') {
                                           echo 'checked';
                                       }
                                       ?>> No

                            </label>
                        </div>

                    </div>
                    <?php
                }
                ?>

                <input type="submit" name="submit" class="btn btn-primary btn-lg btn3d" value="Simpan">
                <input type="hidden" name="aksi" value="<?= $aksi ?>">

            </form>
            <?php
            break;

        case "hapus" :
            $id = @$_GET['id'];

            $hapus = delete_where("user", "id", $id, $con);

            if ($hapus) {
                echo '<script>
                    berhasilHapus("user")
                     </script>';
            }
            break;
        case "password":
            ?>
            <a href="javascript:history.back()" class="btn btn-default btn3d">Kembali</a>
            <form action="proses/user" method="post">
                <h3>Hai, <?= $_SESSION['nama'] ?></h3>
                <h4>Ingin ganti password?</h4>
                <div class="form-group">
                    <label>Masukkan Password Lama</label>
                    <input type="password" id="password" name="lama" class="form-control"> 
                    <input type="checkbox" onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'">Lihat Password
                </div>
                <div class="form-group">
                    <label>Masukkan Password Baru</label>
                    <input type="password" name="baru" id="pass1" class="form-control"> 
                </div>
                <div class="form-group">
                    <label>Masukkan Password Baru(ulangi)</label>
                    <input type="password" name="baru2" id="pass2" class="form-control" onkeyup="checkPass();
                            return false;"> 
                    <span id="confirmMessage" class="confirmMessage"></span>
                </div>
                <input type="hidden" name="aksi" value="password">
                <div id="btnSubmit">

                </div>
            </form>

            <script>
                function checkPass()
                {
                    //Store the password field objects into variables ...
                    var pass1 = document.getElementById('pass1');
                    var pass2 = document.getElementById('pass2');
                    //Store the Confimation Message Object ...
                    var message = document.getElementById('confirmMessage');
                    //Set the colors we will be using ...
                    var goodColor = "#66cc66";
                    var badColor = "#ff6666";
                    //Compare the values in the password field 
                    //and the confirmation field
                    if (pass1.value == pass2.value) {
                        //The passwords match. 
                        //Set the color to the good color and inform
                        //the user that they have entered the correct password 
                        pass2.style.backgroundColor = goodColor;
                        message.style.color = goodColor;
                        message.innerHTML = ""

                        document.getElementById("btnSubmit").innerHTML = '<input type="submit" name="submit" class="btn btn-success btn3d">';


                    } else {
                        //The passwords do not match.
                        //Set the color to the bad color and
                        //notify the user.
                        pass2.style.backgroundColor = badColor;
                        message.style.color = badColor;
                        message.innerHTML = "Passwords Tidak Cocok!";

                        document.getElementById("btnSubmit").innerHTML = '<input type="submit" name="submit" class="btn btn-success disabled">';
                    }
                }
            </script>
            <?php
            break;
        default:

            if ($_SESSION['akses'] == 'admin') {
                ?>
                <a href="?page=user&aksi=form" class="btn btn-success btn-lg btn3d"><span class="glyphicon glyphicon-plus"></span>Tambah Data User</a>
                <?php
                $x = get_all("user", $con);
            } else {
                $id = $_SESSION['id'];
                $x = query("SELECT * FROM user WHERE id = " . $_SESSION['id'] . " OR hak_akses != 'admin' ", $con);
            }
            ?>
            <hr>

            <table id="table" class="table table-striped table-bordered">
                <thead>
                <th>No</th>
                <th>User</th>
                <th>Nama</th>
                <th style="width:60px">Hak Akses</th>
                <th style="width:75px">Status Blokir</th>
                <th style="width:250px">Aksi</th>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($x)) {
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $data['user'] ?> </td>
                        <td><?= $data['nama_lengkap'] ?> </td>
                        <td><?= $data['hak_akses'] ?> </td>
                        <td><?php
                            $blok = $data['blokir'];
                            if ($blok == 'Y') {
                                echo 'Terblokir';
                            } else {
                                echo 'Tidak Terblokir';
                            }
                            ?></td>
                        <td width="200">
                            <?php
                            if ($_SESSION['akses'] == 'staff') {
                                ?>
                                <a href="?page=user&aksi=form&id=<?= $data['id'] ?>"  class="btn btn-warning btn-lg btn3d">Edit</a> || 
                                <button class="btn btn-danger btn-lg btn3d" onclick="chgPwd('user',<?= $data['id'] ?>)">Ganti Password</button>
                                <?php
                            } else {
                                ?>
                                <a href="?page=user&aksi=form&id=<?= $data['id'] ?>"  class="btn btn-warning btn-lg btn3d">Edit</a> || 
                                <button class="btn btn-danger btn-lg btn3d" onclick="hapus(<?= $data['id'] ?>,'user')">Hapus</button>
                                <?php
                                if($_SESSION['user'] == $data['user']){
                                    ?>
                                || <button class="btn btn-danger btn-lg btn3d" onclick="chgPwd('user',<?= $data['id'] ?>)">Ganti Password</button>
                                <?php
                                }
                            }
                            ?>
                        </td>
                    </tr>

                    <?php
                    $id_ = $data['id'];
                    $no++;
                }
                ?>
            </tbody>
            <tfoot>
            <th>No</th>
            <th>User</th>
            <th>Nama</th>
            <th>Hak Akses</th>
            <th>Status Blokir</th>
            <th >Aksi</th>
            </tfoot>
            </table>
            
            <?php
//log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = $_SESSION['user'];
            $keterangan = 'Masuk ke halaman data master user';

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
