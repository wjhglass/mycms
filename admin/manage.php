<?php
require substr ( dirname ( __FILE__ ), 0, - 6 ) . '/init.inc.php';
Validate::checkSession();

global $tmp;
$manage = new ManageAction($tmp);

$manage->action ();
$tmp->display ( 'manage.tpl' );