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
		管理首页&gt;&gt;等级管理&gt;&gt;<strong id="title">{$title}</strong>
		
		<ol>
			<li><a href="level.php?action=display" class="selected">等级列表</a></li>
			<li><a href="level.php?action=add">新增等级</a></li>
			{if $edit}
				<li><a>编辑等级</a></li>
			{/if}
		</ol>
		
		{if $display}
		<table cellspacing="0">
			<tr><th>编号</th><th>等级代码</th><th>等级名称</th><th>等级信息</th><th>操作</th></tr>
			{foreach $levels(key,value)}
				<tr>
					<td>{@value->id}</td>
					<td>{@value->LEVEL}</td>
					<td>{@value->level_name}</td>
					<td>{@value->level_info}</td>
					<td><a href="level.php?action=edit&id={@value->id}">编辑</a> | <a href="level.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除吗？');">删除</a></td>
				</tr>
			{/foreach}
		</table>
		<p class="center">[<a href="level.php?action=add">新增等级</a>]</p>
		{/if}
	</div>
		{if $add}
			<form method="post" name="add">
				<table cellspacing="0" class="left">
					<tr><td>等级代码：<input type="text" name="level" class="text" /> （必须为数字）</td></tr>
					<tr><td>等级名称：<input type="text" name="level_name" class="text" /> （在两位到20位之间）</td></tr>
					<tr><td><textarea name="level_info"></textarea> （不得大于200位）</td></tr>
					<tr><td><input type="submit" name="send" value="新增等级" onclick="return checkAdd();" class="submit" />[<a href="level.php?action=display">返回列表</a>]</td></tr>
				</table>
			</form>
		{/if}
		{if $edit}
			<form method="post" name="edit">
				<input type="hidden" value="{$id}" name="id" />
				<table cellspacing="0" class="left">
					<tr><td>等级代码：<input type="text" name="level" class="text" value="{$level}" readonly="readonly" /></td></tr>
					<tr><td>等级名称：<input type="text" name="level_name" value="{$level_name}" class="text" /> （在两位到20位之间）</td></tr>
					<tr><td><textarea name="level_info" value="{$level_info}">{$level_info}</textarea> （不得大于200位）</td></tr>
					<tr><td><input type="submit" name="send" onclick="return checkEdit();" value="编辑等级" class="submit" />[<a href="level.php?action=display">返回列表</a>]</td></tr>
				</table>
			</form>
		{/if}
		<script type="text/javascript" src="../js/admin.level.js"></script>
</body>
</html>