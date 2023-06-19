<?php
	session_start();
	require_once "database_connect.php";
	$user_id = $_COOKIE['user_id'];

	if (isset($_POST['request'])){
	
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
		
		$sql = "INSERT INTO ZS.\"artifacts\" (\"user_id\", \"set\", \"part\", \"main_substat\", \"level\", \"adverb_substat_1\", \"adverb_substat_1_data\", \"adverb_substat_2\", \"adverb_substat_2_data\", \"adverb_substat_3\", \"adverb_substat_3_data\", \"adverb_substat_4\", \"adverb_substat_4_data\") 
		VALUES (:user_id, :set_value, :part, :main_substat, :level_value, :adverb_substat_1, :adverb_substat_1_data, :adverb_substat_2, :adverb_substat_2_data, :adverb_substat_3, :adverb_substat_3_data, :adverb_substat_4, :adverb_substat_4_data)";

		$stmt = oci_parse($conn, $sql);
		oci_bind_by_name($stmt, ':user_id', $user_id);
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
			echo "<script>alert('添加成功');location.href='index.php'</script>";
		} else {
			oci_close($conn);
			echo "<script>alert('添加失败');history.back()</script>";
		}
			
		exit;
	} else {
		echo "<script>alert('非法请求');history.back()</script>";
	}
?>