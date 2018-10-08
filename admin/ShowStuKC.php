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
                    <li><a href="index.php">学生信息录入</a></li>
                    <li><a href="StuSearch.php">学生信息查询</a></li>
                    <li><a href="#">学生学分排序</a></li>


                    <li class="nav-header"><i class="icon-signal"></i> 课程信息管理</li>
                    <li class=""><a href="">课程信息录入</a></li>
                    <li><a href="">课程信息查询</a></li>


                    <li class="nav-header"><i class="icon-user"></i> 成绩信息管理</li>
                    <li><a href="AddStuScore.php">成绩信息录入</a></li>
                    <li class="active"><a href="#">学生成绩查询</a></li>
                    <li><a href="#">退出</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="row-fluid">
                <div class="page-header">
                    <h1>学生成绩查询 <small></small></h1>
                </div>

                <div id="placeholder" style="width:80%;height:600px;">
                    <!--              插入表单1-->
                    <form name="frm1" method="post" action="ShowStuKC.php" style="margin:0">
                        <table width="500" align="center">
                            <tr>
                                <td width="60"><span>学号:</span></td>
                                <td width="160"><input name="StuNum" type="text" size="20"></td>
                                <td><input type="submit" name="query" value="查找"></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    include "SearchScore.php";
                    ?>
                </div>
                <br />
                <div id="visits" style="width:80%;height:300px;">
                    <!--              插入表单2-->
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


