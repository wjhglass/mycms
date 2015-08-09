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
	if (form.admin_user.value == "" || form.admin_user.value.length < 2) {
		alert("用户名不对为空并不得小于2位");
		form.admin_user.focus();
		return false;
	}
	if (form.admin_password.value == "" || form.admin_password.value.length < 6) {
		alert("密码不得为空且不得小于6位");
		form.admin_password.focus();
		return false;
	}
	if (form.admin_password.value != form.password_confirm.value) {
		alert("两次密码必须一致");
		form.password_confirm.focus();
		return false;
	}
	return true;
}

/**
 * 验证修改的表单
 */
function checkEdit() {
	var form = document.edit;
	if (form.admin_password.value != "" && form.admin_password.value.length < 6) {
		alert("密码不得小于6位");
		form.admin_password.focus();
		return false;
	}
	return true;
}