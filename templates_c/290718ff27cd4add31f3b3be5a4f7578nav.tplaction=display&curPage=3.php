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
		内容管理&gt;&gt;设置网站导航&gt;&gt;<strong id="title"><?php echo $this->vars['title'];?></strong>
		
		<ol>
			<li><a href="nav.php?action=display" class="selected">导航列表</a></li>
			<li><a href="nav.php?action=add">新增导航</a></li>
			<?php if (isset($this->vars['edit']) && $this->vars['edit'] == true) {?>
				<li><a>编辑导航</a></li>
			<?php } ?>
			<?php if (isset($this->vars['addChild']) && $this->vars['addChild'] == true) {?>
				<li><a href="nav.php?action=addChild&pid=<?php echo $this->vars['pid'];?>&prev_name=<?php echo $this->vars['prev_name'];?>">新增子导航</a></li>
			<?php } ?>
			<?php if (isset($this->vars['displayChild']) && $this->vars['displayChild'] == true) {?>
				<li><a href="nav.php?action=displayChild&pid=<?php echo $this->vars['pid'];?>&prev_name=<?php echo $this->vars['prev_name'];?>">显示子导航</a></li>
			<?php } ?>
		</ol>
		
		<?php if (isset($this->vars['display']) && $this->vars['display'] == true) {?>
		<form action="nav.php?action=sort" method="post">
		<table cellspacing="0">
			<tr><th>序号</th><th>导航名称</th><th>导航信息</th><th>子导航</th><th>操作</th><th>排序</th></tr>
			<?php if (isset($this->vars['navs']) && $this->vars['navs'] == true) {?>
				<?php foreach ($this->vars['navs'] as $key=>$value) { ?>
					<tr>
						<td><script type="text/javascript">document.write(<?php echo $key+1?>+<?php echo $this->vars['num'];?>);</script></td>
						<td><?php echo $value->nav_name?></td>
						<td><?php echo $value->nav_info?></td>
						<td><a href="nav.php?action=displayChild&pid=<?php echo $value->id?>&prev_name=<?php echo $value->nav_name?>">显示子导航</a> | <a href="nav.php?action=addChild&pid=<?php echo $value->id?>&prev_name=<?php echo $value->nav_name?>">增加子导航</a></td>
						<td><a href="nav.php?action=edit&id=<?php echo $value->id?>">编辑</a> | <a href="nav.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('您真的要删除吗？');">删除</a></td>
						<td><input type="text" name="sort[<?php echo $value->id?>]" value="<?php echo $value->sort?>" class="text sort" /></td>
					</tr>
				<?php } ?>
			<?php } else { ?>
			<tr><td colspan="6">对不起，没有查到任何的数据</td></tr>
			<?php } ?>
			<tr><td></td><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" name="send" value="排序" style="cursor:pointer;" /></td></tr>
		</table>
		</form>
		<div id="page"><?php echo $this->vars['page'];?></div>
		<?php } ?>
	</div>
	<?php if (isset($this->vars['add']) && $this->vars['add'] == true) {?>
		<form method="post" name="add">
			<?php if (isset($this->vars['pid']) && $this->vars['pid'] == true) {?>
				<input type="hidden" value="<?php echo $this->vars['pid'];?>" name="pid" />
			<?php } ?>
			<input type="hidden" value="<?php echo $this->vars['prev_url'];?>" name="prev_url" />
			<table cellspacing="0" class="left">
				<tr><td>导航名称：<input type="text" name="nav_name" class="text" /> （在两位到20位之间）</td></tr>
				<tr><td><textarea name="nav_info"></textarea> （不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增导航" onclick="return checkAdd();" class="submit" />[<a href="<?php echo $this->vars['prev_url'];?>">返回列表</a>]</td></tr>
			</table>
		</form>
	<?php } ?>
	<?php if (isset($this->vars['edit']) && $this->vars['edit'] == true) {?>
		<form method="post" name="edit">
			<input type="hidden" value="<?php echo $this->vars['id'];?>" name="id" />
			<input type="hidden" value="<?php echo $this->vars['prev_url'];?>" name="prev_url" />
			<table cellspacing="0" class="left">
				<tr><td>导航名称：<input type="text" name="nav_name" value="<?php echo $this->vars['nav_name'];?>" class="text" /> （在两位到20位之间）</td></tr>
				<tr><td><textarea name="nav_info"><?php echo $this->vars['nav_info'];?></textarea> （不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" onclick="return checkEdit();" value="编辑导航" class="submit" />[<a href="<?php echo $this->vars['prev_url'];?>">返回列表</a>]</td></tr>
			</table>
		</form>
	<?php } ?>
	<?php if (isset($this->vars['addChild']) && $this->vars['addChild'] == true) {?>
		<form method="post" name="add">
			<input type="hidden" value="<?php echo $this->vars['pid'];?>" name="pid" />
			<input type="hidden" value="<?php echo $this->vars['prev_url'];?>" name="prev_url" />
			<table cellspacing="0" class="left">
				<tr><td>上级导航：<strong><?php echo $this->vars['prev_name'];?></strong></td></tr>
				<tr><td>导航名称：<input type="text" name="nav_name" class="text" /> （在两位到20位之间）</td></tr>
				<tr><td><textarea name="nav_info"></textarea> （不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增子导航" onclick="return checkAdd();" class="submit" />[<a href="<?php echo $this->vars['prev_url'];?>">返回列表</a>]</td></tr>
			</table>
		</form>
	<?php } ?>
	<?php if (isset($this->vars['displayChild']) && $this->vars['displayChild'] == true) {?>
		<form action="nav.php?action=sort" method="post">
		<table cellspacing="0">
			<tr><th>序号</th><th>导航名称</th><th>导航信息</th><th>子导航</th><th>操作</th><th>排序</th></tr>
			<?php if (isset($this->vars['navs']) && $this->vars['navs'] == true) {?>
				<?php foreach ($this->vars['navs'] as $key=>$value) { ?>
					<tr>
						<td><script type="text/javascript">document.write(<?php echo $key+1?>+<?php echo $this->vars['num'];?>);</script></td>
						<td><?php echo $value->nav_name?></td>
						<td><?php echo $value->nav_info?></td>
						<td><a href="nav.php?action=displayChild&pid=<?php echo $value->id?>&prev_name=<?php echo $value->nav_name?>">显示子导航</a> | <a href="nav.php?action=addChild&pid=<?php echo $value->id?>&prev_name=<?php echo $value->nav_name?>">增加子导航</a></td>
						<td><a href="nav.php?action=edit&id=<?php echo $value->id?>">编辑</a> | <a href="nav.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('您真的要删除吗？');">删除</a></td>
						<td><input type="text" name="sort[<?php echo $value->id?>]" value="<?php echo $value->sort?>" class="text sort" /></td>
					</tr>
				<?php } ?>
			<?php } else { ?>
			<tr><td colspan="6">对不起，没有查到任何的数据</td></tr>
			<?php } ?>
			<tr><td></td><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" name="send" value="排序" style="cursor:pointer;" /></td></tr>
			<tr><td colspan="5">本类隶属于：<strong><a href="<?php echo $this->vars['prev_url'];?>"><?php echo $this->vars['prev_name'];?></a></strong> <a href="nav.php?action=add&pid=<?php echo $this->vars['pid'];?>">继续新增</a></td></tr>
		</table>
		</form>
		<div id="page"><?php echo $this->vars['page'];?></div>
	<?php } ?>
	<script type="text/javascript" src="../js/admin.nav.js"></script>
</body>
</html>