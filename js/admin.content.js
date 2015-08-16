window.onload = function() {
	var level = document.getElementById('level');
	var options = document.getElementsByTagName('option');
	if (level) {
		for (i = 0; i < options.length; i++) {
			if (options[i].value == level.value) {
				options[i].setAttribute('selected', 'selected');
			}
		}
	}
	
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


/**
 * 验证添加的表单
 */
function checkAdd() {
	var form = document.add;
	if (form.level.value == "" || isNaN(form.level.value)) {
		alert("等级代码必须为数字");
		form.level.focus();
		return false;
	}
	if (form.level_name.value == "" || form.level_name.value.length < 2 || form.level_name.value.length > 20) {
		alert("等级名称不的为空且不得小于2位且不得大于20位");
		form.level_name.focus();
		return false;
	}
	if (form.level_info.value != "" && form.level_info.value.length > 200) {
		alert("等级信息不得大于200位");
		form.level_info.focus();
		return false;
	}
	return true;
}

/**
 * 验证修改的表单
 */
function checkEdit() {
	var form = document.edit;
	if (form.level_name.value == "" || form.level_name.value.length < 2 || form.level_name.value.length > 20) {
		alert("等级名称不的为空且不得小于2位且不得大于20位");
		form.level_name.focus();
		return false;
	}
	if (form.level_info.value != "" && form.level_info.value.length > 200) {
		alert("等级信息不得大于200位");
		form.level_info.focus();
		return false;
	}
	return true;
}

function centerWindow(url, name, width, height) {
	var left = (screen.width - width) / 2;
	var top = (screen.height - height) / 2 - 50;
	window.open(url, name, 'width='+width+',height='+height+',top='+top+',left='+left);
}
