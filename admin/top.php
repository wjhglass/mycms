<?php
header ( "Content-type: text/html; charset=utf-8" );
require substr( dirname ( __FILE__ ), 0, -6) . '/init.inc.php';
global $tmp;
$tmp->assign('admin_user', $_SESSION['admin']['admin_user']);
$tmp->assign('level_name', $_SESSION['admin']['level_name']);
Validate::checkSession();
$tmp->display('top.tpl');
