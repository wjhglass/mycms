<?php
/**
 * 基类控制器
 * @author 吴金华
 *
 */
class Action {
	protected $tmp;
	protected $model;
	
	protected function __construct(&$tmp, &$model = null) {
		$this->tmp = $tmp;
		$this->model = $model;
	}
	
	protected function page($total, $pagesize = PAGE_SIZE) {
		$page = new Page ( $total, $pagesize );
		$this->model->limit = $page->limit;
		$this->tmp->assign ( 'page', $page->display () );
		$this->tmp->assign ( 'num', ($page->curPage - 1) * PAGE_SIZE );
	}
}