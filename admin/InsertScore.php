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
        $XS_result = mysqli_query($conn, $XS_sql);
//        echo "<pre>";
//        var_dump($XS_sql);
        $total = mysqli_num_rows($XS_result);
        // 获取地址栏中 page 的值不存在则设为 1
        $page = isset($_GET['page'])?intval($_GET['page']):1;
        $url = 'AddStuScore.php';
        //页码计算
        $num = 10;
        $pagenum = ceil($total/$num);
        $page = min($pagenum, $page);
        $prepg = $page -1;
        $nextpg = ($page == $pagenum? 0:$page+1);
        $offset = ($page -1)*$num;
        $endnum = $offset + $num;
        //查找从($offset + 1)行到$endnum 行的记录
        $new_sql = $XS_sql." limit ".($page -1)*$num.",".$num;
        $new_result = mysqli_query($conn, $new_sql);
        while($new_row = mysqli_fetch_array($new_result,MYSQLI_ASSOC)){
            list($number, $name) = $new_row;
            // 查找成绩的 SQL 语句
            $CJ_sql = "select CJ from CJB WHERE XM= '$number' AND KCH =(SELECT KCH from KCB WHERE KCM ='$KCName')";
            $CJ_result = mysqli_query($conn, $CJ_sql);
            $CJ_row = mysqli_fetch_array($CJ_result, MYSQLI_ASSOC);
            $points = $CJ_row['CJ'];
            // 设置一个隐藏控件用于存放课程名
            echo "<input type=hidden value=$KCName id='course'>";
            // 输出学号
            echo "<tr align='center'><td width='110'>$number</td>";
            echo "<td width='110'>$name</td>";
            // 在文本框中输出成绩
            echo "<td width='110'><input id='points-$number' type='text' size='12' value='$points'></td>";
            // 设置保存超链接，单击超链接时调用 run()函数
            echo "<td><a href=# onclick=\"run(this.id,'$number')\" id='keep-$number'>保存</a>&nbsp;&nbsp;";
            // 设置删除超链接
            echo "<a href=# onclick=\"run(this.id,'$number')\" id='delete-$number'>删除</a></td></tr>";
    }
        echo "</table>";
        // 开始分页导航条代码
        $pagenav="";
        if($prepg)
            $pagenav.=" <a href='$url?page=$prepg&KCName=$KCName&ZYName=$ZYname'>上一页</a>";
        for($i=1; $i < $pagenum; $i++){
            if($page == $i)
                $pagenav.=$i." ";
            else
                $pagenav.=" <a href='$url?page=$i&KCName=$KCName&ZYName=$ZYname'>$i</a>";
        }if($nextpg)
            $pagenav.=" <a href='$url?page=$nextpg&KCName=$KCName&ZYName=$ZYname'>下一页</a>";
        $pagenav.="共(".$pagenum.")页";
        echo "<br><div align='center'><b>".$pagenav."</b></div> ";      // 输出分页导航
    }

}
?>
<script>
    // 调用AJAX 无刷新技术
    var xmlHttp;
    function GetXmlHttpObject() {
        var xmlHttp = null;
        try{
            xmlHttp = new XMLHttpRequest();
        }
        catch(e){
            try{
                ttp = new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                mlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlHttp;
    }
    // run() 函数的参数str是超链接的id， num是成绩文本框id 的后缀
    function run(str, num) {
        // 调用 GetXmlHttpObject()创建一个XMLHTTP 对象
        xmlHttp = GetXmlHttpObject();
        var kcname = document.getElementById("course").value;
        var points = document.getElementById("points-" + num).value;
        var url="StuCJ.php";
        url = url +"?id" + str + "&points=" + points + "&kcname" + kcname; // url地址，以GET方式传递
        // 添加一个随机数，以防服务器使用缓存的文件
        url = url + "&sid=" + Math.random();
        // 通过给定的URL打开 XMLHTTP 对象
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
        xmlHttp.onreadystatechange=function () {
            if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
                alert(xmlHttp.responseText);    // 弹出对话框提示操作结果
                 if(xmlHttp.responseText == '删除成功')
                     document.getElementById("points-" + num).value="";
            }
        }
    }
</script>

