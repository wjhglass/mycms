<?php
/**
 * 内容控制器
 * @author 吴金华
 *
 */
class ContentAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct($tmp, new ContentModel());
	}
	
	public function action() {
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
	 * 文章列表
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function display() {
	//	parent::page($this->model->getContentCount ());
		
		$this->tmp->assign ( 'display', true );
		$this->tmp->assign ( 'title', '文档列表' );
		//$this->tmp->assign ( 'levels', $this->model->search () );
	}

	/**
	 * 新增文章
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function add() {
		$this->tmp->assign ( 'add', true );
		$this->tmp->assign ( 'title', '新增文档' );
		$this->tmp->assign ( 'prev_url', PREV_URL );
	}
	
	/**
	 * 编辑文章
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function edit() {
	}
	
	/**
	 * 删除文章
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function delete() {
	}
}