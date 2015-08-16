<?php
// 是否开启缓冲区
define ( 'IS_CACHE', false );
IS_CACHE ? ob_start () : null;
// 模版句柄
global $tmp;
$nav = new NavAction($tmp);
$nav->displayFront();