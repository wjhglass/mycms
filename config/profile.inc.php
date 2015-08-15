<?php
//数据库配置文件
define('DB_HOST','localhost');										//主机IP
define('DB_USER','root');											//账号
define('DB_PASS','');												//密码
define('DB_NAME','mycms');											//数据库

// 系统配置
define('GPC',get_magic_quotes_gpc());						//sql转义功能是否打开了
define ('PAGE_SIZE', 4);											// 分页中每一页的条数
define ('BOTH_NUM', 3);											// 分页中两边保持数字分页的量
define ('CODE_LENGTH', 5);											// 验证码的长度
define ('PREV_URL', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');						// 上一页地址

// 模版配置信息
define ( 'TPL_DIR', ROOT_PATH . '/templates/' );
define ( 'TPL_C_DIR', ROOT_PATH . '/templates_c/' );
define ( 'CACHE', ROOT_PATH . '/chache/' );