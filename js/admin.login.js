/**
 * 验证登录
 */
function checkLogin() {
	var form = document.login;
	if (form.admin_user.value == "" || form.admin_user.value.length < 2 || form.admin_user.value.length > 20) {
		alert("用户名不得为空且不得小于2位且不得大于20位");
		form.admin_user.focus();
		return false;
	}
	if (form.admin_password.value == "" || form.admin_password.value.length < 6) {
		alert("密码不得为空且不得小于6位");
		form.admin_password.focus();
		return false;
	}
	if (form.code.value == "" || form.code.value.length != 5) {
		alert("验证码不得为空且必须为5位");
		form.code.focus();
		return false;
	}
	return true;
}
