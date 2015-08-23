//验证注册
function checkReg() {
	var fm = document.reg;
	if (fm.username.value == '' || fm.username.value.length < 2 || fm.username.value.length > 20) {
		alert('用户名不得为空并且不得小于两位并且不得大于20位！');
		fm.username.focus();
		return false;
	}
	if (fm.password.value.length < 6) {
		alert('密码不得小于6位！');
		fm.password.focus();
		return false;
	}
	if (fm.password.value != fm.confirmPassword.value) {
		alert('密码和密码确认不一致！');
		fm.confirmPassword.focus();
		return false;
	}
	if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
		alert('邮箱格式不正确');
		fm.email.value = ''; //清空
		fm.email.focus(); //将焦点以至表单字段
		return false;
	}
	if (fm.code.value.length != 5 ) {
		alert('验证码必须为五位！');
		fm.code.focus();
		return false;
	}
	return true;
}
