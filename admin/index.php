<?php
header ( "Content-type: text/html; charset=utf-8" );
require substr( dirname ( __FILE__ ), 0, -6) . '/init.inc.php';
if (isset($_SESSION['admin'])) {
	Tool::alertLocation(null, 'admin.php');
} else {
	Tool::alertLocation(null, 'admin.login.php');
}