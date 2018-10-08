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


                    <li class="nav-header"><i class="icon-signal"></i> 课程信息管理</li>
                    <li class=""><a href="">课程信息录入</a></li>
                    <li><a href="">课程信息查询</a></li>


                    <li class="nav-header"><i class="icon-user"></i> 成绩信息管理</li>
                    <li class="active"><a href="AddStuScore.php">成绩信息录入</a></li>
                    <li><a href="ShowStuKC.php">学生成绩查询</a></li>
                    <li><a href="#">退出</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="row-fluid">
                <div class="page-header">
                    <h1>成绩信息录入 <small></small></h1>
                </div>


                <!--              <div align="center"><font face="幼圆" size="5" content="#008000"><b>学生信息录入</b></font></div>-->

                <div id="placeholder" style="width:80%;height:300px;">
                    <!--              插入表单-->
<!--                    <div align="center"><font face="幼圆" size="5" content="#008000"><b>成绩信息录入</b></font> </div>-->
                    <form action="AddStuScore.php" method="get" style="margin: 0;">
                        <table width="450" align="center">
                            <tr>
                                <td width="60" bgcolor="#CCCCCC">课程名:</td>
                                <td width="50"><select name="KCName"><option value="请选择">请选择</option>
                                        <?php
                                        require_once "../public/Config.php";
                                        $kc_sql = "select distinct KCM from KCB";
                                        $kc_result = mysqli_query($conn, $kc_sql);
//                                        echo "<pre>";
//                                        var_dump($kc_result);
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
                            <?php
                            @include "InsertScore.php";
                            ?>
                        </table>
                    </form>

                </div>
                <br />
                <div id="visits" style="width:80%;height:300px;">
                   <!-- --><?php
/*                    require_once "../public/Config.php";
                    $sql = "select distinct KCM from KCB";
                    $result = mysqli_query($conn, $sql);
//                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//                    echo "<pre>";
//                    var_dump($result);
//                    var_dump($row)
                    */?>
                </div>
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

