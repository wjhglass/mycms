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
		管理首页&gt;&gt;管理员管理&gt;&gt;<strong id="title"><?php echo $this->vars['title'];?></strong>
		
		<ol>
			<li><a href="manage.php?action=display" class="selected">管理员列表</a></li>
			<li><a href="manage.php?action=add">新增管理员</a></li>
			<?php if (isset($this->vars['edit']) && $this->vars['edit'] == true) {?>
				<li><a>编辑管理员</a></li>
			<?php } ?>
		</ol>
		
		<?php if (isset($this->vars['display']) && $this->vars['display'] == true) {?>
		<table cellspacing="0">
			<tr><th>序号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录ip</th><th>最近登录时间</th><th>注册时间</th><th>操作</th></tr>
			<?php if (isset($this->vars['manages']) && $this->vars['manages'] == true) {?>
				<?php foreach ($this->vars['manages'] as $key=>$value) { ?>
					<tr>
						<td><script type="text/javascript">document.write(<?php echo $key+1?>+<?php echo $this->vars['num'];?>);</script></td>
						<td><?php echo $value->admin_user?></td>
						<td><?php echo $value->level_name?></td>
						<td><?php echo $value->login_count?></td>
						<td><?php echo $value->last_ip?></td>
						<td><?php echo $value->last_time?></td>
						<td><?php echo $value->reg_time?></td>
						<td><a href="manage.php?action=edit&id=<?php echo $value->id?>">编辑</a> | <a href="manage.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('您真的要删除吗？');">删除</a></td>
					</tr>
				<?php } ?>
			<?php } else { ?>
			<tr><td colspan="8">对不起，没有查到任何的数据</td></tr>
			<?php } ?>
		</table>
		<p class="center">[<a href="manage.php?action=add">新增管理员</a>]</p>
		<div id="page"><?php echo $this->vars['page'];?></div>
		<?php } ?>
	</div>
		<?php if (isset($this->vars['add']) && $this->vars['add'] == true) {?>
			<form method="post" name="add">
				<table cellspacing="0" class="left">
					<tr><td>用  户  名：<input type="text" name="admin_user" class="text" /> （在两位到20位之间）</td></tr>
					<tr><td>密　　码：<input type="password" name="admin_password" class="text" /> （不得小于六位）</td></tr>
					<tr><td>密码确认：<input type="password" name="password_confirm" class="text" /></td></tr>
					<tr><td>等　　级：
						<select name="level">
							<?php foreach ($this->vars['levels'] as $key=>$value) { ?>
								<option value="<?php echo $value->LEVEL?>"><?php echo $value->level_name?></option>
							<?php } ?>
						</select>
					</td></tr>
					<tr><td><input type="submit" name="send" value="新增管理员" onclick="return checkAdd();" class="submit" />[<a href="<?php echo $this->vars['prev_url'];?>">返回列表</a>]</td></tr>
				</table>
			</form>
		<?php } ?>
		<?php if (isset($this->vars['edit']) && $this->vars['edit'] == true) {?>
			<form method="post" name="edit">
				<input type="hidden" value="<?php echo $this->vars['id'];?>" name="id" />
				<input type="hidden" value="<?php echo $this->vars['level'];?>" id="level" />
				<input type="hidden" value="<?php echo $this->vars['admin_password'];?>" name="pass" />
				<input type="hidden" value="<?php echo $this->vars['prev_url'];?>" name="prev_url" />
				<table cellspacing="0" class="left">
					<tr><td>用户名：<input type="text" name="admin_user" class="text" value="<?php echo $this->vars['admin_user'];?>" readonly="readonly" /></td></tr>
					<tr><td>密　码：<input type="password" name="admin_password" class="text" /></td></tr>
					<tr><td>等　级：
						<select name="level">
							<?php foreach ($this->vars['levels'] as $key=>$value) { ?>
								<option value="<?php echo $value->LEVEL?>"><?php echo $value->level_name?></option>
							<?php } ?>
						</select>
					</td></tr>
					<tr><td><input type="submit" name="send" value="编辑管理员" onclick="return checkEdit();" class="submit" />[<a href="<?php echo $this->vars['prev_url'];?>">返回列表</a>]</td></tr>
				</table>
			</form>
		<?php } ?>
		<script type="text/javascript" src="../js/admin.manage.js"></script>
</body>
</html>