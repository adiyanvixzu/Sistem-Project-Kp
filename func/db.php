<?php

if (!defined('BASEPATH'))
    exit('Tidak boleh akses langsung');

function delete_all($table, $con) {

    $sql = "TRUNCATE TABLE $table";
    //execute
    $stmt = mysqli_query($con, $sql);
}

function delete_where($table, $field, $kondisi, $con) {

    $sql = "DELETE FROM $table WHERE $field = '$kondisi'";

    $stmt = mysqli_query($con, $sql);

    return $stmt;
}

function insert($table, $data, $con) {

    //memisahkan isi array dengan kutip dan tanda koma
    $value = implode("', '", array_values($data));
    $key = implode(', ', array_keys($data));
    //kueri
    $sql = "INSERT INTO $table($key) VALUES ('$value')";
    //eksekusi kueri
    $stmt = mysqli_query($con, $sql);

    return $stmt;
}

function insert_trigger() {
    
}

function update($table, $data, $field, $kondisi, $con) {

    $value = implode("', '", array_values($data));
    $key = implode(', ', array_keys($data));

    $sql = "UPDATE $table SET $value = $key , WHERE $field = $kondisi";

    $stmt = mysqli_query($con, $sql);
}

function get_all($table, $con) {

    $sql = "SELECT * FROM $table";

    $stmt = mysqli_query($con, $sql);

    return $stmt;
}

function get_all_where($table, $field, $kondisi, $con) {

    $sql = "SELECT * FROM $table WHERE $field = '$kondisi'";

    $stmt = mysqli_query($con, $sql);

    return $stmt;
}

function get_join($t1, $t2, $kolom, $key1, $key2, $con) {
    $value = implode(", ", $kolom);

    $sql = "SELECT $value from $t1 join $t2 on $t1.$key1 = $t2.$key2";

    $stmt = mysqli_query($con, $sql);

    return $stmt;
}

function get_join_where($t1, $t2, $kolom, $key1, $key2, $kunci, $isi, $con) {
    $value = implode(", ", $kolom);

    $sql = "SELECT $value from $t1 join $t2 on $t1.$key1 = $t2.$key2 WHERE $kunci = '$isi'";

    $stmt = mysqli_query($con, $sql);

    return $stmt;
}

function get_order_limit($table, $id, $urut, $limit, $con) {

    $sql = "SELECT * FROM $table ORDER BY $id $urut LIMIT $limit";

    $stmt = mysqli_query($con, $sql);

    return $stmt;
}

function query($query, $con) {

    $sql = $query;

    $stmt = mysqli_query($con, $sql);

    return $stmt;
}
