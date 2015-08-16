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
		管理首页&gt;&gt;等级管理&gt;&gt;<strong id="title"><?php echo $this->vars['title'];?></strong>
		
		<ol>
			<li><a href="level.php?action=display" class="selected">等级列表</a></li>
			<li><a href="level.php?action=add">新增等级</a></li>
			<?php if (isset($this->vars['edit']) && $this->vars['edit'] == true) {?>
				<li><a>编辑等级</a></li>
			<?php } ?>
		</ol>
		
		<?php if (isset($this->vars['display']) && $this->vars['display'] == true) {?>
		<table cellspacing="0">
			<tr><th>序号</th><th>等级代码</th><th>等级名称</th><th>等级信息</th><th>操作</th></tr>
			<?php if (isset($this->vars['levels']) && $this->vars['levels'] == true) {?>
				<?php foreach ($this->vars['levels'] as $key=>$value) { ?>
					<tr>
						<td><script type="text/javascript">document.write(<?php echo $key+1?>+<?php echo $this->vars['num'];?>);</script></td>
						<td><?php echo $value->LEVEL?></td>
						<td><?php echo $value->level_name?></td>
						<td><?php echo $value->level_info?></td>
						<td><a href="level.php?action=edit&id=<?php echo $value->id?>">编辑</a> | <a href="level.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('您真的要删除吗？');">删除</a></td>
					</tr>
				<?php } ?>
			<?php } else { ?>
			<tr><td colspan="5">对不起，没有查到任何的数据</td></tr>
			<?php } ?>
		</table>
		<p class="center">[<a href="level.php?action=add">新增等级</a>]</p>
		<div id="page"><?php echo $this->vars['page'];?></div>
		<?php } ?>
	</div>
		<?php if (isset($this->vars['add']) && $this->vars['add'] == true) {?>
			<form method="post" name="add">
				<table cellspacing="0" class="left">
					<tr><td>等级代码：<input type="text" name="level" class="text" /> （必须为数字）</td></tr>
					<tr><td>等级名称：<input type="text" name="level_name" class="text" /> （在两位到20位之间）</td></tr>
					<tr><td><textarea name="level_info"></textarea> （不得大于200位）</td></tr>
					<tr><td><input type="submit" name="send" value="新增等级" onclick="return checkAdd();" class="submit" />[<a href="<?php echo $this->vars['prev_url'];?>">返回列表</a>]</td></tr>
				</table>
			</form>
		<?php } ?>
		<?php if (isset($this->vars['edit']) && $this->vars['edit'] == true) {?>
			<form method="post" name="edit">
				<input type="hidden" value="<?php echo $this->vars['id'];?>" name="id" />
				<input type="hidden" value="<?php echo $this->vars['prev_url'];?>" name="prev_url" />
				<table cellspacing="0" class="left">
					<tr><td>等级代码：<input type="text" name="level" class="text" value="<?php echo $this->vars['level'];?>" readonly="readonly" /></td></tr>
					<tr><td>等级名称：<input type="text" name="level_name" value="<?php echo $this->vars['level_name'];?>" class="text" /> （在两位到20位之间）</td></tr>
					<tr><td><textarea name="level_info" value="<?php echo $this->vars['level_info'];?>"><?php echo $this->vars['level_info'];?></textarea> （不得大于200位）</td></tr>
					<tr><td><input type="submit" name="send" onclick="return checkEdit();" value="编辑等级" class="submit" />[<a href="<?php echo $this->vars['prev_url'];?>">返回列表</a>]</td></tr>
				</table>
			</form>
		<?php } ?>
		<script type="text/javascript" src="../js/admin.level.js"></script>
</body>
</html>