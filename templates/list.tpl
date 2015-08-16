<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>CMS内容管理系统</title>
	<link rel="stylesheet" type="text/css" href="style/basic.css" />
	<link rel="stylesheet" type="text/css" href="style/list.css" />
	<link rel="stylesheet" type="text/css" href="style/magic.css" />
</head>
<body>
	<!--导入头部文件-->
	{include file='header.tpl'}
	
	<!-- list start -->
	<div id="list">
		<h2>当前位置&gt;<a href="list.php?id={$nid}">{$nnav_name}</a>&gt;<a href="list.php?id={$id}">{$nav_name}</a></h2>
		<dl>
			<dt><img alt="暂无图片" src="images/none.jpg" width="150" height="100"></dt>
			<dd>[<strong>军事动态</strong>] <a href="javascript:;">联合利华因散布涨价信息被罚200万</a></dd>
			<dd>日期：2011年10月10日 17:17:17 点击率：224 好评：0</dd>
			<dd>核心提示：国家发改委发布公告称，3月下旬，联合利华(中国)有限公司有关负责人多次接受采访发表日化产品涨价言论。此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预...</dd>
		</dl>
		<dl>
			<dt><img alt="暂无图片" src="images/none.jpg" width="150" height="100"></dt>
			<dd>[<strong>军事动态</strong>] <a href="javascript:;">联合利华因散布涨价信息被罚200万</a></dd>
			<dd>日期：2011年10月10日 17:17:17 点击率：224 好评：0</dd>
			<dd>核心提示：国家发改委发布公告称，3月下旬，联合利华(中国)有限公司有关负责人多次接受采访发表日化产品涨价言论。此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预...</dd>
		</dl>
		<dl>
			<dt><img alt="暂无图片" src="images/none.jpg" width="150" height="100"></dt>
			<dd>[<strong>军事动态</strong>] <a href="javascript:;">联合利华因散布涨价信息被罚200万</a></dd>
			<dd>日期：2011年10月10日 17:17:17 点击率：224 好评：0</dd>
			<dd>核心提示：国家发改委发布公告称，3月下旬，联合利华(中国)有限公司有关负责人多次接受采访发表日化产品涨价言论。此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预...</dd>
		</dl>
		<dl>
			<dt><img alt="暂无图片" src="images/none.jpg" width="150" height="100"></dt>
			<dd>[<strong>军事动态</strong>] <a href="javascript:;">联合利华因散布涨价信息被罚200万</a></dd>
			<dd>日期：2011年10月10日 17:17:17 点击率：224 好评：0</dd>
			<dd>核心提示：国家发改委发布公告称，3月下旬，联合利华(中国)有限公司有关负责人多次接受采访发表日化产品涨价言论。此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预...</dd>
		</dl>
		<dl>
			<dt><img alt="暂无图片" src="images/none.jpg" width="150" height="100"></dt>
			<dd>[<strong>军事动态</strong>] <a href="javascript:;">联合利华因散布涨价信息被罚200万</a></dd>
			<dd>日期：2011年10月10日 17:17:17 点击率：224 好评：0</dd>
			<dd>核心提示：国家发改委发布公告称，3月下旬，联合利华(中国)有限公司有关负责人多次接受采访发表日化产品涨价言论。此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预此行为导致日化产品涨价的信息广泛传播，增强了消费者涨价预...</dd>
		</dl>
		<div id="page">分页</div>
	</div>	
	<!-- list end -->
	
	<!-- sidebar start -->
	<div id="sidebar">
		<div class="s-nav">
			<h2>子栏目列表</h2>
			{if $childNavs}
				{foreach $childNavs(key,value)}
					<strong><a href="list.php?id={@value->id}">{@value->nav_name}</a></strong>
				{/foreach}
			{else}
			<span>该栏目没有子类</span>
			{/if}
		</div>
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