<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/10/7
 * Time: 1:58 AM
 */
header('Content-type:image/gif');
session_start();
require_once "../public/Config.php";
$number = $_SESSION['number'];
$sql = "select ZP from XSB WHERE XH ='$number'";
$result = mysqli_query($conn, $sql);
// 停用PDO 封装
//$result = $conn ->doSql($sql);
$row = mysqli_fetch_array($result);
$image = $row['ZP'];
echo $image;
session_destroy();
?>