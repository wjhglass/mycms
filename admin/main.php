<?php
header ( "Content-type: text/html; charset=utf-8" );
require substr( dirname ( __FILE__ ), 0, -6) . '/init.inc.php';
global $tmp;
$tmp->display('main.tpl');
