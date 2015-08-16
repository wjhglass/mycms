<?php
require substr ( dirname ( __FILE__ ), 0, - 6 ) . '/init.inc.php';
Validate::checkSession();

global $tmp;
$content = new ContentAction($tmp);

$content->action();
$tmp->display('content.tpl');
