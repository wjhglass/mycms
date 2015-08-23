<?php
// 定义目录
header ( "Content-type: text/html; charset=utf-8" );
global $tmp;

require dirname(__FILE__).'/init.inc.php';

$register = new RegisterAction($tmp);
$register->execute();
// 载入tpl文件
$tmp->display ( 'register.tpl' );