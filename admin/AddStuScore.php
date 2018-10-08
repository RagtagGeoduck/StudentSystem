<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>学生信息查询</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html" charset="GB2312">
    <link href="../public/css/bootstrap.css" rel="stylesheet">
    <link href="../public/css/site.css" rel="stylesheet">
    <link href="../public/css/bootstrap-responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
    <![endif]-->
    <!--[if lte IE 8]><script src="../public/js/excanvas.min.js"></script><![endif]-->
    <style type="text/css">
        html, body {
            height: 100%;
        }
    </style>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Admin</a>
            <div class="btn-group pull-right">
                <a class="btn" href=""><i class="icon-user"></i> Admin</a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">个人资料</a></li>
                    <li class="divider"></li>
                    <li><a href="#">退出</a></li>
                </ul>
            </div>
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="index.php">首页</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                <ul class="nav nav-list">
                    <li class="nav-header"><i class="icon-wrench"></i> 学生信息管理</li>
                    <!--              <li ><a href="">学生信息录入</a></li>-->
                    <li><a href="index.php">学生信息录入</a></li>
                    <li><a href="StuSearch.php">学生信息查询</a></li>
                    <li><a href="#">学生学分排序</a></li>


                    <li class="nav-header"><i class="icon-signal"></i> 统计</li>
                    <li class=""><a href="">通用</a></li>
                    <li><a href="">用户</a></li>
                    <li><a href="">访问者</a></li>


                    <li class="nav-header"><i class="icon-user"></i> 成绩信息管理</li>
                    <li class="active"><a href="AddStuScore.php">成绩信息录入</a></li>
                    <li><a href="temple.php">学生成绩查询</a></li>
                    <li><a href="#">退出</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="row-fluid">
                <div class="page-header">
                    <h1>学生信息录入 <small></small></h1>
                </div>


                <!--              <div align="center"><font face="幼圆" size="5" content="#008000"><b>学生信息录入</b></font></div>-->

                <div id="placeholder" style="width:80%;height:600px;">
                    <!--              插入表单-->
                    <div align="center"><font face="幼圆" size="5" content="#008000"><b>成绩信息录入</b></font> </div>
                    <form action="AddStuScore.php" method="get" style="margin: 0;">
                        <table width="450" align="center">
                            <tr>
                                <td width="60" bgcolor="#CCCCCC">课程名:</td>
                                <td width="50"><select name="KCName"><option value="请选择">请选择</option>
                                        <?php
                                        require_once "../public/Config.php";
                                        $kc_sql = "select distinct KCM from KCB";
                                        $kc_result = mysqli_query($conn, $kc_sql);
                                        echo "<pre>";
                                        var_dump($kc_result);
                                        while($kc_result=mysqli_fetch_array($kc_result, MYSQLI_ASSOC)){
                                            echo "<option>".$kc_row['KCB']."</option>";
                                        }
                                        ?>
                                    </select> </td>
                                <td width="60" bgcolor="#CCCCCC">专业:</td>
                                <td width="50"><select name="ZYName">
                                        <option value="请选择">请选择</option>
                                        <?php
                                        $zy_sql = "select distinct ZY from XSB";
                                        $zy_result = mysqli_query($conn, $zy_sql);
                                        while($kc_result=mysqli_fetch_array($zy_result, MYSQLI_ASSOC)){
                                            echo "<option>".$zy_row['ZY']."</option>";
                                        }
                                        ?>
                                    </select> </td>
                                <td width="60" align="center">
                                    <input type="submit" name="Query" value="查询">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    @include "InsertScore.php";
                    ?>
                </div>
                <br />
                <div id="visits" style="width:80%;height:300px;"></div>
            </div>
        </div>
    </div>
    <hr>
    <footer class="well">
        &copy; Admin
    </footer>
</div>
</body>
</html>
<?php
$num = @$_POST['StuNumber'];
$XH = @$_POST['h-StuNum'];
$name = @$_POST['StuName'];
$sex = @$_POST['Sex'];
$birthday = @$_POST['Birthday'];
$project = @$_POST['Project'];
$points = @$_POST['StuZXF'];
$note = @$_POST['StuBZ'];
$tmp_file = @$_FILES['file']['tmp_name'];
$handle = @fopen($tmp_file,'r');

//将图片转化为二进制
$picture = @addslashes(fread($handle, filesize($tmp_file)));
// 正则表达式验证日期格式
$checkbirthday = preg_match('/^\d{4}-(0?\d|1?[012])-(0?\d|[12]\d|3[01])$/', $birthday);

// 函数验证表单数据正确性
function test($num, $name, $checkbirthday, $tmp_file){
    if($num == NULL){
        echo "<script>alert('学号不能为空!');location.href='AddStu.php';</script>";
        exit;
    }
    else if($name == NULL){
        echo "<script>alert('姓名不能为空!');location.href='AddStu.php';</script>";
        exit;
    }
    else if($checkbirthday){
        echo "<script>alert('日期格式错误!');location.href='AddStu.php';</script>";
        exit;
    }
    else{
        // 如果上传照片
        if($tmp_file){
            $type = @$_FILES['file']['type'];
            $Psize = @$_FILES['file']['size'];
            // 判断图片格式
            if ((($type!="image/gif")&&($type!="image/jpeg")&&($type!="image/pjpeg")&&($type!="image/bmp"))){
                echo "<script>alert('照片格式不对!');location.href='AddStu.php';</script>";
                exit;
            }
            else if($Psize > 1000000){
                echo "<script>alert('照片尺寸太大，无法上传!');location.href='AddStu.php';</script>";
                exit;
            }
        }
    }
}

// 按钮功能修改
if(@$_POST['b']=='修改'){
    echo "<script>if(confirm('确认修改')){}</script>";
    test($num, $name, $checkbirthday, $tmp_file);
    if($num != $XH){
        echo "<script>alert('学号与元数据有异,无法修改!');location.href='AddStu.php';</script>";
    }else{
        if(!$tmp_file){
            $update_sql = "update XSB set XM = '$name',XB = $sex, CSSJ='$birthday',ZY='$project',BZ = '$note' WHERE XH = '$XH'";
        }else{
            $update_sql = "update XSB set XM = '$name', XB = $sex, CSSJ='$birthday', ZY='$project', BZ = '$note', ZP = '$picture' WHERE XH = '$XH'";
        }
        // 对sql 语句进行更新，原代码被弃用
        $update_result = mysqli_query($conn,$update_sql);
        if(mysqli_affected_rows($conn)!=0)
            echo "<script>alert('修改成功!');location.href='AddStu.php';</script>";
        else
            echo "<script>alert('修改成功,请检查输入信息!');location.href='AddStu.php';</script>";
    }
}
// 单击 【添加】按钮

if(@$_POST["b" == '添加']){
    test($num, $name, $checkbirthday, $tmp_file);
    // 从学生表中选择对应学号的信息
    $s_sql = "select XH from XSB WHERE XH='$num'";
    // 更新 sql 语句
    $s_result = mysqli_query($conn, $s_sql);
    // 更新 mysqli_fetch_array 语句
    $s_row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($s_row)
        echo "<script>alert('学号已存在,无法添加!');location.href='AddStu.php';</script>";
    else{
        if(!$tmp_file){
            $insert_sql = "insert into XSB(XH, XM, XB, CSSJ, ZY, ZXF, BZ) VALUES ('$num', '$name', '$sex', '$birthday', '$project', 0, '$note')";

        }else{
            $insert_sql = "insert into XSB(XH, XM, XB, CSSJ, ZY, ZXF, BZ, ZP) VALUES ('$num', '$name', '$sex', '$birthday', '$project', 0, '$note', '$picture')";
        }
        $insert_sql = mysqli_query($conn, $insert_sql);
        // 更新sql 语句
        if(mysqli_affected_rows($conn)!=0)
            echo "<script>alert('添加成功!');location.href='AddStu.php';</script>";
        else
            echo "<script>alert('添加失败,请检查输入信息!');location.href='AddStu.php';</script>";
    }
}

// 单击 [删除] 按钮
if(@$_POST["b" == '删除']){
    if($num == NULL){
        echo "<script>alert('请输入要删除的学号!');location.href='AddStu.php';</script>";
    }else{
        $d_sql = "select XH from XSB WHERE XH = '$num'";    //查找学生信息
        // 更新sql 语句
        $d_result = mysqli_query($conn, $d_sql);
        $d_row = mysqli_fetch_array($d_resul, MYSQLI_ASSOC);
        if(!$d_row)
            echo "<script>alert('学号不存在,无法删除!');Location.href='AddStu.php';</script>";
        else{
            $del_sql = "delete from XSB WHERE XH = '$num'";
            $del_result = mysqli_query($conn, $del_sql) or die('删除失败');
            if($del_sql)
                echo "<script>alert('删除学号".$num."成功!');location.href='AddStu.php';</script>";
        }
    }
}
?>

