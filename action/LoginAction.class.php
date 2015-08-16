<?php
/**
 * 登录控制器
 * @author 吴金华
 *
 */
class LoginAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct ( $tmp, new ManageModel () );
	}
	
	public function action() {
		if (isset($_GET ['action'])) {
			switch ($_GET ['action']) {
				case 'login' :
					$this->login ();
					break;
				case 'logout' :
					$this->logout ();
					break;
			}
		}
	}
	
	/**
	 * 登录
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function login() {
		$code = $_POST ['code'];
		if (Validate::checkLength ( $code, CODE_LENGTH, 2 )) {
			$sessionCode = $_SESSION ['code'];
			if (strtolower ( $code ) != $sessionCode) {
				Tool::alertBack ( '验证码不正确' );
			} else {
				// 验证码验证通过
				// 验证用户名
				if (Validate::checkNull ( $_POST ['admin_user'] )) {
					Tool::alertBack ( '用户名不得为空' );
				}
				if (Validate::checkLength ( $_POST ['admin_user'], 20 )) {
					Tool::alertBack ( '用户名不得大于20位' );
				}
				if (Validate::checkLength ( $_POST ['admin_user'], 2, 1 )) {
					Tool::alertBack ( '用户名不得小于2位' );
				}
	
				// 验证密码
				if (Validate::checkNull ( $_POST ['admin_password'] )) {
					Tool::alertBack ( '密码不得为空' );
				}
				if (Validate::checkLength ( $_POST ['admin_password'], 6, 1 )) {
					Tool::alertBack ( '密码不得小于6位' );
				}
	
				// 验证通过去数据库验证
				$this->model->admin_user = $_POST ['admin_user'];
				$this->model->admin_password = md5 ( $_POST ['admin_password'] );
				$this->model->last_ip = $_SERVER["REMOTE_ADDR"];
				$validateObj = $this->model->validate ();
				if ($validateObj != null) {
					$_SESSION['admin']['admin_user'] = $validateObj->admin_user;
					$_SESSION['admin']['level_name'] = $validateObj->level_name;
						
					// 统计管理员的登录信息
					$this->model->statisticsLoginInfo();
						
					Tool::alertLocation ( null, 'admin.php' );
				} else {
					Tool::alertBack ( '用户名或密码不正确，请重新输入' );
				}
			}
		} else {
			Tool::alertBack ( '验证码必须是' . CODE_LENGTH . '位' );
		}
	}
	
	/**
	 * 登出
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function logout() {
		Tool::unSession();
		Tool::alertLocation(null, 'admin.login.php');
	}
}