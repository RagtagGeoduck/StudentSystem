<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/10/7
 * Time: 10:41 AM
 */
require_once "../public/Config.php";
$StuNumber = $_GET['StuNumber'];
$StuName = $_GET['StuName'];
$Project = $_GET['select'];
//生成sql语句的getsql函数
function getsql($StuNum, $StuNa, $Pro){
    $sql = "select * from XSM WHERE ";
    $note = 0;
    if($StuNum){
        $sql.= "XH like '%$StuNum'";
        $note = 1;
    }
    if($StuNa){
        if($note == 1)
            // 此处sql 语句开头需要加空格
            $sql = " and XM like '%$StuNa%'";
        else
            $sql.="XM like '%$StuNa%'";
        $note = 1;
    }
    if($Pro&&($Pro!="所有专业")){
        if($note == 1)
            // 此处sql 语句开头需要加空格
            $sql.=" and ZY='$Pro'";
        else{
            $sql.="ZY='$Pro'";
            $note=1;
        }
    }
    if($note == 0){
        $sql = "select * from XSB";
    }
    return $sql;
}
$sql = getsql($StuNumber, $StuName, $Project);
// 更新sql 语句，待确认
$result = mysqli_query($conn, $sql);
$total = mysqli_num_rows($result);
$page = isset($_GET['page'])?intval($_GET['page']):1;
$num = 12;
$url = 'StuSearch.php';

// 计算页码
$pagenum = ceil($total/$num);
$page = min($pagenum, $page);
$prepg = $page - 1;
$nextpg = ($page == $pagenum ? 0:$page + 1);
$new_sql = $sql." limit ".($page - 1)*$num.",".$num;
// 更新sql
$new_result = mysqli_query($conn, $new_sql);
// 更新sql 语句
if($new_row = mysqli_fetch_array($new_result, MYSQLI_ASSOC)){
    // 若有查询结果，表格形式输出学生信息
    echo "<br><center><font size='5' face='楷体_GB2312' color='#0000FF'>学生信息查询结果</font></center>";
    echo "<table width='480' border='1' align='center' cellpadding='0' cellspacing='0'>";
    echo "<tr bgcolor='#CCCCCC'><td>学号</td>";
    echo "<td>姓名</td>";
    echo "<td>性别</td>";
    echo "<td>出生时间</td>";
    echo "<td>专业</td>";
    echo "<td>总学分</td>";
//    echo "<td>备注</td>";
    do
    {
        list($XH, $XM, $XB, $CSSJ, $ZY, $ZXF)=$new_row;
        //设置学号链接
        echo "<tr><td><a href='info.php?id=$XH' target=search_frmright>$XH</a></td>";
        echo "<td>$XM</td>";
        if($XB == 1)
            echo "<td>男</td>";
        else
            echo "<td>女</td>";
        $timeTemp = strtotime($CSSJ);
        $time = date("Y-n-j", $timeTemp);
        echo "<td>$time</td>";
        echo "<td>$ZY</td>";
        echo "<td>$ZXF</td>";
        echo "</tr>";
    }while($new_row = mysqli_fetch_array($new_result, MYSQLI_ASSOC));
    echo "</table>";
    // 分页导航条代码
    $pagenav = "";
    if($prepg)
        $pagenav.="<a href='$url?page=$prepg&StuNumber=$StuNumber&StuName=$StuName&select=$Project'>上一页</a>";
    for($i = 1;$i <= $pagenum; $i++){
        if($page == $i)
            $pagenav.=$i." ";
        else
            $pagenav.=" <a href='$url?page=$i&StuNumber=$StuNumber&StuName=$StuName&select=$Project'>$i</a>";
    }
    if($nextpg)
        $pagenav.=" <a href='$url?page=$nextpg&StuNumber=$StuNumber&StuName=$StuName&select=$Project'>下一页</a>";
    $pagenav.="共(".$pagenum.")页";
    // 输出分页导航
    echo "<br><div align='center'><b>".$pagenav."</b></div>";
}
else
    echo "<script>alert('无记录!');location.href='StuSearch.php';</script>";
?>
