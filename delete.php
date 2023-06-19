<?php
session_start();
require_once "database_connect.php";
$id = $_GET['id'];
$user_id = $_COOKIE['user_id'];

$sql = "SELECT * FROM ZS.\"artifacts\" WHERE \"id\" = :id";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ':id', $id);
oci_execute($stmt);

if ($row = oci_fetch_assoc($stmt)) {
    if ($row['user_id'] == $user_id) {
        $sql = "DELETE FROM ZS.\"artifacts\" WHERE \"id\" = :id";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':id', $id);

        if (oci_execute($stmt)) {
            oci_close($conn);
            echo "<script>alert('删除成功');location.href='index.php'</script>";
        } else {
            oci_close($conn);
            echo "<script>alert('删除失败');location.href='index.php'</script>";
        }
    }
    else {
        echo "<script>alert('不是你的圣遗物');location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('查询失败');location.href='index.php';</script>";
}
?>