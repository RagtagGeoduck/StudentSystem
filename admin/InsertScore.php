<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/10/8
 * Time: 1:20 PM
 */
require_once "../public/Config.php";
$KCName = $_GET['KCName'];
$ZYName = $_GET['ZYName'];
echo "<br><div align='center'>$KCName</div>";
echo "<table width='450' border='1' align='center' cellpadding='0' cellspacing='0'>";
echo "<tr bgcolor='#CCCCCC' align='center'><td>学号</td>";
echo "<td>姓名</td>";
echo "<td>成绩</td>";
echo "<td width='160'>操作</td></tr>";
if(!$KCName&&!$ZYName){
    for($i = 0; $i < 10; $i ++){
        echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
    }
}else{
    if($KCName == "请选择")
        echo "<script>alert('请选择课程');location.href='AddStuScore.php'</script>";
    else{
        $total = 0;
        if($ZYName == "请选择")
            // 查找学号、姓名所在的行数
            $XS_sql = "select XH, XM from XSB";
        else{
            $XS_sql="select XH, XM from XSB WHERE ZY ='$ZYName'";
        }
    }
}

