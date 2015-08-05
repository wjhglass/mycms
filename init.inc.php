<?php
header ( "Content-type: text/html; charset=utf-8" );
// 定义各类文件的根目录
define ( 'ROOT_PATH', dirname ( __FILE__ ) );

// 引入配置信息
require ROOT_PATH . '/config/profile.inc.php';
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
// 引入缓存的配置文件
require '/cache.inc.php';

// 实例化模版类
$tmp = new Templates ();

