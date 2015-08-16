<!--top start-->
<div class="top">
	<a href="javascript:;">这里可以放置文字广告1</a>
	<a href="javascript:;">这里可以放置文字广告2</a>
</div>
<!--top end-->

<!--header start-->
<div class="header magictime swap">
	<h1><a href="javascript:;">倚天一出，谁与争锋</a></h1>
	<div class="adver"><a href="javascript:;"><img width="690" height="80" alt="广告" src="images/adver.png" /></a></div>
</div>
<!--header end-->

<!--nav start-->
<div class="nav">
	<ul>
		<li><a href="./">首页</a></li>
		<?php if (isset($this->vars['navs']) && $this->vars['navs'] == true) {?>
			<?php foreach ($this->vars['navs'] as $key=>$value) { ?>
				<li><a href="list.php?id=<?php echo $value->id?>"><?php echo $value->nav_name?></a></li>
			<?php } ?>
		<?php } ?>
	</ul>
</div>
<!--nav end-->

<!--search start-->
<div class="search">
	<form name="search">
		<select>
			<option>按标题</option>
			<option>按关键字</option>
			<option>全局查询</option>
		</select>
		<input type="text" name="keyword" class="text" />
		<input type="submit" name="send" class="submit" value="搜索" />
	</form>
	<strong>TAG标签：</strong>
	<ul>
		<li><a href="javascript:;">基金(3)</a></li>
		<li><a href="javascript:;">美女(1)</a></li>
		<li><a href="javascript:;">白兰地(3)</a></li>
		<li><a href="javascript:;">音乐(1)</a></li>
		<li><a href="javascript:;">体育(1)</a></li>
		<li><a href="javascript:;">直播(1)</a></li>
		<li><a href="javascript:;">会晤(1)</a></li>
		<li><a href="javascript:;">韩日(1)</a></li>
		<li><a href="javascript:;">警方(1)</a></li>
		<li><a href="javascript:;">广州(1)</a></li>
	</ul>
</div>
<!--search end-->