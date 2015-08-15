<?php
require substr( dirname ( __FILE__ ), 0, -6) . '/init.inc.php';
global $tmp;
$login = new LoginAction($tmp);
$login->action ();
if (isset($_SESSION['admin'])) {
	Tool::alertLocation(null, 'admin.php');
}
$tmp->display('admin.login.tpl');