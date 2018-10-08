<?php
require_once "../public/Config.php";
session_start();
$number = @$_POST['StuNum'];
$_SESSION['number'] = $number;

// 根据学号在视图 XS_KC_CJ 中查找课程号、课程名、成绩
$sql1 = "select KCH, KCM, CJ FROM XS_KC_CJ WHERE XH= '$number'";
$sql2 = "select XM, ZXF, ZP FROM XSB WHERE XH = '$number'";
$result1 = mysqli_query($conn, $sql1);
/*$result3 = mysqli_query($conn,$sql2);
$result2 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
echo "<pre>";
var_dump($result1);
var_dump($result2);*/
$result2 = mysqli_query($conn, $sql2);
echo "<table width='500' align='center'>";
echo "<tr><td>";
echo "<table width='350' border='1' cellpadding='0' cellspacing='0'>";
echo "<tr bgcolor='#CCCCCC'>";
echo "<td width='100'>课程号</td>";
echo "<td width='150'>课程名</td>";
echo "<td width='100'>成绩</td></tr>";
if(!$result1){
    for($i = 0; $i <12; $i ++){
        echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
    }
}else{
    // 设置计数器
    $count = 0;
    while($row1 = mysqli_fetch_array($result1)){
        list($KCH, $KCM, $CJ)=$row1;
        echo "<tr><td>$KCH &nbsp;</td>"; //输出结果至表格
        echo "<td>$KCM &nbsp;</td>";
        echo "<td>$CJ &nbsp;</td></tr>";
        $count ++;
    }
    for($i = 0;$i < 12; $i ++){
        echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
    }
}
echo "</table>";
$row2 = mysqli_fetch_array($result2);
list($XM, $ZXF, $ZP)=$row2;
if($number&&(!$XM)){
    echo "<script>alert('该学号不存在!');location.href='ShowStrKC.php';</script>";
}else{
    // 将信息输到另外一个表格中
    echo "<table width='150' border='1' cellpadding='0' cellspacing='0' >";
    echo "<tr><td bgcolor='#CCCCCC'>姓名:</td></tr>";
    echo "<tr><td align='center'>$XM&nbsp;</td></tr>";
    echo "<tr><td bgcolor='#CCCCCC'>总学分</td></tr>";
    echo "<tr><td align='center'>$ZXF&nbsp;</td></tr>";
    echo "<tr><td bgcolor='#CCCCCC'>照片</td></tr>";
    echo "<tr><td align='center'>";
    if($ZP)
        echo "<img src='showpicture.php?time.".time()."'>";
    else
        echo "<center>无</center></tr>";
    echo "<tr><td align='center'>";
    // 单击退出返回到主页
    echo "<input type='button' name='exit' value='退出' onclick=\"window.location='main.html'\"></td></tr>";
    echo "</table></td>";
}
echo "</tr></table>";
?>