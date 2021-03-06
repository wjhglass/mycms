<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>CMS内容管理系统</title>
	<link rel="stylesheet" type="text/css" href="style/basic.css" />
	<link rel="stylesheet" type="text/css" href="style/reg.css" />
	<link rel="stylesheet" type="text/css" href="style/magic.css" />
</head>
<body>
	<!--导入头部文件-->
	{include file='header.tpl'}
	
	{if $reg}
	<!-- reg start -->
	<div id="reg">
		<h2>会员注册</h2>
		<form method="post" action="?action=reg" name="reg">
			<dl>
				<dd>用  户  名： <input type="text" name="username" class="text" placeholder="请输入用户名" /><span class="red">[必填]</span>（*用户名在2至20位之间）</dd>
				<dd>密　　码：<input type="password" name="password" class="text" placeholder="请输入密码"/><span class="red">[必填]</span>（*密码不得小于六位）</dd>
				<dd>密码确认：<input type="password" name="confirmPassword" class="text" placeholder="两次密码要保持一致哦"/><span class="red">[必填]</span></dd>
				<dd>电子邮件：<input type="email" name="email" class="text" placeholder="请输入电子邮件" /><span class="red">[必填]</span>（*每个电子邮件只能注册一个本网站的用户）</dd>
				<dd>选择头像：<select name="face" onchange="changeFace();">
								{foreach $optionOneGroup(key,value)}
									<option value="0{@value}.gif">0{@value}.gif</option>
								{/foreach}
								{foreach $optionTwoGroup(key,value)}
									<option value="{@value}.gif">{@value}.gif</option>
								{/foreach}
							</select>
				</dd>
				<dd><img name="faceimg" src="images/01.gif" alt="头像" width="72" height="72" class="face"/></dd>
				<dd>安全问题：<select name="question">
								<option value="">没有任何安全问题</option>
								<option value="您父亲的姓名">您父亲的姓名</option>
								<option value="您母亲的职业">您母亲的职业</option>
								<option value="您配偶的性别">您配偶的性别</option>
							 </select>
				</dd>
				<dd>问题答案：<input type="text" name="answer" class="text" /></dd>
				<dd>验  证  码： <input type="text" name="code" class="text" placeholder="请输入验证码" /><span class="red">[必填]</span></dd>
				<dd><img src="config/code.php" width="130" height="50" alt="验证码" onclick="javascript:this.src = 'config/code.php?tm=' + Math.random();" class="code" /></dd>
				<dd><input type="submit" onclick="return checkReg();" name="send" value="注册会员" /></dd>
			</dl>
		</form>
	</div>
	<!-- reg end -->
	{/if}
	
	{if $login}
	<div id="login">
		<h2>会员登录</h2>
		<form method="post" action="?action=login" name="login">
			<dl>
				<dd>用  户  名： <input type="text" name="username" class="text" placeholder="请输入用户名" /><span class="red">[必填]</span>（*用户名在2至20位之间）</dd>
				<dd>密　　码：<input type="password" name="password" class="text" placeholder="请输入密码"/><span class="red">[必填]</span>（*密码不得小于六位）</dd>
				<dd>登录保留：<input type="radio" name="time" checked="checked" value="0" /> 不保留
							<input type="radio" name="time" value="86400" /> 一天
							<input type="radio" name="time" value="604800" /> 一周
							<input type="radio" name="time" value="2592000" /> 一月
				</dd>
				<dd>验  证  码： <input type="text" name="code" class="text" placeholder="请输入验证码" /><span class="red">[必填]</span></dd>
				<dd><img src="config/code.php" width="130" height="50" alt="验证码" onclick="javascript:this.src = 'config/code.php?tm=' + Math.random();" class="code" /></dd>
				<dd><input type="submit" onclick="return checkLogin();" name="send" value="登录" /></dd>
			</dl>
		</form>
	</div>
	{/if}
	
	<!--导入尾部文件-->
	{include file='footer.tpl'}
	<script type="text/javascript" src="js/reg.js"></script>
</body>
</html>