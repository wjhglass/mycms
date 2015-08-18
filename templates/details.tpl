<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>CMS内容管理系统</title>
	<link rel="stylesheet" type="text/css" href="style/basic.css" />
	<link rel="stylesheet" type="text/css" href="style/details.css" />
	<link rel="stylesheet" type="text/css" href="style/magic.css" />
</head>
<body>
	<!--导入头部文件-->
	{include file='header.tpl'}
	
	<!-- details start -->
	<div id="details">
		<h2>当前位置 &gt; {$nav}</h2>
		<h3>{$titlec}</h3>
		<div class="d1">时间：{$pubdate} 来源：{$source} 作者：{$author} 点击量：{$count} 次</div>
		<div class="d2">{$info}</div>
		<div class="d3">{$content}</div>
	</div>	
	<!-- details end -->
	
	<!-- sidebar start -->
	<div id="sidebar">
		<div class="right">
			<h2>本类推荐</h2>
			<ul>
				<li><em>06-20</em><a href="javascript:;">银监会否认首套房贷首付将提至...</a></li>
				<li><em>04-02</em><a href="javascript:;">发改委曝房价违规开发商名单央...</a></li>
				<li><em>02-13</em><a href="javascript:;">社科院预测更严厉楼市政策年内...</a></li>
				<li><em>05-05</em><a href="javascript:;">比亚迪拟“缩水”回归A股 以缓解...</a></li>
				<li><em>07-11</em><a href="javascript:;">第一线：北京限制高价盘预售证...</a></li>
				<li><em>03-18</em><a href="javascript:;">电网主辅分离或年内完成 葛洲坝...</a></li>
				<li><em>05-02</em><a href="javascript:;">京沪高铁将于6月9日起试运行10...</a></li>
			</ul>
		</div>
		<div class="right">
			<h2>本类热点</h2>
			<ul>
				<li><em>06-20</em><a href="javascript:;">银监会否认首套房贷首付将提至...</a></li>
				<li><em>04-02</em><a href="javascript:;">发改委曝房价违规开发商名单央...</a></li>
				<li><em>02-13</em><a href="javascript:;">社科院预测更严厉楼市政策年内...</a></li>
				<li><em>05-05</em><a href="javascript:;">比亚迪拟“缩水”回归A股 以缓解...</a></li>
				<li><em>07-11</em><a href="javascript:;">第一线：北京限制高价盘预售证...</a></li>
				<li><em>03-18</em><a href="javascript:;">电网主辅分离或年内完成 葛洲坝...</a></li>
				<li><em>05-02</em><a href="javascript:;">京沪高铁将于6月9日起试运行10...</a></li>
			</ul>
		</div>
		<div class="right">
			<h2>本类图文</h2>
			<ul>
				<li><em>06-20</em><a href="javascript:;">银监会否认首套房贷首付将提至...</a></li>
				<li><em>04-02</em><a href="javascript:;">发改委曝房价违规开发商名单央...</a></li>
				<li><em>02-13</em><a href="javascript:;">社科院预测更严厉楼市政策年内...</a></li>
				<li><em>05-05</em><a href="javascript:;">比亚迪拟“缩水”回归A股 以缓解...</a></li>
				<li><em>07-11</em><a href="javascript:;">第一线：北京限制高价盘预售证...</a></li>
				<li><em>03-18</em><a href="javascript:;">电网主辅分离或年内完成 葛洲坝...</a></li>
				<li><em>05-02</em><a href="javascript:;">京沪高铁将于6月9日起试运行10...</a></li>
			</ul>
		</div>
	</div>	
	<!-- sidebar end -->
	
	<!--导入尾部文件-->
	{include file='footer.tpl'}
</body>
</html>