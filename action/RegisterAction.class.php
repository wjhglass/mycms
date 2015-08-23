<?php
/**
 * 注册控制器控制器
 * @author 吴金华
 *
 */
class RegisterAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct ( $tmp, new UserModel () );
	}
	public function action() {
		switch ($_GET ['action']) {
			case 'reg' :
				$this->reg ();
				break;
			default :
			case 'add' :
				$this->add ();
				break;
			case 'login' :
				$this->login ();
				break;
			case 'logout' :
				$this->logout ();
				break;
			default :
				Tool::alertBack('非法操作');
				break;
		}
	}
	
	/**
	 * 注册
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	private function reg() {
		if (isset($_POST['send'])) {
			$code = $_POST ['code'];
			$sessionCode = $_SESSION ['code'];
			if (strtolower ( $code ) == $sessionCode) {
				if (Validate::checkNull ( $_POST ['username'] )) {
					Tool::alertBack ( '用户名不得为空' );
				}
				if (Validate::checkLength ( $_POST ['username'], 20 )) {
					Tool::alertBack ( '用户名不得大于20位' );
				}
				if (Validate::checkLength ( $_POST ['username'], 2, 1 )) {
					Tool::alertBack ( '用户名不得小于2位' );
				}
				$this->model->username = $_POST['username'];
				if ($this->model->checkUsername()) Tool::alertBack('用户名重复！');
		
				if (Validate::checkNull ( $_POST ['password'] )) {
					Tool::alertBack ( '密码不得为空' );
				}
				if (Validate::checkLength ( $_POST ['password'], 6, 1 )) {
					Tool::alertBack ( '密码不得小于6位' );
				}
		
				if (!Validate::checkEquals($_POST ['password'], $_POST ['confirmPassword'])) {
					Tool::alertBack ( '两次密码不一致，请重新输入' );
				}
		
				if (Validate::checkNull ( $_POST ['email'] )) {
					Tool::alertBack ( '电子邮箱不得为空' );
				}
				if (!Validate::checkEmail ( $_POST ['email'] )) {
					Tool::alertBack ( '电子邮箱格式不正确' );
				}
				$this->model->email = $_POST['email'];
				if ($this->model->checkEmail()) Tool::alertBack('邮件重复！');
		
				if (!Validate::checkNull ( $_POST ['question']) && !Validate::checkNull ( $_POST ['answer'])) {
					$this->model->question = $_POST['question'];
					$this->model->answer = $_POST['answer'];
				}
			} else {
				Tool::alertBack ( '验证码不正确' );
			}
				
			$this->model->password = md5( $_POST['password'] );
			$this->model->face = $_POST['face'];
				
			$this->model->add() ? Tool::alertLocation('恭喜你，注册成功', './') : Tool::alertBack('抱歉，系统错误，注册失败');
		}
		$this->tmp->assign ( 'reg', true );
		$this->tmp->assign ( 'optionOneGroup', range(1, 9) );
		$this->tmp->assign ( 'optionTwoGroup', range(10, 24) );
	}
	
	/**
	 * 登录
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	private function login() {
		if (isset($_POST['send'])) {
			$code = $_POST ['code'];
			$sessionCode = $_SESSION ['code'];
			if (strtolower ( $code ) == $sessionCode) {
				if (Validate::checkNull ( $_POST ['username'] )) {
					Tool::alertBack ( '用户名不得为空' );
				}
				if (Validate::checkLength ( $_POST ['username'], 20 )) {
					Tool::alertBack ( '用户名不得大于20位' );
				}
				if (Validate::checkLength ( $_POST ['username'], 2, 1 )) {
					Tool::alertBack ( '用户名不得小于2位' );
				}
		
				if (Validate::checkNull ( $_POST ['password'] )) {
					Tool::alertBack ( '密码不得为空' );
				}
				if (Validate::checkLength ( $_POST ['password'], 6, 1 )) {
					Tool::alertBack ( '密码不得小于6位' );
				}
			} else {
				Tool::alertBack ( '验证码不正确' );
			}
		
			$this->model->username = $_POST['username'];
			$this->model->password = md5( $_POST['password'] );
		
			if (!!$user = $this->model->validate()) {
				$cookie = new Cookie('username',$user->username,$_POST['time']);
				$cookie->setCookie();
// 				$cookie = new Cookie('face',$user->face,$_POST['time']);
// 				$cookie->setCookie();
				Tool::alertLocation(null, './');
			} else {
				Tool::alertBack('用户名或密码错误！');
			}
		}
		$this->tmp->assign ( 'login', true );
	}
	
	/**
	 * 退出
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	private function logout() {
		$_cookie = new Cookie('username');
		$_cookie->unCookie();
		Tool::alertLocation(null,'register.php?action=login');
	}
}