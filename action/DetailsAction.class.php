<?php
/**
 * 详细列表控制器
 * @author 吴金华
 *
 */
class DetailsAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct($tmp);
	}
	
	/**
	 * 总体调节流程的方法
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-18
	 */
	public function execute() {
		$this->detail();
	}
	
	/**
	 * 获取文档的详细内容
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-18
	 */
	public function detail() {
		if (isset($_GET['id'])) {
			parent::__construct($this->tmp, new ContentModel());
			$this->model->id = $_GET['id'];
			if (!$this->model->updateCount()) {
				Tool::alertBack('次文档不存在');
			}
			$content = $this->model->load();
			$this->tmp->assign('id',$content->id);
			$this->tmp->assign('titlec',$content->title);
			$this->tmp->assign('pubdate',$content->pubdate);
			$this->tmp->assign('source',$content->source);
			$this->tmp->assign('author',$content->author);
			$this->tmp->assign('info',$content->info);
			$this->tmp->assign('content',Tool::unHtml($content->content));
			$this->getNav($content->nav);
			if (FRONT_CACHE) {
				$this->tmp->assign('count','<script type="text/javascript">getContentCount();</script>');
			} else {
				$this->tmp->assign('count',$content->count);
			}
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
	//获取前台显示的导航
	private function getNav($id) {
		$nav = new NavModel();
		$nav->id = $id;
		$navObj = $nav->load();
		if ($navObj) {
			//主导航
			if ($navObj->nnav_name) $nav1 = '<a href="list.php?id='.$navObj->nid.'">'.$navObj->nnav_name.'</a> &gt; ';
			$nav2 = '<a href="list.php?id='.$navObj->id.'">'.$navObj->nav_name.'</a>';
			$this->tmp->assign('nav',$nav1.$nav2);
			//子导航集
			$nav->pid = $nav->id;
			$this->tmp->assign('childNavs',$nav->listFrontChildNav());
		} else {
			Tool::alertBack('此导航不存在！');
		}
	}
	
}