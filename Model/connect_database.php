<?php
define('HOST','localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'food-order');
define('SITEURL', 'http://localhost/food-order/');
session_start();

function clearStringSql ($value) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if($conn -> connect_error) {
        die();
    }
    return $conn -> real_escape_string($value);
}

function execute($sql) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if($conn -> connect_error) {
        die();
    }
    $result = mysqli_query($conn, $sql);
    $conn -> close();
    return $result;
}

function executeResult($sql) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if($conn -> connect_error) {
        return $conn -> connect_error;
    }
    $result = mysqli_query($conn, $sql);
    $data = array();
    while($row = mysqli_fetch_array($result, 1)){
        $data[] = $row;
    }
    $conn -> close();
    return $data;
}
?>