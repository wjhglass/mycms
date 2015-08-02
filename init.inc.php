<?php
header ( "Content-type: text/html; charset=utf-8" );
// 定义各类文件的根目录
define ( 'ROOT_PATH', dirname ( __FILE__ ) );

// 引入配置信息
require ROOT_PATH . '/config/profile.inc.php';
// 引入库
require ROOT_PATH . '/include/Templates.class.php';
//引入缓存的配置文件
require '/cache.inc.php';
//引入数据库操作文件
require '/include/DB.class.php';

// 实例化模版类
$tmp = new Templates ();

