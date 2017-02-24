<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
define("BASEPATH", true);
include 'config/config.php';
include 'func/db.php';
include 'func/menu.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:login');
}

if(@$_GET['page']){
    $halaman = 'Halaman '.$_GET['page'];
}else{
    $halaman = 'Sistem Informasi Splitter';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="style/img/images.png">

        <title><?php echo $halaman ?></title>

        <!-- Bootstrap core CSS -->
        <link href="style/asset/css/bootstrap.css" rel="stylesheet">
        <link href="style/asset/css/style.css" rel="stylesheet">
        <!-- DataTables -->
        <link href="style/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="style/DataTables/media/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="style/DataTables/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

        <!-- SweetAlert -->
        <script src="style/asset/js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/asset/css/sweetalert.css">
        <?php
        //sweet alert functions
        include 'func/alert.php';
        ?>




    <body>

        <?php
        switch (@$_GET['alert']) {
            case "success":
                echo '<script> successTambah(); </script>';
                break;
            case "edit":
                echo '<script> successEdit(); </script>';
                break;
            case "masuk":
                echo '<script>welcome("' . $_SESSION['nama'] . '");</script>';
                break;
            case "hapus":
                echo '<script> successHapus(); </script>';
                break;
            default:
                echo '';
                break;
        }
        ?>
        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-static-top ">
            <?php
            menu();
            ?>
        </nav>

        <div class="container">
            <div class="jumbotron">
                <?php
                link_menu($con);
                ?>
            </div>
        </div> 

        <script src="style/asset/js/jquery-1.11.0.js"></script>
        <script src="style/asset/js/bootstrap.min.js"></script>
        <script src="style/DataTables/media/js/dataTables.bootstrap.min.js"></script>
        <script src="style/DataTables/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#table').DataTable();
            });
        </script>
        <?php
        //sweet alert functions
        //srequire_once  'func/alert.php';
        ?>

    </body>
</html>

<?php
?>