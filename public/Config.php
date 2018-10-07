<?php
/**
 * Created by PhpStorm.
 * User: liujunhang
 * Date: 2018/6/19
 * Time: 19:58
 */

// 连接数据库必备参数 

function config(){
    $configList = [
        "host"=>"localhost", //mysql地址  
        "port"=>"3306", // mysql端口号
        "user"=>"root", // mysql用户名
        "passwd"=>"", // mysql 密码
        "dbname"=>"pscj" // 项目所使用的数据库
    ];

    return $configList;
}
