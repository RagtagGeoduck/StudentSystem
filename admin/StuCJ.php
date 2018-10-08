<?php
require_once "../public/Config.php";
header("Content-Type:text/html;charset=gb2312");
$id = $_GET['id'];
$kcname = $_GET['kcname'];
$points = $_GET['points'];
$array = explode("-",$id);
$action = $array[0];
$number = $array[1];
// 查询课程号
$kc_sql = "select KCH FROM KCB WHERE KCM = '$kcname'";
$kc_result = mysqli_query($conn, $kc_sql);
$kc_row = mysqli_fetch_array($kc_result,MYSQLI_ASSOC);
$kcnumber = $kc_row['KCH'];
    // 点击保存超链接
if($action == "keep"){
    if($points){
        // 调用存储过程 CJ_Data 实现成绩的插入和修改
        $cj_sql = "CALL CJ_Data('$number','$kcnumber',$points)";
        $cj_result = mysqli_query($conn, $cj_sql);
        if($cj_result)
            echo "保存成功";
        else
            echo "保存失败";
    }else
        echo "成绩值为空，请输入成绩";
}
    // 点击删除超链接
if($action == 'delete'){
        // 调用存储过程 CJ_Data, 成绩参数的值设为-1
    $cj_sql = "CALL CJ_Data('$number','$kcnumber', -1)";
    $cj_result = mysqli_query($conn, $cj_sql);
    if(mysqli_affected_rows($conn)!=0)
        echo "删除成功";
    else
        echo "删除失败";
}
?>
