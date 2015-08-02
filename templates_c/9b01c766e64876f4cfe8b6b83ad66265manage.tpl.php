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
		管理首页&gt;&gt;管理员管理&gt;&gt;<strong><?php echo $this->vars['title'];?></strong>
		<?php if (isset($this->vars['list']) && $this->vars['list'] == true) {?>
		<table cellspacing="0">
			<tr><th>编号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录ip</th><th>最近登录时间</th><th>注册时间</th><th>操作</th></tr>
			<?php foreach ($this->vars['manages'] as $key=>$value) { ?>
				<tr>
					<td><?php echo $value->id?></td>
					<td><?php echo $value->admin_user?></td>
					<td><?php echo $value->level_name?></td>
					<td><?php echo $value->login_count?></td>
					<td><?php echo $value->last_ip?></td>
					<td><?php echo $value->last_time?></td>
					<td><?php echo $value->reg_time?></td>
					<td><a href="manage.php?action=edit">编辑</a> | <a href="manage.php?action=delete">删除</a></td>
				</tr>
			<?php } ?>
		</table>
		<p class="center">[<a href="manage.php?action=add">新增管理员</a>]</p>
		<?php } ?>
	</div>
		<?php if (isset($this->vars['add']) && $this->vars['add'] == true) {?>
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
		<?php } ?>
		<?php if (isset($this->vars['edit']) && $this->vars['edit'] == true) {?>
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
		<?php } ?>
		<?php if (isset($this->vars['delete']) && $this->vars['delete'] == true) {?>
			删除
		<?php } ?>
	
	
</body>
</html>