<?php
if (!defined("BASEPATH"))
    exit('No direct scripts allowed');

//struktur menu berdasakan hak akses
function menu() {
    switch (@$_SESSION['akses']) {
        case "admin" :
            ?>
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="?page=Beranda">Beranda</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Master <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="?page=user">User</a></li>
                            <li><a href="?page=teknisi">Teknisi</a></li>
                        </ul>
                        </li>
                        <li><a href="?page=splitter">Splitter</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Log <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?page=log&log=aktivitas" target="_blank">Catatan Aktivitas</a></li>
                                <li><a href="?page=log&log=login" target="_blank">Catatan Login</a></li>
                                <li><a href="?page=log&log=splitter" target="_blank">Catatan Splitter</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?page=berita&aksi=form">Pengumuman</a></li>

                        <li><a href="?page=panduan">Panduan</a></li>
                        <li><a href="?page=logout">Logout</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>

            <!-- akhir-->

            <?php
            break;
        case "staff" :
            ?>
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="?page= '  ' % %% && &amp;">Beranda</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Master<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?page=user">User</a></li>
                    </ul>
                        </li>
                        <li><a href="?page=splitter&aksi=form">Spliter</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?page=panduan">Panduan</a></li>

                        <li><a href="?page=logout">Logout</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>

            <?php
            break;
    }
}

function link_menu($con) {
    switch (@$_GET['page']) {
        //link struktur menu
        case "splitter":
            include 'pages/splitter/index.php';
            break;
        case "laporan":
            include 'pages/report/index.php';
            break;
        case "user":
            include 'pages/master/user.php';
            break;
        case "teknisi":
            include 'pages/master/teknisi.php';
            break;
        case "log":
            $log = @$_GET['log'];
            echo '<script>window.location.href="pages/log/index?&log=' . $log . '"</script>';
            break;
        case "panduan":
            include 'pages/panduan.php';
            break;

        case "logout":
            session_destroy();
            echo '<script>window.location.href="login"</script>';
            break;
        default :
            include 'pages/announce/index.php';
    }
}
