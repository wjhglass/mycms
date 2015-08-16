<?php
/**
 * 首页列表控制器
 * @author 吴金华
 *
 */
class ListAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct($tmp);
	}
	
	/**
	 * 获取前台的导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	public function getNav() {
		if (isset($_GET['id'])) {
			$nav = new NavModel();
			$nav->id = $_GET['id'];
			$navObj = $nav->load();
			if ($navObj != null) {
				// 主导航
				$this->tmp->assign('id', $nav->id );
				$this->tmp->assign('nav_name', $navObj->nav_name );
				$this->tmp->assign('nid', $navObj->nid );
				$this->tmp->assign('nnav_name', $navObj->nnav_name );
				
				// 子导航集
				$nav->pid = $nav->id;
				$this->tmp->assign('childNavs', $nav->listFrontChildNav());
			} else {
				Tool::alertBack('此导航不存在');
			}
		} else {
			Tool::alertBack('非法操作');
		}
	}
}