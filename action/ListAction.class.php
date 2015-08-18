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
	 * 总体调节流程的方法
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-17
	 */
	public function execute() {
		$this->getNav();
		$this->getListContent();
	}
	
	/**
	 * 获取前台文档列表
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-17
	 */
	private function getListContent() {
		if (isset($_GET['id'])) {
			parent::__construct($this->tmp, new ContentModel());
			$this->model->id = $_GET['id'];
			$navids = $this->model->getNavChild();
			if ($navids) {
				$this->model->nav = Tool::objArrOfStr($navids,'id');
			} else {
				$id = $this->model->id;
				$this->model->nav = "'$id'";
			}
			
			parent::page($this->model->getContentCount(), ARTICLE_SIZE);
			$contents = $this->model->listContentByNav();
			$contents = Tool::subStr($contents,'info',120,'utf-8');
			$contents = Tool::subStr($contents,'title',35,'utf-8');
			$this->tmp->assign('contents', $contents );
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
	/**
	 * 获取前台的导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function getNav() {
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