<?php
$servername = "82.157.50.36";
$port = "1521";
$sid = "orcl";
$username = "zs";
$password = "1aA.....";
$character = "UTF8";

$conn = oci_connect($username, $password, "{$servername}:{$port}/{$sid}", "$character");

if (!$conn) {
    $e = oci_error();
    die("连接失败: " . $e['message']);
}
?>