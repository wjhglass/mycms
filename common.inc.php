<?php
// 模版句柄
global $tmp;
define('IS_CACHE', true);
global $cache;
$isCache = !$cache->isNoCachePage();
if (IS_CACHE && $isCache) {
	ob_start();
	$tmp->cache(Tool::tplName().'.tpl');
}
$nav = new NavAction($tmp);
$nav->displayFront();
