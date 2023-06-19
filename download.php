<?php
require_once 'database_connect.php';
session_start();
$user_id = $_COOKIE['user_id'];

$sql = "SELECT * FROM ZS.\"artifacts\" WHERE \"user_id\" = :user_id ORDER BY \"id\" ASC";
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ':user_id', $user_id);
oci_execute($stid);

$myfile = fopen("download.csv", "w") or die("Unable to open file!");
$txt = "序号,";
fwrite($myfile, $txt);
$txt = "圣遗物套装,";
fwrite($myfile, $txt);
$txt = "圣遗物部位,";
fwrite($myfile, $txt);
$txt = "圣遗物等级,";
fwrite($myfile, $txt);
$txt = "主词条属性,";
fwrite($myfile, $txt);
$txt = "主词条数值,";
fwrite($myfile, $txt);
$txt = "副词条1属性,";
fwrite($myfile, $txt);
$txt = "副词条1数值,";
fwrite($myfile, $txt);
$txt = "副词条2属性,";
fwrite($myfile, $txt);
$txt = "副词条2数值,";
fwrite($myfile, $txt);
$txt = "副词条3属性,";
fwrite($myfile, $txt);
$txt = "副词条3数值,";
fwrite($myfile, $txt);
$txt = "副词条4属性,";
fwrite($myfile, $txt);
$txt = "副词条4数值,";
fwrite($myfile, $txt);
$txt = "圣遗物得分,\n";
fwrite($myfile, $txt);

if (oci_fetch_all($stid, $rows, null, null, OCI_FETCHSTATEMENT_BY_ROW)) {
    $row_id = 1;
    foreach ($rows as $row) {
        $txt = "$row_id,";
        fwrite($myfile, $txt);
        $txt = "$row[set],";
        fwrite($myfile, $txt);
        $txt = "$row[part],";
        fwrite($myfile, $txt);
        $txt = "$row[level],";
        fwrite($myfile, $txt);
        $txt = "$row[main_substat],";
        fwrite($myfile, $txt);
        $txt = "$row[main_substat_data],";
        fwrite($myfile, $txt);
        $txt = "$row[adverb_substat_1],";
        fwrite($myfile, $txt);
        $txt = "$row[adverb_substat_1_data],";
        fwrite($myfile, $txt);
        $txt = "$row[adverb_substat_2],";
        fwrite($myfile, $txt);
        $txt = "$row[adverb_substat_2_data],";
        fwrite($myfile, $txt);
        $txt = "$row[adverb_substat_3],";
        fwrite($myfile, $txt);
        $txt = "$row[adverb_substat_3_data],";
        fwrite($myfile, $txt);
        $txt = "$row[adverb_substat_4],";
        fwrite($myfile, $txt);
        $txt = "$row[adverb_substat_4_data],";
        fwrite($myfile, $txt);
        $txt = "$row[score],\n";
        fwrite($myfile, $txt);
        $row_id = $row_id + 1;
    }
}
fclose($myfile);

require "transform.php";
$str = file_get_contents('download.csv');
$obj = new CharsetConv('utf-8', 'ansi');
$response = $obj->convert($str);
file_put_contents('download.csv', $response, true);

oci_close($conn);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>圣遗物导出</title>
    <link rel="stylesheet" href="/css/download.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
<div class="login-form">
<h1>圣遗物导出</h1>
<div justify-content: center;>
    <?php
    echo "<a href='download.csv'>下载文件</a>";
    echo "&#12288;&#12288;&#12288;";
    echo "<a href='index.php'>返回主页</a>";
    ?>
</div>
</div>
</body>
</html>