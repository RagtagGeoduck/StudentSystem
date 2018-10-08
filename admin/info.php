<?php
require "fun.php";
header("Cache-Control:No-Cache");
header("Pragma:No-Cache");
session_start();
@$number = $_GET['id'];
@$_SESSION['number'] = $number;
$sql = "select BZ, ZP from XSB WHERE XH ='$number'";
// 更新sql 语句
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$BZ = $row['BZ'];
$ZP = $row['ZP'];
?>
<html>
<head>
    <title>备注和照片信息</title>
</head>
<body bgcolor="D9DFAA">
<br><br><br>
<table width="100" border="1">
    <tr>
        <td align="center">附加信息</td>
    </tr>
    <tr>
        <td bgcolor="#CCCCCC" align="center">备注</td>
    </tr>
    <tr>
        <td>
            <textarea rows="7" name="StuBZ"><?php if($BZ)echo $BZ;else echo "暂无"; ?></textarea>
        </td>
    </tr>
    <tr>
        <td bgcolor="#CCCCCC" align="center">照片</td>
    </tr>
    <tr>
        <td height="150" align="center">
            <?php
            if($ZP)
                echo "<img src='showpicture.php?time=".time()."'>";
            else
                echo "<center>无</center>";
            ?>
        </td>
    </tr>
</table>
</body>
</html>
