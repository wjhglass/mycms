<?php
header ( "Content-type: text/html; charset=utf-8" );
// 定义各类文件的根目录
define ( 'ROOT_PATH', dirname ( __FILE__ ) );
define ( 'TPL_DIR', ROOT_PATH . '/templates/' );
define ( 'TPL_C_DIR', ROOT_PATH . '/templates_c/' );
define ( 'CACHE', ROOT_PATH . '/chache/' );
define ( 'IS_CACHE', false );

// 是否开启缓冲区
IS_CACHE ? ob_start () : null;

// 引入库
require ROOT_PATH . '/include/Templates.class.php';

// 实例化模版类
$tmp = new Templates ();