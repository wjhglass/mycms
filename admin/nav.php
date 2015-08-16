<?php
require substr ( dirname ( __FILE__ ), 0, - 6 ) . '/init.inc.php';
Validate::checkSession();

global $tmp;
$nav = new NavAction($tmp);

$nav->action();
$tmp->display('nav.tpl');