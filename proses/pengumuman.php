<!DOCTYPE HTML>
<!-- untuk swal -->
<script src="../style/asset/js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../style/asset/css/sweetalert.css">

<?php
session_start();
if (isset($_POST['submit'])) {
    define("BASEPATH", true);
    include '../config/config.php';
    include '../func/db.php';

    switch (@$_POST['aksi']) {
        case "tambah" :
            //get value from form
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $tanggal = $_POST['tanggal'];
            $user = $_SESSION['id'];
            $jam = $_POST['jam'];

            $data = array(
                "waktu" => $tanggal . " " . $jam,
                "pengirim" => $user,
                "judul" => $judul,
                "berita" => $isi
            );

            $x = insert("berita", $data, $con);
            if ($x == true) 
            {
                echo '<script>window.location.href="../?page=berita&alert=success";</script>';               
            }else
            {                
                echo '<script>window.location.href="../?page=berita&aksi=form&alert=gagal";</script>';                                
            }

            //log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = $_SESSION['user'];
            $keterangan = 'Menambah data pengumuman "' . $judul . '"';

            $data = array(
                "user" => $user,
                "ip" => $ip,
                "waktu" => $date,
                "keterangan" => $keterangan
            );

            insert("aktivitas", $data, $con);
            break;
        case "edit" :
            //get value from form
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $id = $_POST['id'];
            $sql = "UPDATE berita SET judul = '$judul',berita = '$isi' WHERE id = '$id'";
            $x = query($sql, $con);
            if ($x) {
                //echo '<script>alert("Pengumuman berhasil diedit")</script>';
                echo '<script>window.location.href="../?page=berita&alert=edit"</script>';
            } else {
                echo '<script>alert("Pengumuman gagal ditambah\n cek kembali isian form anda")</script>';
                echo '<script>window.location.href="../?page=berita&aksi=form"</script>';
            }
            //log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = $_SESSION['user'];
            $keterangan = 'Mengedit data pengumuman "' . $_POST['lama'] . '" menjadi "' . $judul . '"';

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
