<?php

session_start();
//define
define("BASEPATH", true);
//config file
include '../config/config.php';
//functions file
include '../func/db.php';

//begin login check
if (@$_POST['submit']) {

    //get the input value
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    //compare with database
    $sql = get_all_where("user", "user", $user, $con);
    try{
        $x = mysqli_fetch_assoc($sql);
        
    }  catch (Exception $e){
        echo '<script>alert("Ups, what is wrong?")</script>';
        echo '<script>history.back();</script>';
        
    }
    /*
     * Percabangan
     * kalau blokir no....
     */
    if ($user === $x['user'] && $pass === $x['pass'] && $x['blokir'] == 'N') {

        //create session
        $_SESSION['user'] = $user;
        $_SESSION['id'] = $x['id'];
        $_SESSION['akses'] = $x['hak_akses'];
        $_SESSION['nama'] = $x['nama_lengkap'];
        $date = date("Y-m-d H:i:s");

        //echo $_SESSION['user'];
        //update last login
        query("UPDATE user SET last_login = '$date' WHERE user = '$user'", $con);


        //insert into login log
        $keterangan = 'Masuk ke sistem';
        $data = array(
            "user" => $user,
            "waktu" => $date,
            "keterangan" => $keterangan
        );

        insert("log_login", $data, $con);

        //echo '<script>alert("Selamat datang, anda login sebagai '.$_SESSION['nama'].'")</script>';
        echo '<script>window.location.href="../index?alert=masuk"</script>';

        //kalau akun di blokir
    } else if ($user === $x['user'] && $x['blokir'] == 'Y') {
        echo '<script>alert("Maaf, username anda telah di blokir. Hubungi admin");</script>';
        echo '<script>window.location.href="../login"</script>';

        //kalau password salah
    } else if ($user == $x['user'] && $pass != $x['pass']) {
        //create session, just helper for blocking user
        if (!isset($_SESSION['blok'])) {
            //pertama kali salah
            $_SESSION['blok'] = 1;
            $_SESSION['user_x'] = $user;
            echo '<script>alert("Ups, username/password anda salah! \n percobaan ke = ' . $_SESSION['blok'] . '")</script>';
            echo '<script>window.location.href="../login"</script>';
        } else {
            //salah = 3 atau lebih
            if (($_SESSION['blok'] > 3 || $_SESSION['blok'] == 3) && $_SESSION['user_x'] == $user) {
                query("UPDATE user SET blokir = 'Y' WHERE user = '$user'", $con);
                echo '<script>alert("Maaf, username ' . $user . ' telah terblokir. \n Silahkan hubungi administrator")</script>';
                echo '<script>window.location.href="../login"</script>';
                session_destroy();
            } else {
                //jika salah kurang dari 3
                $_SESSION['blok'] += 1;
                echo '<script>alert("Ups, username/password anda salah! \n percobaan ke = ' . $_SESSION['blok'] . '")</script>';
                echo '<script>window.location.href="../login"</script>';
            }
        }
        
    } else {
        //jika tidak cocok dengan semua kondisi
        echo '<script>alert("Username tidak dikenal");</script>';
        echo '<script>window.location.href="../login"</script>';
    }
}


