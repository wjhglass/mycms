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
		内容管理&gt;&gt;设置网站导航&gt;&gt;<strong id="title">{$title}</strong>
		
		<ol>
			<li><a href="nav.php?action=display" class="selected">导航列表</a></li>
			<li><a href="nav.php?action=add">新增导航</a></li>
			{if $edit}
				<li><a>编辑导航</a></li>
			{/if}
			{if $addChild}
				<li><a href="nav.php?action=addChild&pid={$pid}&prev_name={$prev_name}">新增子导航</a></li>
			{/if}
			{if $displayChild}
				<li><a href="nav.php?action=displayChild&pid={$pid}&prev_name={$prev_name}">显示子导航</a></li>
			{/if}
		</ol>
		
		{if $display}
		<form action="nav.php?action=sort" method="post">
		<table cellspacing="0">
			<tr><th>序号</th><th>导航名称</th><th>导航信息</th><th>子导航</th><th>操作</th><th>排序</th></tr>
			{if $navs}
				{foreach $navs(key,value)}
					<tr>
						<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
						<td>{@value->nav_name}</td>
						<td>{@value->nav_info}</td>
						<td><a href="nav.php?action=displayChild&pid={@value->id}&prev_name={@value->nav_name}">显示子导航</a> | <a href="nav.php?action=addChild&pid={@value->id}&prev_name={@value->nav_name}">增加子导航</a></td>
						<td><a href="nav.php?action=edit&id={@value->id}">编辑</a> | <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除吗？');">删除</a></td>
						<td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort" /></td>
					</tr>
				{/foreach}
			{else}
			<tr><td colspan="6">对不起，没有查到任何的数据</td></tr>
			{/if}
			<tr><td></td><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" name="send" value="排序" style="cursor:pointer;" /></td></tr>
		</table>
		</form>
		<div id="page">{$page}</div>
		{/if}
	</div>
	{if $add}
		<form method="post" name="add">
			{if $pid}
				<input type="hidden" value="{$pid}" name="pid" />
			{/if}
			<input type="hidden" value="{$prev_url}" name="prev_url" />
			<table cellspacing="0" class="left">
				<tr><td>导航名称：<input type="text" name="nav_name" class="text" /> （在两位到20位之间）</td></tr>
				<tr><td><textarea name="nav_info"></textarea> （不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增导航" onclick="return checkAdd();" class="submit" />[<a href="{$prev_url}">返回列表</a>]</td></tr>
			</table>
		</form>
	{/if}
	{if $edit}
		<form method="post" name="edit">
			<input type="hidden" value="{$id}" name="id" />
			<input type="hidden" value="{$prev_url}" name="prev_url" />
			<table cellspacing="0" class="left">
				<tr><td>导航名称：<input type="text" name="nav_name" value="{$nav_name}" class="text" /> （在两位到20位之间）</td></tr>
				<tr><td><textarea name="nav_info">{$nav_info}</textarea> （不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" onclick="return checkEdit();" value="编辑导航" class="submit" />[<a href="{$prev_url}">返回列表</a>]</td></tr>
			</table>
		</form>
	{/if}
	{if $addChild}
		<form method="post" name="add">
			<input type="hidden" value="{$pid}" name="pid" />
			<input type="hidden" value="{$prev_url}" name="prev_url" />
			<table cellspacing="0" class="left">
				<tr><td>上级导航：<strong>{$prev_name}</strong></td></tr>
				<tr><td>导航名称：<input type="text" name="nav_name" class="text" /> （在两位到20位之间）</td></tr>
				<tr><td><textarea name="nav_info"></textarea> （不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增子导航" onclick="return checkAdd();" class="submit" />[<a href="{$prev_url}">返回列表</a>]</td></tr>
			</table>
		</form>
	{/if}
	{if $displayChild}
		<form action="nav.php?action=sort" method="post">
		<table cellspacing="0">
			<tr><th>序号</th><th>导航名称</th><th>导航信息</th><th>子导航</th><th>操作</th><th>排序</th></tr>
			{if $navs}
				{foreach $navs(key,value)}
					<tr>
						<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
						<td>{@value->nav_name}</td>
						<td>{@value->nav_info}</td>
						<td><a href="nav.php?action=displayChild&pid={@value->id}&prev_name={@value->nav_name}">显示子导航</a> | <a href="nav.php?action=addChild&pid={@value->id}&prev_name={@value->nav_name}">增加子导航</a></td>
						<td><a href="nav.php?action=edit&id={@value->id}">编辑</a> | <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除吗？');">删除</a></td>
						<td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort" /></td>
					</tr>
				{/foreach}
			{else}
			<tr><td colspan="6">对不起，没有查到任何的数据</td></tr>
			{/if}
			<tr><td></td><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" name="send" value="排序" style="cursor:pointer;" /></td></tr>
			<tr><td colspan="5">本类隶属于：<strong><a href="{$prev_url}">{$prev_name}</a></strong> <a href="nav.php?action=add&pid={$pid}">继续新增</a></td></tr>
		</table>
		</form>
		<div id="page">{$page}</div>
	{/if}
	<script type="text/javascript" src="../js/admin.nav.js"></script>
</body>
</html>