<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
//跨域：协议不一致，端口号，域名
//1.jsonp在页面动态插入script里的src里不存在跨域
//2.代理
//3.服务器
//解决跨域
//header("Access-Control-Allow-Origin:*");
////后台不允许发送头信息，加上这句
//header('Access-Control-Allow-Headers:content-type');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With,Authorization,Content-Type,RetryAfter,retry-after,Accept, token");
header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS');
if($_SERVER['REQUEST_METHOD']=='OPTIONS'){
    exit;
}
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
