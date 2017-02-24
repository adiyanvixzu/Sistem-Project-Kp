<?php

session_start();
if (isset($_POST['submit'])) {
    define("BASEPATH", true);
    include '../config/config.php';
    include '../func/db.php';

    switch (@$_POST['aksi']) {
        case "tambah" :
            //get value from form
            $nik = $_POST['nik'];
            $nama = $_POST['nama'];
            $jabatan = $_POST['jabatan'];

            $data = array(
                "nik" => $nik,
                "nama" => $nama,
                "jabatan" => $jabatan
            );

            $x = insert("teknisi", $data, $con);
            if ($x) {
                //echo '<script>alert("Teknisi berhasil ditambah")</script>';
                echo '<script>window.location.href="../?page=teknisi&alert=success"</script>';
            } else {
                echo '<script>alert("Tekisi gagal ditambah\n cek kembali isian form anda \n error = '.mysqli_error($con).'")</script>';
                echo '<script>window.location.href="../?page=teknisi&aksi=form"</script>';
            }

            //log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $username = $_SESSION['user'];
            $keterangan = 'Menambah data teknisi "' . $user . '"';

            $data = array(
                "user" => $username,
                "ip" => $ip,
                "waktu" => $date,
                "keterangan" => $keterangan
            );

            insert("aktivitas", $data, $con);
            break;
        case "edit" :
            //get value from form
            $nik = $_POST['nik'];
            $nama = $_POST['nama'];
            $jabatan = $_POST['jabatan'];
            $id = $_POST['id'];
            $sql = "UPDATE teknisi SET nik = '$nik', nama = '$nama', jabatan = '$jabatan' WHERE id_teknisi = '$id' ";
            $x = query($sql, $con);
            if ($x) {
                //echo '<script>alert("Teknisi berhasil diedit")</script>';
                echo '<script>window.location.href="../?page=teknisi&alert=edit"</script>';
            } else {
                echo '<script>alert("Teknisi gagal diedit\n cek kembali isian form anda, error -> '.mysqli_error($con).'")</script>';
                echo '<script>window.location.href="../?page=teknisi&aksi=form"</script>';
            }
            //log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = $_SESSION['user'];
            $keterangan = 'Mengedit data teknisi "' . $nama . '"';

            $data = array(
                "user" => $user,
                "ip" => $ip,
                "waktu" => $date,
                "keterangan" => $keterangan
            );

            insert("aktivitas", $data, $con);
            break;
    }
}
