<?php
require substr( dirname ( __FILE__ ), 0, -6) . '/init.inc.php';
global $tmp;
Validate::checkSession();
$tmp->display('admin.tpl');
