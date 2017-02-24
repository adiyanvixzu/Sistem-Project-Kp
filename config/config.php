<?php

//initialize
$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'splitter';

try{
    $con = mysqli_connect($server, $user, $pass, $dbname);
} catch (Exception $ex) {
    echo 'Install your db first. Message -> '.$ex;
}
//set default timezone to  :  Asia/Jakarta (WIB)
date_default_timezone_set("Asia/Jakarta");