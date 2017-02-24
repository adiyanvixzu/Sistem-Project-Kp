<?php

session_start();
if (isset($_POST['submit'])) {
    define("BASEPATH", true);
    include '../config/config.php';
    include '../func/db.php';

    switch (@$_POST['aksi']) {
        case "tambah" :
            //get value from form
            $user = $_POST['user'];
            $pass = md5($_POST['pass']);
            $nama = $_POST['nama'];
            $hak = $_POST['hak'];

            $data = array(
                "user" => $user,
                "pass" => $pass,
                "nama_lengkap" => $nama,
                "hak_akses" => $hak
            );

            $x = insert("user", $data, $con);
            if ($x) {
                //echo '<script>alert("User berhasil ditambah")</script>';
                echo '<script>window.location.href="../?page=user&alert=success"</script>';
            } else {
                echo '<script>alert("User gagal ditambah\n cek kembali isian form anda \n error = '.mysqli_error($con).'")</script>';
                echo '<script>window.location.href="../?page=user&aksi=form"</script>';
            }

            //log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $username = $_SESSION['user'];
            $keterangan = 'Menambah data user "' . $user . '"';

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
            $user = $_POST['user'];
            //$pass = $_POST['pass'];
            $nama = $_POST['nama'];
            $hak = $_POST['hak'];
            $id = $_POST['id'];
            $blokir = $_POST['blokir'];
            $sql = "UPDATE user SET user = '$user',nama_lengkap = '$nama',"
                    . "hak_akses = '$hak',blokir = '$blokir' WHERE id = '$id'";
            $x = query($sql, $con);
            if ($x) {
                //echo '<script>alert("User berhasil diedit")</script>';
                echo '<script>window.location.href="../?page=user&alert=edit"</script>';
            } else {
                echo '<script>alert("User gagal diedit\n cek kembali isian form anda")</script>';
                echo '<script>window.location.href="../?page=user&aksi=form"</script>';
            }
            //log
            $date = date("Y-m-d H:i:s", time());
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = $_SESSION['user'];
            $keterangan = 'Mengedit data user';

            $data = array(
                "user" => $user,
                "ip" => $ip,
                "waktu" => $date,
                "keterangan" => $keterangan
            );

            insert("aktivitas", $data, $con);
            break;
        case "password":
            if(@$_POST['submit']){
                $lama = md5($_POST['lama']);
                $id = $_SESSION['id'];
                //query 
                $q = get_all_where("user", "id",$id , $con);
                
                //fetching data
                $data = mysqli_fetch_array($q);
                //compare password
                
                if($data['pass'] == $lama){
                    
                        $pass_baru = md5($_POST['baru']);
                        //$data = array("pass" => $pass_baru);
                        $q2 = query("UPDATE user SET pass = '$pass_baru' WHERE id = '$id'", $con);
                        
                        if($q2){
                            echo '<script>window.location.href="../?page=user&alert=edit"</script>';
                        }
                    
                }else{
                    //echo '<script>alert("'.mysqli_error($con).'"); </script>';
                    //echo mysqli_error($con);
                    //echo 'password salah';
                    echo '<script>alert("Password salah!!!")</script>';
                    echo '<script>history.back();</script>';
                }
                
            }
    }
}
