<?php
	session_start();
	require_once "database_connect.php";
	$user_id = $_COOKIE['user_id'];

	if (isset($_POST['request'])){
		
		$id = $_POST['id'];
		$sql = "SELECT \"id\" FROM ZS.\"artifacts\" WHERE \"id\" = :id AND \"user_id\" = :user_id";
		$stmt = oci_parse($conn, $sql);
		oci_bind_by_name($stmt, ':id', $id);
		oci_bind_by_name($stmt, ':user_id', $user_id);
		oci_execute($stmt);
		
		if ($row = oci_fetch_assoc($stmt)) {

		$set = $_POST['set'];
		$part = $_POST['part'];
		$main_substat = $_POST['main_substat'];
		$level = $_POST['level'];
		$adverb_substat_1 = $_POST['adverb_substat_1'];
		$adverb_substat_1_data = $_POST['adverb_substat_1_data'];
		$adverb_substat_2 = $_POST['adverb_substat_2'];
		$adverb_substat_2_data = $_POST['adverb_substat_2_data'];
		$adverb_substat_3 = $_POST['adverb_substat_3'];
		$adverb_substat_3_data = $_POST['adverb_substat_3_data'];
		$adverb_substat_4 = $_POST['adverb_substat_4'];
		$adverb_substat_4_data = $_POST['adverb_substat_4_data'];
		
		$sql = "UPDATE ZS.\"artifacts\"
		SET
			\"set\" = :set_value,
			\"part\" = :part,
			\"main_substat\" = :main_substat,
			\"level\" = :level_value,
			\"adverb_substat_1\" = :adverb_substat_1,
			\"adverb_substat_1_data\" = :adverb_substat_1_data,
			\"adverb_substat_2\" = :adverb_substat_2,
			\"adverb_substat_2_data\" = :adverb_substat_2_data,
			\"adverb_substat_3\" = :adverb_substat_3,
			\"adverb_substat_3_data\" = :adverb_substat_3_data,
			\"adverb_substat_4\" = :adverb_substat_4,
			\"adverb_substat_4_data\" = :adverb_substat_4_data
		WHERE
			\"id\" = :id";

		$stmt = oci_parse($conn, $sql);
		oci_bind_by_name($stmt, ':id', $id);
		oci_bind_by_name($stmt, ':set_value', $set);
		oci_bind_by_name($stmt, ':part', $part);
		oci_bind_by_name($stmt, ':main_substat', $main_substat);
		oci_bind_by_name($stmt, ':level_value', $level);
		oci_bind_by_name($stmt, ':adverb_substat_1', $adverb_substat_1);
		oci_bind_by_name($stmt, ':adverb_substat_1_data', $adverb_substat_1_data);
		oci_bind_by_name($stmt, ':adverb_substat_2', $adverb_substat_2);
		oci_bind_by_name($stmt, ':adverb_substat_2_data', $adverb_substat_2_data);
		oci_bind_by_name($stmt, ':adverb_substat_3', $adverb_substat_3);
		oci_bind_by_name($stmt, ':adverb_substat_3_data', $adverb_substat_3_data);
		oci_bind_by_name($stmt, ':adverb_substat_4', $adverb_substat_4);
		oci_bind_by_name($stmt, ':adverb_substat_4_data', $adverb_substat_4_data);

		if (oci_execute($stmt)) {
			oci_close($conn);
			echo "<script>alert('更改成功');location.href='index.php'</script>";
		} else {
			oci_close($conn);
			echo "<script>alert('更改失败');history.back()</script>";
		}
			
		exit;

		}

	} else {
		echo "<script>alert('非法请求');history.back()</script>";
	}
?>