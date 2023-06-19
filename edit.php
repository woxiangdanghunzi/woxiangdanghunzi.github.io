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
    if ($row['user_id'] == $user_id) { }
    else {
        echo "<script>alert('不是你的圣遗物');location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('查询失败');location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改圣遗物</title>
    <link rel="stylesheet" href="/css/artifacts.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <div class="login-form">
    <h1>修改圣遗物</h1>
    <form action="edit_process.php" method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $row["id"]; ?>">

        <label for="username">圣遗物图片：</label>
        <?php echo "<img src=\"/image/artifacts/" . $row["set"] . "/". $row["part"]. ".WEBP\" style=\"width: 128px; height:128px\">"; ?>

        <label for="username">圣遗物套装：</label>
        <select id="set" name="set" required>
            <option value="<?php echo $row["set"]; ?>" selected hidden required><?php echo $row["set"]; ?></option>
            <option value="乐园遗落之花">乐园遗落之花</option>
            <option value="冰风迷途的勇士">冰风迷途的勇士</option>
            <option value="千岩牢固">千岩牢固</option>
            <option value="华馆梦醒形骸记">华馆梦醒形骸记</option>
            <option value="如雷的盛怒">如雷的盛怒</option>
            <option value="平息鸣雷的尊者">平息鸣雷的尊者</option>
            <option value="悠古的磐岩">悠古的磐岩</option>
            <option value="昔日宗室之仪">昔日宗室之仪</option>
            <option value="来歆余响">来歆余响</option>
            <option value="染血的骑士道">染血的骑士道</option>
            <option value="水仙之梦">水仙之梦</option>
            <option value="沉沦之心">沉沦之心</option>
            <option value="沙上楼阁史话">沙上楼阁史话</option>
            <option value="流浪大地的乐团">流浪大地的乐团</option>
            <option value="海染砗磲">海染砗磲</option>
            <option value="深林的记忆">深林的记忆</option>
            <option value="渡过烈火的贤人">渡过烈火的贤人</option>
            <option value="炽烈的炎之魔女">炽烈的炎之魔女</option>
            <option value="绝缘之旗印">绝缘之旗印</option>
            <option value="翠绿之影">翠绿之影</option>
            <option value="花海甘露之光">花海甘露之光</option>
            <option value="苍白之火">苍白之火</option>
            <option value="被怜爱的少女">被怜爱的少女</option>
            <option value="角斗士的终幕礼">角斗士的终幕礼</option>
            <option value="辰砂往生录">辰砂往生录</option>
            <option value="追忆之注连">追忆之注连</option>
            <option value="逆飞的流星">逆飞的流星</option>
            <option value="饰金之梦">饰金之梦</option>
        </select>

        <label>圣遗物部位：</label>
        <select id="part" name="part" required>
            <option value="<?php echo $row["part"]; ?>" selected hidden required><?php echo $row["part"]; ?></option>
            <option value="生之花">生之花</option>
            <option value="死之羽">死之羽</option>
            <option value="时之沙">时之沙</option>
            <option value="空之杯">空之杯</option>
            <option value="理之冠">理之冠</option>
        </select>

        <label>主词条属性：</label>
        <select id="main_substat" name="main_substat" required>
            <option value="<?php echo $row["main_substat"]; ?>" selected hidden required><?php echo $row["main_substat"]; ?></option>
            <option value="生命值">生命值</option>
            <option value="攻击力">攻击力</option>
            <option value="攻击力百分比">攻击力百分比</option>
            <option value="防御力百分比">防御力百分比</option>
            <option value="生命值百分比">生命值百分比</option>
            <option value="元素精通">元素精通</option>
            <option value="元素充能效率">元素充能效率</option>
            <option value="火元素伤害加成">火元素伤害加成</option>
            <option value="水元素伤害加成">水元素伤害加成</option>
            <option value="风元素伤害加成">风元素伤害加成</option>
            <option value="雷元素伤害加成">雷元素伤害加成</option>
            <option value="草元素伤害加成">草元素伤害加成</option>
            <option value="冰元素伤害加成">冰元素伤害加成</option>
            <option value="岩元素伤害加成">岩元素伤害加成</option>
            <option value="物理伤害加成">物理伤害加成</option>
            <option value="暴击率">暴击率</option>
            <option value="暴击伤害">暴击伤害</option>
            <option value="治疗加成">治疗加成</option>
        </select>

        <label>圣遗物等级：</label>
        <input type="number" id="level" name="level" min="0" max="20" step="1" value=<?php echo $row["level"]; ?> required><br>

        <label>副词条1：</label>
        <select id="adverb_substat_1" name="adverb_substat_1" required>
        <option value="<?php echo $row["adverb_substat_1"]; ?>" selected hidden required><?php echo $row["adverb_substat_1"]; ?></option>
        <option value="攻击力">攻击力</option>
        <option value="攻击力百分比">攻击力百分比</option>
        <option value="防御力">防御力</option>
        <option value="防御力百分比">防御力百分比</option>
        <option value="生命值">生命值</option>
        <option value="生命值百分比">生命值百分比</option>
        <option value="暴击率">暴击率</option>
        <option value="暴击伤害">暴击伤害</option>
        <option value="元素精通">元素精通</option>
        <option value="元素充能效率">元素充能效率</option>
        </select>
        <label>副词条1数值：</label>
        <input type="number" id="adverb_substat_1_data" name="adverb_substat_1_data" min="0" max="9999" step="0.1" value=<?php echo $row["adverb_substat_1_data"]; ?> required><br>

        <label>副词条2：</label>
        <select id="adverb_substat_2" name="adverb_substat_2" required>
        <option value="<?php echo $row["adverb_substat_2"]; ?>" selected hidden required><?php echo $row["adverb_substat_2"]; ?></option>
        <option value="攻击力">攻击力</option>
        <option value="攻击力百分比">攻击力百分比</option>
        <option value="防御力">防御力</option>
        <option value="防御力百分比">防御力百分比</option>
        <option value="生命值">生命值</option>
        <option value="生命值百分比">生命值百分比</option>
        <option value="暴击率">暴击率</option>
        <option value="暴击伤害">暴击伤害</option>
        <option value="元素精通">元素精通</option>
        <option value="元素充能效率">元素充能效率</option>
        </select>
        <label>副词条2数值：</label>
        <input type="number" id="adverb_substat_2_data" name="adverb_substat_2_data" min="0" max="9999" step="0.1" value=<?php echo $row["adverb_substat_2_data"]; ?> required><br>

        <label>副词条3：</label>
        <select id="adverb_substat_3" name="adverb_substat_3" required>
        <option value="<?php echo $row["adverb_substat_3"]; ?>" selected hidden required><?php echo $row["adverb_substat_3"]; ?></option>
        <option value="攻击力">攻击力</option>
        <option value="攻击力百分比">攻击力百分比</option>
        <option value="防御力">防御力</option>
        <option value="防御力百分比">防御力百分比</option>
        <option value="生命值">生命值</option>
        <option value="生命值百分比">生命值百分比</option>
        <option value="暴击率">暴击率</option>
        <option value="暴击伤害">暴击伤害</option>
        <option value="元素精通">元素精通</option>
        <option value="元素充能效率">元素充能效率</option>
        </select>
        <label>副词条3数值：</label>
        <input type="number" id="adverb_substat_3_data" name="adverb_substat_3_data" min="0" max="9999" step="0.1" value=<?php echo $row["adverb_substat_3_data"]; ?> required><br>

        <label>副词条4：</label>
        <select id="adverb_substat_4" name="adverb_substat_4" required>
        <option value="<?php echo $row["adverb_substat_4"]; ?>" selected hidden required><?php echo $row["adverb_substat_4"]; ?></option>
        <option value="攻击力">攻击力</option>
        <option value="攻击力百分比">攻击力百分比</option>
        <option value="防御力">防御力</option>
        <option value="防御力百分比">防御力百分比</option>
        <option value="生命值">生命值</option>
        <option value="生命值百分比">生命值百分比</option>
        <option value="暴击率">暴击率</option>
        <option value="暴击伤害">暴击伤害</option>
        <option value="元素精通">元素精通</option>
        <option value="元素充能效率">元素充能效率</option>
        </select>
        <label>副词条4数值：</label>
        <input type="number" id="adverb_substat_4_data" name="adverb_substat_4_data" min="0" max="9999" step="0.1" value=<?php echo $row["adverb_substat_4_data"]; ?> required><br>

        <input type="hidden" id="request" name="request" value="1">
        <button type="submit">确定</button>
    </form>
        <a href="index.php" class="login-link">返回主页</a>
    </div>
    
</body>
</html>
