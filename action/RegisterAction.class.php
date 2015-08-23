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
		$this->tmp->assign ( 'reg', true );
	}
	
	/**
	 * 添加用户
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	private function add() {
		if ($_POST['send']) {
			$code = $_POST ['code'];
			if (Validate::checkLength ( $code, CODE_LENGTH, 2 )) {
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
				
				if (!Validate::checkEquals($_POST ['password'], $_POST ['confirmPassword'])) {
					Tool::alertBack ( '两次密码不一致，请重新输入' );
				}
				
				if (Validate::checkNull ( $_POST ['email'] )) {
					Tool::alertBack ( '电子邮箱不得为空' );
				}
				if (!Validate::checkEmail ( $_POST ['email'] )) {
					Tool::alertBack ( '电子邮箱格式不正确' );
				}
				
				if (!Validate::checkNull ( $_POST ['question']) && !Validate::checkNull ( $_POST ['answer'])) {
					$this->model->question = $_POST['question'];
					$this->model->answer = $_POST['answer'];
				} 
			} else {
				Tool::alertBack ( '验证码必须是' . CODE_LENGTH . '位' );
			}
			
			$this->model->username = $_POST['username'];
			$this->model->password = md5( $_POST['password'] );
			$this->model->email = $_POST['email'];
			
			$this->model->add() ? Tool::alertLocation('恭喜你，注册成功', './') : Tool::alertBack('抱歉，系统错误，注册失败');
		}
	}
}