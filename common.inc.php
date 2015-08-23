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

$_cookie = new Cookie('username');
if (IS_CACHE) {
	$tmp->assign('header','<script type="text/javascript">getHeader();</script>');
} else {
	if ($_cookie->getCookie()) {
		$tmp->assign('header',$_cookie->getCookie().'，您好！ <a href="register.php?action=logout">退出</a> ');
	} else {
		$tmp->assign('header','	<a href="register.php?action=reg" class="usera">注册</a> <a href="register.php?action=login" class="usera">登录</a>');
	}
}