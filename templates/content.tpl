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
		内容管理&gt;&gt;查看文档列表&gt;&gt;<strong id="title">{$title}</strong>
		
		<ol>
			<li><a href="content.php?action=display" class="selected">文档列表</a></li>
			<li><a href="content.php?action=add">新增文档</a></li>
			{if $edit}
				<li><a>编辑文档</a></li>
			{/if}
		</ol>
		
		{if $display}
		<table cellspacing="0">
			<tr><th>序号</th><th>等级代码</th><th>等级名称</th><th>等级信息</th><th>操作</th></tr>
			{if $levels}
				{foreach $levels(key,value)}
					<tr>
						<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
						<td>{@value->LEVEL}</td>
						<td>{@value->level_name}</td>
						<td>{@value->level_info}</td>
						<td><a href="level.php?action=edit&id={@value->id}">编辑</a> | <a href="content.php?action=delete&id={@value->id}" onclick="return confirm('您真的要删除吗？');">删除</a></td>
					</tr>
				{/foreach}
			{else}
			<tr><td colspan="5">对不起，没有查到任何的数据</td></tr>
			{/if}
		</table>
		<p class="center">[<a href="content.php?action=add">新增文档</a>]</p>
		<div id="page">{$page}</div>
		{/if}
	</div>
	{if $add}
		<form method="post" name="content">
			<table cellspacing="0" class="content">
				<tr><th><strong>发布一条新文档</strong></th></tr>
				<tr><td>文档标题：<input type="text" name="title" class="text" /></td></tr>
				<tr>
					<td>
						栏　　目：<select name="nav">
									<option>--请选择一个栏目类别--</option>
									{$topNavs}
								 </select>		
					</td>
				</tr>
				<tr>
					<td>
						定义属性：
						<input type="checkbox" name="top" value="头条" />头条		
						<input type="checkbox" name="rec" value="推荐" />推荐		
						<input type="checkbox" name="blod" value="加粗" />加粗		
						<input type="checkbox" name="skip" value="加粗" />跳转		
					</td>
				</tr>
				<tr><td>TAG 标签：<input type="text" name="tag" class="text" /></td></tr>
				<tr><td>关  键  字：<input type="text" name="keyword" class="text" /></td></tr>
				<tr><td>缩  略  图：<input type="text" name="thumbnail" class="text" readonly="readonly" /><input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','400','100');" />
					<img name="pic" style="display:none;" />
				</td></tr>
				<tr><td>文章来源：<input type="text" name="source" class="text" /></td></tr>
				<tr><td>作　　者：<input type="text" name="author" class="text" /></td></tr>
				<tr>
					<td><span class="middle">内容摘要：</span><textarea name="info" placeholder="请输入摘要"></textarea></td>
				</tr>
				<tr class="ckeditor">
					<td><textarea id="taContent" name="content" placeholder="请输入文档的详细信息" class="ckeditor" ></textarea></td>
				</tr>
				<tr>
					<td>
						评论选项：
						<input type="radio" name="commend" value="1" checked="checked" />允许评论	
						<input type="radio" name="commend" value="0" />禁止评论	
						　　　　浏览次数：<input type="text" name="count" value="100" class="text small" />
					</td>
				</tr>
				<tr>
					<td>
						文档排序：<select name="sort">
									<option value="">默认排序</option>
									<option value="">置顶一天</option>
									<option value="">置顶一周</option>
									<option value="">置顶一月</option>
									<option value="">置顶一年</option>
								 </select>
						　　　　消费金币：<input type="text" name="gold" value="0" class="text small" />
					</td>
				</tr>
				<tr>
					<td>
						阅读权限：<select name="limit">
									<option value="">开放浏览</option>
									<option value="">初级会员</option>
									<option value="">中级会员</option>
									<option value="">高级会员</option>
									<option value="">VIP会员</option>
								 </select>
						　　　　标题颜色：<select name="color">
											<option value="">默认颜色</option>
											<option value="" style="color:red;">红色</option>
											<option value="" style="color:blue;">蓝色</option>
											<option value="" style="color:orange;">橙色</option>
										</select>
					</td>
				</tr>
				<tr><td><input type="submit" name="发布文档" /><input type="reset" name="重置" /></td></tr>
				<tr><td></tr>
			</table>
		</form>
	{/if}

	<script type="text/javascript" src="../js/admin.content.js"></script>
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		// 改变ckedotor的风格	
		CKEDITOR.config.skin='kama'
	</script>
</body>
</html>