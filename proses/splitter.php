<?php

session_start();
if (isset($_POST['submit'])) {
    define("BASEPATH", true);
    include '../config/config.php';
    include '../func/db.php';

    switch (@$_POST['aksi']) {
        case "tambah" :
            //get value from form
            $jenis = $_POST['jenis'];
            $serial = $_POST['serial'];
            $merk = $_POST['merk'];
            $tanggal = $_POST['tanggal'];
            $teknisi = $_POST['teknisi'];
            $odc = $_POST['odc'];
            $odp = $_POST['odp'];

            $data = array(
                "jenis_splitter" => $jenis,
                "serial" => $serial,
                "merk_splitter" => $merk
            );

            $x = insert("splitter", $data, $con);
            if ($x) {
                $q = query("SELECT MAX(id_splitter) AS id FROM splitter", $con);
                $id_ = mysqli_fetch_array($q);
                $data2 = array(
                    "splitter" => $id_['id'],
                    "teknisi" => $teknisi,
                    "tanggal" => $tanggal,
                    "odc" => $odc,
                    "odp" => $odp
                );
                
                $x2 = insert("detail_splitter", $data2, $con);
                
                if($x2){
                //echo '<script>alert("Teknisi berhasil ditambah")</script>';
                echo '<script>window.location.href="../?page=splitter&alert=success"</script>';
                }else{
                   echo '<script>alert("Data gagal ditambah\n cek kembali isian form anda \n error = '.mysqli_error($con).'")</script>'; 
                }
            } else {
                echo '<script>alert("Data gagal ditambah\n cek kembali isian form anda \n error = '.mysqli_error($con).'")</script>';
                echo '<script>window.location.href="../?page=splitter&aksi=form"</script>';
            }

            //log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $username = $_SESSION['user'];
            $keterangan = 'Menambah data splitter dengan SN = "' . $serial . '"';

            $data = array(
                "user" => $username,
                "ip" => $ip,
                "waktu" => $date,
                "keterangan" => $keterangan
            );

            insert("log_splitter", $data, $con);
            break;
        case "edit" :
            //get value from form
            $jenis = $_POST['jenis'];
            $serial = $_POST['serial'];
            $merk = $_POST['merk'];
            $tanggal = $_POST['tanggal'];
            $teknisi = $_POST['teknisi'];
            $id = $_POST['id'];
            $id_split = $_POST['id_split'];

            $x = query("UPDATE splitter SET jenis_splitter = '$jenis', serial = '$serial',merk_splitter = '$merk' WHERE id_splitter = '$id_split'", $con);
            if ($x) {
                
                $x2 = query("UPDATE detail_splitter SET splitter = '$id_split', teknisi = '$teknisi', tanggal = '$tanggal' WHERE id = '$id'", $con);
                
                if($x2){
                //echo '<script>alert("Teknisi berhasil ditambah")</script>';
                echo '<script>window.location.href="../?page=splitter&alert=edit"</script>';
                }else{
                   echo '<script>alert("Data gagal ditambah\n cek kembali isian form anda \n error = '.mysqli_error($con).'")</script>'; 
                }
            } else {
                echo '<script>alert("Data gagal ditambah\n cek kembali isian form anda \n error = '.mysqli_error($con).'")</script>';
                echo '<script>window.location.href="../?page=splitter&aksi=form"</script>';
            }
            //log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = $_SESSION['user'];
            $keterangan = 'Mengedit data splitter dengan SN = "' . $serial . '"';

            $data = array(
                "user" => $user,
                "ip" => $ip,
                "waktu" => $date,
                "keterangan" => $keterangan
            );

            insert("log_splitter", $data, $con);
            break;
    }
}
