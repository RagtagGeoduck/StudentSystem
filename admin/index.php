<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">  
	<title>学生成绩管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <li class="active"><a href="index.php">学生信息录入</a></li>
              <li><a href="StuSearch.php">学生信息查询</a></li>
                <li><a href="#">学生学分排序</a></li>


              <li class="nav-header"><i class="icon-signal"></i> 课程信息管理</li>
              <li class=""><a href="">课程信息录入</a></li>
              <li><a href="">课程信息查询</a></li>
<!--              <li><a href="">访问者</a></li>-->


              <li class="nav-header"><i class="icon-user"></i> 成绩信息管理</li>
              <li><a href="AddStuScore.php">成绩信息录入</a></li>
              <li><a href="ShowStuKC.php">学生成绩查询</a></li>
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
                <form name="frm1" method="post" action="index.php" style="margin:0">
                    <table width="480" align="center">
                        <tr>
                            <td width="168">根据学号查询学生信息:</td>
                            <td>
                                <input name="StuNumber" id="StuNumber" type="text" size="5">
                                <input type="submit" name="test" class="" value="查找">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                require_once "../public/Config.php";
                header("Content-type: text/html; charset=utf-8");
                session_start();
                $number = @$_POST['StuNumber'];
                $_SESSION['number']=$number;
                $sql = "select * from XSB WHERE XH = '$number'";
                $result = mysqli_query($conn, $sql);
//                $result = $conn ->doSql($sql);       // 停用PDO 封装

                // 浏览sql 语句结果
//                echo "<pre>";
//                var_dump($result);

                if (!$result) {
                    printf("Error: %s\n", mysqli_error($conn));
                    exit();
                }
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                if(($number!== NULL)&&(!$row))
                    echo "<script>alert('没有该学生信息！')</script>";
                $timeTemp = strtotime($row['CSSJ']);        //日期时间解析为UNIX时间戳
                $time = date("Y-n-j", $timeTemp);
                ?>
                <form name="frm2" method="post" style="margin:0" enctype="multipart/form-data">
                    <table bgcolor="#CCCCCC" width="430" border="1" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td bgcolor="#CCCCCC" width="90" align="center"><span class="">学号:</span></td>
                            <td>
                                <input name="StuNum" type="text" size="35" class="" value="<?php echo $row['XH'];?>">
                                <input name="h_StuNum" type="hidden" value="<?php echo $row['XH']?>">
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCCCCC" width="90" align="center"><span class="">姓名:</span></td>
                            <td>
                                <input name="StuName" type="text" size="35" class="" value="<?php echo $row['XM']?>">
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCCCCC"><div class="" align="center">性别:</div></td>
                            <?php
                            if($row['XB']==0){
                                ?>
                                <td>
                                    <input type="radio" name="Sex" value="1"><span class="">男</span>
                                    <input type="radio" name="Sex" value="0" checked="checked"><span class="">女</span>
                                </td>
                                <?php
                            }else{
                                ?>
                                <td>
                                    <input type="radio" name="Sex" value="1" checked="checked"><span class="">男</span>
                                    <input type="radio" name="Sex" value="0"><span class="">女</span>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <!--        // 出生日期-->
                        <tr>
                            <td bgcolor="#CCCCCC" align="center"><span>出生日期:</span></td>
                            <td>
                                <input name="Birthday" size="35" type="text" value="<?php if($time) echo $time;?>">
                            </td>
                        </tr>
                        <!--        //专业-->
                        <tr>
                            <td bgcolor="#CCCCCC" align="center"><span>专业:</span></td>
                            <td>
                                <input name="Project" size="35" type="text" value="<?php echo $row['ZY'];?>">
                            </td>
                        </tr>
                        <!--        //总学分-->
                        <tr>
                            <td bgcolor="#CCCCCC" align="center"><span>总学分:</span></td>
                            <td>
                                <input name="StuZXF" size="35" type="text" value="<?php echo $row['ZXF'];?>">
                            </td>
                        </tr>
                        <!--        //备注-->
                        <tr>
                            <td bgcolor="#CCCCCC" align="center"><span>备注:</span></td>
                            <td>
                                <textarea cols="34" role="4" name="StuBZ"><?php echo $row['BZ'];?></textarea>
                            </td>
                        </tr>
                        <!--        //学生照片-->
                        <tr>
                            <td bgcolor="#CCCCCC" height="150" align="center"><span>学生照片:</span></td>
                            <td align="center">
                                <?php
                                if($row['ZP'])
                                    echo "<img src='showpicture.php?time=".time()."'>";
                                else
                                    echo "<div>暂无照片</div>"
                                ?>
                            </td>
                        </tr>
                        <!--        //-->
                        <tr>
                            <td align="center" colspan="2" bgcolor="#CCCCCC">
                                <input name="b" type="submit" value="修改">&nbsp;&nbsp;
                                <input name="b" type="submit" value="添加">&nbsp;&nbsp;
                                <input name="b" type="submit" value="删除">&nbsp;&nbsp;
                                <input name="b" type="button" value="退出" onclick="window.location='main.html'">
                            </td>
                        </tr>
                    </table>
                </form>
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
        echo "<script>alert('学号不能为空!');location.href='index.php';</script>";
        exit;
    }
    else if($name == NULL){
        echo "<script>alert('姓名不能为空!');location.href='index.php';</script>";
        exit;
    }
    else if($checkbirthday){
        echo "<script>alert('日期格式错误!');location.href='index.php';</script>";
        exit;
    }
    else{
        // 如果上传照片
        if($tmp_file){
            $type = @$_FILES['file']['type'];
            $Psize = @$_FILES['file']['size'];
            // 判断图片格式
            if ((($type!="image/gif")&&($type!="image/jpeg")&&($type!="image/pjpeg")&&($type!="image/bmp"))){
                echo "<script>alert('照片格式不对!');location.href='index.php';</script>";
                exit;
            }
            else if($Psize > 1000000){
                echo "<script>alert('照片尺寸太大，无法上传!');location.href='index.php';</script>";
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
        echo "<script>alert('学号与元数据有异,无法修改!');location.href='index.php';</script>";
    }else{
        if(!$tmp_file){
            $update_sql = "update XSB set XM = '$name',XB = $sex, CSSJ='$birthday',ZY='$project',BZ = '$note' WHERE XH = '$XH'";
        }else{
            $update_sql = "update XSB set XM = '$name', XB = $sex, CSSJ='$birthday', ZY='$project', BZ = '$note', ZP = '$picture' WHERE XH = '$XH'";
        }
        // 对sql 语句进行更新，原代码被弃用
        $update_result = mysqli_query($conn,$update_sql);
        if(mysqli_affected_rows($conn)!=0)
            echo "<script>alert('修改成功!');location.href='index.php';</script>";
        else
            echo "<script>alert('修改成功,请检查输入信息!');location.href='index.php';</script>";
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
        echo "<script>alert('学号已存在,无法添加!');location.href='index.php';</script>";
    else{
        if(!$tmp_file){
            $insert_sql = "insert into XSB(XH, XM, XB, CSSJ, ZY, ZXF, BZ) VALUES ('$num', '$name', '$sex', '$birthday', '$project', 0, '$note')";

        }else{
            $insert_sql = "insert into XSB(XH, XM, XB, CSSJ, ZY, ZXF, BZ, ZP) VALUES ('$num', '$name', '$sex', '$birthday', '$project', 0, '$note', '$picture')";
        }
        $insert_sql = mysqli_query($conn, $insert_sql);
        // 更新sql 语句
        if(mysqli_affected_rows($conn)!=0)
            echo "<script>alert('添加成功!');location.href='index.php';</script>";
        else
            echo "<script>alert('添加失败,请检查输入信息!');location.href='index.php';</script>";
    }
}

// 单击 [删除] 按钮
if(@$_POST["b" == '删除']){
    if($num == NULL){
        echo "<script>alert('请输入要删除的学号!');location.href='index.php';</script>";
    }else{
        $d_sql = "select XH from XSB WHERE XH = '$num'";    //查找学生信息
        // 更新sql 语句
        $d_result = mysqli_query($conn, $d_sql);
        $d_row = mysqli_fetch_array($d_result, MYSQLI_ASSOC);
        if(!$d_row)
            echo "<script>alert('学号不存在,无法删除!');Location.href='index.php';</script>";
        else{
            $del_sql = "delete from XSB WHERE XH = '$num'";
            $del_result = mysqli_query($conn, $del_sql) or die('删除失败');
            if($del_sql)
                echo "<script>alert('删除学号".$num."成功!');location.href='index.php';</script>";
        }
    }
}
?>

