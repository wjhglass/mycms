<?php
//数据库配置文件
define('DB_HOST','localhost');										//主机IP
define('DB_USER','root');											//账号
define('DB_PASS','');												//密码
define('DB_NAME','mycms');											//数据库

// 系统配置
define('GPC',get_magic_quotes_gpc());						//sql转义功能是否打开了
define ('PAGE_SIZE', 2);											// 分页中每一页的条数
define ('ARTICLE_SIZE', 10);											// 每一页文档显示的条数
define ('BOTH_NUM', 3);											// 分页中两边保持数字分页的量
define ('CODE_LENGTH', 5);											// 验证码的长度
define ('PREV_URL', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');						// 上一页地址
define ('NAV_SIZE', 10);						// 前台主导航显示的条数
define ('UPDIR','/uploads/');					//上传主目录
define('MARK',ROOT_PATH.'/images/zqc.jpg');			//水印图片

// 模版配置信息
define ( 'TPL_DIR', ROOT_PATH . '/templates/' );
define ( 'TPL_C_DIR', ROOT_PATH . '/templates_c/' );
define ( 'CACHE', ROOT_PATH . '/chache/' );