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
		管理首页&gt;&gt;管理员管理&gt;&gt;<strong id="title">{$title}</strong>
		
		<ol>
			<li><a href="manage.php?action=display" class="selected">管理员列表</a></li>
			<li><a href="manage.php?action=add">新增管理员</a></li>
			{if $edit}
				<li><a>编辑管理员</a></li>
			{/if}
		</ol>
		
		{if $display}
		<table cellspacing="0">
			<tr><th>序号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录ip</th><th>最近登录时间</th><th>注册时间</th><th>操作</th></tr>
			{foreach $manages(key,value)}
				<tr>
					<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
					<td>{@value->admin_user}</td>
					<td>{@value->level_name}</td>
					<td>{@value->login_count}</td>
					<td>{@value->last_ip}</td>
					<td>{@value->last_time}</td>
					<td>{@value->reg_time}</td>
					<td><a href="manage.php?action=edit&id={@value->id}">编辑</a> | <a href="manage.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除吗？');">删除</a></td>
				</tr>
			{/foreach}
		</table>
		<p class="center">[<a href="manage.php?action=add">新增管理员</a>]</p>
		<div id="page">{$page}</div>
		{/if}
	</div>
		{if $add}
			<form method="post" name="add">
				<table cellspacing="0" class="left">
					<tr><td>用  户  名：<input type="text" name="admin_user" class="text" /> （在两位到20位之间）</td></tr>
					<tr><td>密　　码：<input type="password" name="admin_password" class="text" /> （不得小于六位）</td></tr>
					<tr><td>密码确认：<input type="password" name="password_confirm" class="text" /></td></tr>
					<tr><td>等　　级：
						<select name="level">
							{foreach $levels(key,value)}
								<option value="{@value->LEVEL}">{@value->level_name}</option>
							{/foreach}
						</select>
					</td></tr>
					<tr><td><input type="submit" name="send" value="新增管理员" onclick="return checkAdd();" class="submit" />[<a href="{$prev_url}">返回列表</a>]</td></tr>
				</table>
			</form>
		{/if}
		{if $edit}
			<form method="post" name="edit">
				<input type="hidden" value="{$id}" name="id" />
				<input type="hidden" value="{$level}" id="level" />
				<input type="hidden" value="{$admin_password}" name="pass" />
				<input type="hidden" value="{$prev_url}" name="prev_url" />
				<table cellspacing="0" class="left">
					<tr><td>用户名：<input type="text" name="admin_user" class="text" value="{$admin_user}" readonly="readonly" /></td></tr>
					<tr><td>密　码：<input type="password" name="admin_password" class="text" /></td></tr>
					<tr><td>等　级：
						<select name="level">
							{foreach $levels(key,value)}
								<option value="{@value->LEVEL}">{@value->level_name}</option>
							{/foreach}
						</select>
					</td></tr>
					<tr><td><input type="submit" name="send" value="编辑管理员" onclick="return checkEdit();" class="submit" />[<a href="{$prev_url}">返回列表</a>]</td></tr>
				</table>
			</form>
		{/if}
		<script type="text/javascript" src="../js/admin.manage.js"></script>
</body>
</html>