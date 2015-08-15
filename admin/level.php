<?php
require substr ( dirname ( __FILE__ ), 0, - 6 ) . '/init.inc.php';
Validate::checkSession();

global $tmp;
$level = new LevelAction($tmp);

$level->action();
$tmp->display('level.tpl');
