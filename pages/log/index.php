<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("BASEPATH", true);
include '../../config/config.php';
include '../../func/db.php';
switch (@$_GET['log']) {
    case "aktivitas":
        echo 'hai, aktivitas';
        $q = get_all("aktivitas", $con);
        ?>
        <table border="1">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Waktu</th>
                <th>Keterangan</th>
            </tr>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($q)) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['user'] ?> </td>
                    <td><?= $data['waktu'] ?> </td>
                    <td><?= $data['keterangan'] ?> </td>
                </tr>

                <?php
                $no++;
            }
            ?>
        </table>
        <?php
        break;
    case "login":
        echo 'hai, login';
        $q = get_all("log_login", $con);
        ?>
        <table border="1">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Waktu</th>
                <th>Keterangan</th>
            </tr>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($q)) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['user'] ?> </td>
                    <td><?= $data['waktu'] ?> </td>
                    <td><?= $data['keterangan'] ?> </td>
                </tr>

                <?php
                $no++;
            }
            ?>
        </table>
        <?php
        break;
        default:
        
        $q = get_all("log_splitter", $con);
        ?>
        <table border="1">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Waktu</th>
                <th>Keterangan</th>
            </tr>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($q)) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['user'] ?> </td>
                    <td><?= $data['waktu'] ?> </td>
                    <td><?= $data['keterangan'] ?> </td>
                </tr>

                <?php
                $no++;
            }
            ?>
        </table>
        <?php
        break;
}


