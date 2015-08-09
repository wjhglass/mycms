<?php
/**
 * 管理员控制器
 * @author 吴金华
 *
 */
class ManageAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct($tmp, new ManageModel());
		$this->action();
		$this->tmp->display('manage.tpl');
	}
	
	private function action() {
		switch ($_GET ['action']) {
			case 'display' :
				$this->display();
				break;
			case 'add' :
				$this->add();
				break;
			case 'edit' :
				$this->edit();
				break;
			case 'delete' :
				$this->delete();
				return;
			default :
				echo '非法操作';
				break;
		}
	}

	/**
	 * 管理员列表
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	private function display() {
		$this->tmp->assign ( 'display', true );
		$this->tmp->assign ( 'title', '管理员列表' );
		$this->tmp->assign ( 'manages', $this->model->listAll () );
	}
	
	/**
	 * 添加管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	private function add() {
		if (isset ( $_POST ['send'] )) {
			$this->model->admin_user = $_POST ['admin_user'];
			$this->model->admin_password = md5 ( $_POST ['admin_password'] );
			$this->model->level = $_POST ['level'];
			$affected_rows = $this->model->add ();
			if ($affected_rows) {
				Tool::alertLocation('恭喜，添加管理员成功', 'manage.php?action=display');
			} else {
				Tool::alertBack('添加失败咯');
			}
		}
		$this->tmp->assign ( 'add', true );
		$this->tmp->assign ( 'title', '新增管理员' );
		$this->tmp->assign( 'levels',  $this->model->listAllLevel());
	}
	
	/**
	 * 编辑管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	private function edit() {
		if (isset($_POST['send'])) {
			$this->model->id = $_POST['id'];
			$this->model->admin_password = md5($_POST['admin_password']);
			$this->model->level = $_POST['level'];
			$this->model->modify() ? Tool::alertLocation('恭喜你，修改管理员成功！', 'manage.php?action=display') : Tool::alertBack('很遗憾，修改管理员失败！');
		}
		
		$this->tmp->assign ( 'edit', true );
		$this->tmp->assign ( 'title', '编辑管理员' );
		$this->model->id = $_GET['id'];
		is_object($this->model->load()) ? true : Tool::alertBack('管理员传值的id有误！');
		$obj = $this->model->load();
		$this->tmp->assign ( 'id', $obj->id );
		$this->tmp->assign ( 'level', $obj->level );
		$this->tmp->assign ( 'admin_user', $obj->admin_user );
		$this->tmp->assign( 'levels',  $this->model->listAllLevel());
	}
	
	/**
	 * 删除管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	private function delete() {
		if (isset($_GET['id'])) {
			$this->model->id = $_GET['id'];
			$affected_rows = $this->model->delete();
			if ($affected_rows) {
				Tool::alertLocation('恭喜，删除管理员成功', 'manage.php?action=display');
			} else {
				Tool::alertBack('删除失败咯，删除信息不存在或系统错误');
			}
		} else {
			Tool::alertBack('操作非法，请按规章制度办事哦！');
		}
	}
}