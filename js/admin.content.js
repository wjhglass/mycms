window.onload = function() {
	var title = document.getElementById("title");
	var ol = document.getElementsByTagName("ol");
	var a = ol[0].getElementsByTagName("a");
	for (i = 0; i < a.length; i++) {
		a[i].className = null;
		if (title.innerHTML == a[i].innerHTML) {
			a[i].className = "selected";
		}
	}
};

//验证addContent
function checkAddContent() {
	var fm = document.content;
	if (fm.title.value == '' || fm.title.value.length < 2 || fm.title.value.length > 50) {
		alert('标题不得为空并且不得小于两位并且不得大于50位！');
		fm.title.focus();
		return false;
	}
	if (fm.nav.value == '') {
		alert('必须选择一个栏目！');
		fm.nav.focus();
		return false;
	}
	if (fm.tag.value.length > 30) {
		alert('tag标签不得大于30位！');
		fm.tag.focus();
		return false;
	}
	if (fm.keyword.value.length > 30) {
		alert('关键字不得大于30位！');
		fm.keyword.focus();
		return false;
	}
	if (fm.source.value.length > 100) {
		alert('文章来源不得大于100位！');
		fm.source.focus();
		return false;
	}
	if (fm.author.value.length > 20) {
		alert('作者不得大于20位！');
		fm.author.focus();
		return false;
	}
	if (fm.info.value.length > 200) {
		alert('内容摘要不得大于200位！');
		fm.info.focus();
		return false;
	}
	if (CKEDITOR.instances.taContent.getData() == '') {
		alert('详细内容不得为空！');
		CKEDITOR.instances.taContent.focus();
		return false;
	}
	if (isNaN(fm.count.value)) {
		alert('浏览次数必须是数字！');
		fm.count.focus();
		return false;
	}
	if (isNaN(fm.gold.value)) {
		alert('消费金币必须是数字！');
		fm.gold.focus();
		return false;
	}
	return true;
}

function centerWindow(url, name, width, height) {
	var left = (screen.width - width) / 2;
	var top = (screen.height - height) / 2 - 50;
	window.open(url, name, 'width='+width+',height='+height+',top='+top+',left='+left);
}
