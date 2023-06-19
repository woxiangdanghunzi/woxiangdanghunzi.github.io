<?php
	session_start();
	require "database_connect.php";
	if(isset($_POST['request'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

        $sql = "SELECT \"id\" FROM ZS.\"users\" WHERE \"username\" = :username";
		$stmt = oci_parse($conn, $sql);
		oci_bind_by_name($stmt, ':username', $username);
		oci_execute($stmt);
		
		if ($row = oci_fetch_assoc($stmt)) {
            echo "<script>alert('该用户名已被注册');history.back()</script>";
        } else {
            $sql = "INSERT INTO ZS.\"users\" (\"username\", \"password\") VALUES (:username, :password)";
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ':username', $username);
            oci_bind_by_name($stmt, ':password', $password);

            if (oci_execute($stmt)) {
                oci_close($conn);
                echo "<script>alert('注册成功');location.href='login.php'</script>";
            } else {
                oci_close($conn);
                echo "<script>alert('注册失败');history.back()</script>";
            }
        }
	} else {
        echo "<script>alert('非法请求');history.back()</script>";
    }
?>