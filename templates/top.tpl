<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>top</title>
	<link rel="stylesheet" type="text/css" href="../style/admin.css" />
	<link rel="stylesheet" type="text/css" href="../style/magic.css" />
</head>
<body id="top">
	<h1 class="magictime openDownRightRetourn">LOGO</h1>
	<ul>
		<li><a href="../templates/sidebar.html" target="sidebar" id="Nav1" onclick="adminTopNav(1);" class="selected">首页</a></li>
		<li><a href="../templates/sidebarn.html" target="sidebar" id="Nav2" onclick="adminTopNav(2);">内容</a></li>
		<li><a href="javascript:;" id="Nav3" onclick="adminTopNav(3);">会员</a></li>
		<li><a href="javascript:;" id="Nav4" onclick="adminTopNav(4);">系统</a></li>
	</ul>
	<p>
		您好，<strong>{$admin_user}</strong>[<a href="javascript:;">{$level_name}</a>][<a href="../" target="_blank">去首页</a>][<a href="admin.login.php?action=logout" target="_parent">退出</a>]
	</p>
	<script type="text/javascript" src="../js/admin.top.nav.js"></script>
</body>
</html>