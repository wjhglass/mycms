<?php
/**
 * 等级控制器
 * @author 吴金华
 *
 */
class LevelAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct($tmp, new LevelModel());
		$this->action();
		$this->tmp->display('level.tpl');
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
	 * 等级列表
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function display() {
		$this->tmp->assign ( 'display', true );
		$this->tmp->assign ( 'title', '等级列表' );
		$this->tmp->assign ( 'levels', $this->model->listAll () );
	}
	
	/**
	 * 添加等级
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function add() {
		if (isset ( $_POST ['send'] )) {
			$this->model->level = $_POST ['level'];
			$this->model->level_name = $_POST ['level_name'];
			$this->model->level_info = $_POST ['level_info'];
			$affected_rows = $this->model->add ();
			if ($affected_rows) {
				Tool::alertLocation('恭喜，添加等级成功', 'level.php?action=display');
			} else {
				Tool::alertBack('添加失败咯');
			}
		}
		$this->tmp->assign ( 'add', true );
		$this->tmp->assign ( 'title', '新增等级' );
	}
	
	/**
	 * 编辑等级
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function edit() {
		if (isset($_POST['send'])) {
			$this->model->id = $_POST['id'];
			$this->model->level_name = $_POST['level_name'];
			$this->model->level_info = $_POST['level_info'];
			$this->model->modify() ? Tool::alertLocation('恭喜你，修改等级成功！', 'level.php?action=display') : Tool::alertBack('很遗憾，修改等级失败！');
		}
		
		$this->tmp->assign ( 'edit', true );
		$this->tmp->assign ( 'title', '编辑等级' );
		$this->model->id = $_GET['id'];
		is_object($this->model->load()) ? true : Tool::alertBack('等级传值的id有误！');
		$obj = $this->model->load();
		$this->tmp->assign ( 'id', $obj->id );
		$this->tmp->assign ( 'level', $obj->level );
		$this->tmp->assign ( 'level_name', $obj->level_name  );
		$this->tmp->assign ( 'level_info', $obj->level_info  );
	}
	
	/**
	 * 删除等级
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function delete() {
		if (isset($_GET['id'])) {
			$this->model->id = $_GET['id'];
			$affected_rows = $this->model->delete();
			if ($affected_rows) {
				Tool::alertLocation('恭喜，删除等级成功', 'level.php?action=display');
			} else {
				Tool::alertBack('删除失败咯，删除信息不存在或系统错误');
			}
		} else {
			Tool::alertBack('操作非法，请按规章制度办事哦！');
		}
	}
}