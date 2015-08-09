<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登录cms后台管理系统</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>
<body>
	<form id="adminLogin" name="login" method="post" action="manage.php?action=login">
		<fieldset>
			<legend>登录cms后台管理系统</legend>
			<label>帐　号：<input type="text" name="admin_user" class="text" /></label>
			<label>密　码：<input type="password" name="admin_password" class="text" /></label>
			<label>验证码：<input type="text" name="code" class="text" /></label>
			<label class="t">输入下图的字符，不区分大小写</label>
			<label><img src="../config/code.php" width="130" height="50" alt="验证码" onclick="javascript:this.src = '../config/code.php?tm=' + Math.random();" /></label>
			<input type="submit" class="submit" name="send" value="登录" onclick="return checkLogin();" />
		</fieldset>
	</form>
	<script type="text/javascript" src="../js/admin.login.js"></script>
</body>
</html>