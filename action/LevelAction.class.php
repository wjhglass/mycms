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
			if (Validate::checkNull($_POST ['level'])) {
				Tool::alertBack('等级代码不得为空');
			}
			if (!is_numeric($_POST ['level'])) {
				Tool::alertBack('等级代码必须为数字');
			}
			
			if (Validate::checkNull($_POST ['level_name'])) {
				Tool::alertBack('等级名称不得为空');
			}
			if (Validate::checkLength($_POST ['level_name'], 20)) {
				Tool::alertBack('等级名称不得大于20位');
			}
			if (Validate::checkLength($_POST ['level_name'], 2, 1)) {
				Tool::alertBack('等级名称不得小于2位');
			}
			
			if (Validate::checkLength($_POST ['level_info'], 200)) {
				Tool::alertBack('等级描述不得大于200位');
			}
			$this->model->level = $_POST ['level'];
			if ($this->model->loadByLevel() != null) {
				Tool::alertBack('此等级代码已经被使用，请重新想一个哦！');
			}
			$this->model->level_name = $_POST ['level_name'];
			if ($this->model->loadByLevelName() != null) {
				Tool::alertBack('此等级名称已经被使用，请重新想一个哦！');
			}
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
			if (Validate::checkNull($_POST ['level_name'])) {
				Tool::alertBack('等级名称不得为空');
			}
			if (Validate::checkLength($_POST ['level_name'], 20)) {
				Tool::alertBack('等级名称不得大于20位');
			}
			if (Validate::checkLength($_POST ['level_name'], 2, 1)) {
				Tool::alertBack('等级名称不得小于2位');
			}
				
			if (Validate::checkLength($_POST ['level_info'], 200)) {
				Tool::alertBack('等级描述不得大于200位');
			}
			
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
			
			$levelObj = $this->model->load();
			$manage = new ManageModel();
			$manage->level = $levelObj->level;
			if ($manage->loadByLevel() != null) {
				Tool::alertBack('存在人员是该等级的人员，无法删除');
			}
			
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