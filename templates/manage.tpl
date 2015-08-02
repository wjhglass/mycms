<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<link rel="stylesheet" type="text/css" href="../style/magic.css" />
</head>
<body id="main">
	
	<div class="map">
		管理首页&gt;&gt;管理员管理&gt;&gt;<strong>{$title}</strong>
		{if $list}
		<table cellspacing="0">
			<tr><th>编号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录ip</th><th>最近登录时间</th><th>注册时间</th><th>操作</th></tr>
			{foreach $manages(key,value)}
				<tr>
					<td>{@value->id}</td>
					<td>{@value->admin_user}</td>
					<td>{@value->level_name}</td>
					<td>{@value->login_count}</td>
					<td>{@value->last_ip}</td>
					<td>{@value->last_time}</td>
					<td>{@value->reg_time}</td>
					<td><a href="manage.php?action=edit">编辑</a> | <a href="manage.php?action=delete">删除</a></td>
				</tr>
			{/foreach}
		</table>
		<p class="center">[<a href="manage.php?action=add">新增管理员</a>]</p>
		{/if}
	</div>
		{if $add}
			<form method="post">
				<table cellspacing="0" class="left">
					<tr><td>用户名：<input type="text" name="admin_user" class="text" /></td></tr>
					<tr><td>密　码：<input type="password" name="admin_password" class="text" /></td></tr>
					<tr><td>等　级：
						<select name="level">
							<option value="5">普通管理员</option>
							<option value="6">超级管理员</option>
						</select>
					</td></tr>
					<tr><td><input type="submit" name="send" value="新增管理员" class="submit" />[<a href="manage.php?action=list">返回列表</a>]</td></tr>
				</table>
			</form>
		{/if}
		{if $edit}
			<form method="post">
				<table cellspacing="0" class="left">
					<tr><td>用户名：<input type="text" name="admin_user" class="text" /></td></tr>
					<tr><td>密　码：<input type="password" name="admin_password" class="text" /></td></tr>
					<tr><td>等　级：
						<select name="level">
							<option value="5">普通管理员</option>
							<option value="6">超级管理员</option>
						</select>
					</td></tr>
					<tr><td><input type="submit" name="send" value="编辑管理员" class="submit" />[<a href="manage.php?action=list">返回列表</a>]</td></tr>
				</table>
			</form>
		{/if}
		{if $delete}
			删除
		{/if}
	
	
</body>
</html>