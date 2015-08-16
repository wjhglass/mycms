<?php
/**
 * 导航控制器
 * @author 吴金华
 *
 */
class NavAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct($tmp, new NavModel());
	}
	
	/**
	 * 显示前台
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function displayFront() {
		$this->tmp->assign ( 'navs', $this->model->displayFrontNav() );
	}
	
	public function action() {
		switch ($_GET ['action']) {
			case 'display' :
				$this->display();
				break;
			case 'addChild' :
				$this->addChild();
				break;
			case 'displayChild' :
				$this->displayChild();
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
			case 'sort' :
				$this->sort();
				break;
			default :
				echo '非法操作';
				break;
		}
	}

	/**
	 * 添加子导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	private function addChild() {
		if (isset ( $_POST ['send'] )) {
			if (Validate::checkNull($_POST ['nav_name'])) {
				Tool::alertBack('导航名称不得为空');
			}
			if (Validate::checkLength($_POST ['nav_name'], 20)) {
				Tool::alertBack('导航名称不得大于20位');
			}
			if (Validate::checkLength($_POST ['nav_name'], 2, 1)) {
				Tool::alertBack('导航名称不得小于2位');
			}
			$this->model->nav_name = $_POST ['nav_name'];
				
			if (Validate::checkLength($_POST ['nav_info'], 200)) {
				Tool::alertBack('导航信息不得大于200位');
			}
			$this->model->nav_info = $_POST ['nav_info'];
				
			$this->model->nav_name = $_POST ['nav_name'];
			if ($this->model->loadByNavName() != null) {
				Tool::alertBack('此导航名称已经被使用，请重新想一个哦！');
			}
				
			$this->model->pid = $_POST ['pid'];
			
			$affected_rows = $this->model->add ();
			if ($affected_rows) {
				Tool::alertLocation('恭喜，添加子导航成功', $_POST ['prev_url']);
			} else {
				Tool::alertBack('添加失败咯');
			}
		}
		
		if (isset ( $_GET ['pid'] )) {
			$this->model->id = $_GET['pid'];
			is_object($this->model->load()) ? true : Tool::alertBack('导航传值的id有误！');
			
			$this->tmp->assign ( 'pid', $_GET['pid'] );
			$this->tmp->assign ( 'prev_name', $_GET['prev_name'] );
			$this->tmp->assign ( 'addChild', true );
			$this->tmp->assign ( 'title', '新增子导航' );
			$this->tmp->assign ( 'prev_url', PREV_URL );
		}
	}
	
	/**
	 * 显示子导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	private function displayChild() {
		if (isset ( $_GET ['pid'] )) {
			$this->model->pid = $_GET['pid'];
			parent::page($this->model->getNavCount ());
			
			$this->tmp->assign ( 'pid', $this->model->pid );
			$this->tmp->assign ( 'prev_name', $_GET['prev_name'] );
			$this->tmp->assign ( 'prev_url', PREV_URL );
			$this->tmp->assign ( 'displayChild', true );
			$this->tmp->assign ( 'title', '显示子导航' );
			$this->tmp->assign ( 'navs', $this->model->search () );
		}
		
	}
	
	/**
	 * 导航列表
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	private function display() {
		parent::page($this->model->getNavCount ());
		
		$this->tmp->assign ( 'display', true );
		$this->tmp->assign ( 'title', '导航列表' );
		$this->tmp->assign ( 'navs', $this->model->search () );
	}
	
	/**
	 * 添加导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	private function add() {
		if (isset ( $_POST ['send'] )) {
			if (Validate::checkNull($_POST ['nav_name'])) {
				Tool::alertBack('导航名称不得为空');
			}
			if (Validate::checkLength($_POST ['nav_name'], 20)) {
				Tool::alertBack('导航名称不得大于20位');
			}
			if (Validate::checkLength($_POST ['nav_name'], 2, 1)) {
				Tool::alertBack('导航名称不得小于2位');
			}
			$this->model->nav_name = $_POST ['nav_name'];
			
			if (Validate::checkLength($_POST ['nav_info'], 200)) {
				Tool::alertBack('导航信息不得大于200位');
			}
			$this->model->nav_info = $_POST ['nav_info'];
			
			$this->model->nav_name = $_POST ['nav_name'];
			if ($this->model->loadByNavName() != null) {
				Tool::alertBack('此导航名称已经被使用，请重新想一个哦！');
			}
			
			$this->model->pid = $_GET['pid'];
			$affected_rows = $this->model->add ();
			if ($affected_rows) {
				Tool::alertLocation('恭喜，添加导航成功', $_POST ['prev_url']);
			} else {
				Tool::alertBack('添加失败咯');
			}
		}
		if (isset($_GET['pid'])) {
			$this->tmp->assign ( 'pid', $_GET['pid'] );
		}
		$this->tmp->assign ( 'add', true );
		$this->tmp->assign ( 'title', '新增导航' );
		$this->tmp->assign ( 'prev_url', PREV_URL );
	}
	
	/**
	 * 编辑导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	private function edit() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST ['nav_name'])) {
				Tool::alertBack('导航名称不得为空');
			}
			if (Validate::checkLength($_POST ['nav_name'], 20)) {
				Tool::alertBack('导航名称不得大于20位');
			}
			if (Validate::checkLength($_POST ['nav_name'], 2, 1)) {
				Tool::alertBack('导航名称不得小于2位');
			}
		
			if (Validate::checkLength($_POST ['nav_info'], 200)) {
				Tool::alertBack('导航信息不得大于200位');
			}
				
			$this->model->id = $_POST['id'];
			$this->model->nav_name = $_POST['nav_name'];
			$this->model->nav_info = $_POST['nav_info'];
			$this->model->modify() ? Tool::alertLocation('恭喜你，修改导航成功！', $_POST ['prev_url']) : Tool::alertBack('很遗憾，修改导航失败！');
		}
		
		$this->tmp->assign ( 'edit', true );
		$this->tmp->assign ( 'title', '编辑导航' );
		$this->model->id = $_GET['id'];
		is_object($this->model->load()) ? true : Tool::alertBack('导航传值的id有误！');
		$obj = $this->model->load();
		$this->tmp->assign ( 'id', $obj->id );
		$this->tmp->assign ( 'nav_name', $obj->nav_name  );
		$this->tmp->assign ( 'nav_info', $obj->nav_info  );
		$this->tmp->assign ( 'prev_url', PREV_URL );
	}
	
	/**
	 * 删除导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	private function delete() {
		if (isset($_GET['id'])) {
			$this->model->id = $_GET['id'];
				
			$affected_rows = $this->model->delete();
			if ($affected_rows) {
				Tool::alertLocation('恭喜，删除导航成功', PREV_URL);
			} else {
				Tool::alertBack('删除失败咯，删除信息不存在或系统错误');
			}
		} else {
			Tool::alertBack('操作非法，请按规章制度办事哦！');
		}
	}
	
	/**
	 * 排序
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function sort() {
		if ($_POST['send']) {
			$this->model->sort = $_POST['sort'];
			if ($this->model->sort()) {
				Tool::alertLocation(null, PREV_URL);
			}
		}
	}
}