<?php
// 模版句柄
global $tmp;
if (FRONT_CACHE) {
	ob_start();
	$tmp->cache(Tool::tplName());
}
$nav = new NavAction($tmp);
$nav->displayFront();
