<?php
/**
 * 管理员控制器
 * @author 吴金华
 *
 */
class ManageAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct ( $tmp, new ManageModel () );
	}
	
	public function action() {
		Validate::checkSession();
		switch ($_GET ['action']) {
			case 'display' :
				$this->display ();
				break;
			case 'add' :
				$this->add ();
				break;
			case 'edit' :
				$this->edit ();
				break;
			case 'delete' :
				$this->delete ();
				return;
			default :
				echo '非法操作';
				break;
		}
	}
	
	/**
	 * 管理员列表
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	private function display() {
		parent::page($this->model->getManageCount ());
		$this->tmp->assign ( 'display', true );
		$this->tmp->assign ( 'title', '管理员列表' );
		$this->tmp->assign ( 'manages', $this->model->listAll () );
	}
	
	/**
	 * 添加管理员
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	private function add() {
		if (isset ( $_POST ['send'] )) {
			if (Validate::checkNull ( $_POST ['admin_user'] )) {
				Tool::alertBack ( '用户名不得为空' );
			}
			if (Validate::checkLength ( $_POST ['admin_user'], 20 )) {
				Tool::alertBack ( '用户名不得大于20位' );
			}
			if (Validate::checkLength ( $_POST ['admin_user'], 2, 1 )) {
				Tool::alertBack ( '用户名不得小于2位' );
			}
			if (Validate::checkNull ( $_POST ['admin_password'] )) {
				Tool::alertBack ( '密码不得为空' );
			}
			if (Validate::checkLength ( $_POST ['admin_password'], 6, 1 )) {
				Tool::alertBack ( '密码不得小于6位' );
			}
			if (! Validate::checkEquals ( $_POST ['admin_password'], $_POST ['password_confirm'] )) {
				Tool::alertBack ( '两次密码必须一致' );
			}
			$this->model->admin_user = $_POST ['admin_user'];
			$userObj = $this->model->loadByAdminuser ();
			if ($userObj != null) {
				Tool::alertBack ( '此用户名已经被注册，请重新想一个哦！' );
			}
			$this->model->admin_password = md5 ( $_POST ['admin_password'] );
			$this->model->level = $_POST ['level'];
			$affected_rows = $this->model->add ();
			if ($affected_rows) {
				Tool::alertLocation ( '恭喜，添加管理员成功', 'manage.php?action=display' );
			} else {
				Tool::alertBack ( '添加失败咯' );
			}
		}
		$this->tmp->assign ( 'add', true );
		$this->tmp->assign ( 'title', '新增管理员' );
		$this->tmp->assign ( 'prev_url', PREV_URL );
		$level = new LevelModel ();
		$this->tmp->assign ( 'levels', $level->listAll () );
	}
	
	/**
	 * 编辑管理员
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	private function edit() {
		if (isset ( $_POST ['send'] )) {
			if (Validate::checkNull ( $_POST ['admin_password'] )) {
				$this->model->admin_password = $_POST ['pass'];
			} else {
				if (Validate::checkLength ( $_POST ['admin_password'], 6, 1 )) {
					Tool::alertBack ( '密码不得小于6位' );
				}
				$this->model->admin_password = md5 ( $_POST ['admin_password'] );
			}
			$this->model->id = $_POST ['id'];
			$this->model->level = $_POST ['level'];
			$this->model->modify () ? Tool::alertLocation ( '恭喜你，修改管理员成功！', $_POST ['prev_url'] ) : Tool::alertBack ( '很遗憾，修改管理员失败！' );
		}
		
		$this->tmp->assign ( 'edit', true );
		$this->tmp->assign ( 'title', '编辑管理员' );
		$this->model->id = $_GET ['id'];
		is_object ( $this->model->load () ) ? true : Tool::alertBack ( '管理员传值的id有误！' );
		$obj = $this->model->load ();
		$this->tmp->assign ( 'id', $obj->id );
		$this->tmp->assign ( 'level', $obj->level );
		$this->tmp->assign ( 'admin_user', $obj->admin_user );
		$this->tmp->assign ( 'admin_password', $obj->admin_password );
		$this->tmp->assign ( 'prev_url', PREV_URL );
		$level = new LevelModel ();
		$this->tmp->assign ( 'levels', $level->listAll () );
	}
	
	/**
	 * 删除管理员
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	private function delete() {
		if (isset ( $_GET ['id'] )) {
			$this->model->id = $_GET ['id'];
			$affected_rows = $this->model->delete ();
			if ($affected_rows) {
				Tool::alertLocation ( '恭喜，删除管理员成功', PREV_URL );
			} else {
				Tool::alertBack ( '删除失败咯，删除信息不存在或系统错误' );
			}
		} else {
			Tool::alertBack ( '操作非法，请按规章制度办事哦！' );
		}
	}
}