<?php
	session_start();
	require "database_connect.php";
	if(isset($_POST['request'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT \"id\" FROM ZS.\"users\" WHERE \"username\" = :username AND \"password\" = :password";
		$stmt = oci_parse($conn, $sql);
		oci_bind_by_name($stmt, ':username', $username);
		oci_bind_by_name($stmt, ':password', $password);
		oci_execute($stmt);
		
		if ($row = oci_fetch_assoc($stmt)) {
			setcookie('username', $username, time() + 604800, '/');
			setcookie('user_id', $row['id'], time() + 604800, '/');
			oci_close($conn);
			echo "<script>location.href='index.php'</script>";
		} else {
			oci_close($conn);
			echo "<script>alert('用户名或密码错误，请重新输入！');history.back()</script>";
		}
	} else {
        echo "<script>alert('非法请求');history.back()</script>";
    }
?>