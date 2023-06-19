<?php
require 'database_connect.php';//引入数据库配置文件

session_start();
if (!isset($_COOKIE['username']) || !isset($_COOKIE['user_id'])) {
    // 如果用户没有登录，则重定向到登录页面
    echo "<script>alert('请先登录');location.href='login.php';</script>";
    exit();
} else {
    $user_id = $_COOKIE['user_id'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>圣遗物评分管理系统</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
<div class="head">
    欢迎你，<?php echo $_COOKIE['username']; ?>
    <a href="logout.php">【退出登录】</a>
</div>

<div class="container">
<p class="title">圣遗物评分管理系统</p>
<div>

    <h3>本功能仅限五星圣遗物，其余勿扰</h3>

    <a href="add.php">添加圣遗物</a>
    &#12288;
    <a href="download.php">导出圣遗物</a>
</div>

</br></br></br>

    <table cellspacing="0">
        <tr>
            <td class="table">圣遗物图片</td>
            <td class="table">圣遗物套装</td>
			<td class="table">圣遗物部位</td>
            <td class="table">圣遗物等级</td>
            <td class="table">主词条属性</td>
            <td class="table">主词条数值</td>
            <td class="table">副词条1</td>
            <td class="table">副词条2</td>
            <td class="table">副词条3</td>
            <td class="table">副词条4</td>
            <td class="table">圣遗物得分</td>
            <td class="table">操作</td>
        </tr>
        <?php
        
        $sql = "SELECT * FROM ZS.\"artifacts\" WHERE \"user_id\" = :user_id ORDER BY \"id\" ASC";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':user_id', $user_id);
        oci_execute($stid);

        if (oci_fetch_all($stid, $rows, null, null, OCI_FETCHSTATEMENT_BY_ROW)) {
            foreach ($rows as $row) {
        ?>
            <tr class="main">
                <td class="table"><?php echo "<img src=\"/image/artifacts/" . $row["set"] . "/". $row["part"]. ".WEBP\" style=\"width: 128px; height:128px\">"; ?></td>
                <td class="table"><?php echo $row["set"]; ?></td>
                <td class="table"><?php echo $row["part"]; ?></td>
                <td class="table"><?php echo $row["level"]; ?></td>
                <td class="table"><?php echo $row["main_substat"]; ?></td>
                <td class="table"><?php echo $row["main_substat_data"]; ?></td>
                <td class="table"><?php echo $row["adverb_substat_1"]. "</br>". $row["adverb_substat_1_data"]; ?></td>
                <td class="table"><?php echo $row["adverb_substat_2"]. "</br>". $row["adverb_substat_2_data"]; ?></td>
                <td class="table"><?php echo $row["adverb_substat_3"]. "</br>". $row["adverb_substat_3_data"]; ?></td>
                <td class="table"><?php echo $row["adverb_substat_4"]. "</br>". $row["adverb_substat_4_data"]; ?></td>
                <td class="table"><?php echo $row["score"]; ?></td>
                <td class="btn">
                    <a href="edit.php?id=<?php echo $row["id"]; ?>">编辑</a>
                    <a>&#8194;</a>
                    <a href="delete.php?id=<?php echo $row["id"]; ?>">删除</a>
                </td>
            </tr>
        <?php }
        } ?>
    </table>
</div>

</body>
<?php
    oci_close($conn);
?>
</html>