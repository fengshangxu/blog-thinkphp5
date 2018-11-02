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
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
//header('Access-Control-Allow-Origin:http://localhost:8081');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-headers:Origin, X-Requested-with, Content-type, Accept');
header("Content-type: text/html; charset=utf-8");
// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件

require __DIR__ . '/../thinkphp/start.php';
