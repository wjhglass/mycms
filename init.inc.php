<?php
header ( "Content-type: text/html; charset=utf-8" );
// 开启session
session_start();

// 定义各类文件的根目录
define ( 'ROOT_PATH', dirname ( __FILE__ ) );

// 引入配置信息
require ROOT_PATH . '/config/profile.inc.php';
//设置中国时区
date_default_timezone_set('Asia/Shanghai');

// 自动加载类
function __autoload($className) {
	if (substr ( $className, - 6 ) == 'Action') {
		require ROOT_PATH . '/action/' . $className . '.class.php';
	} elseif (substr ( $className, - 5 ) == 'Model') {
		require ROOT_PATH . '/model/' . $className . '.class.php';
	} else {
		require ROOT_PATH . '/include/' . $className . '.class.php';
	}
}

// 实例化模版类
$tmp = new Templates ();

// 引入初始化的配置文件
require '/common.inc.php';
