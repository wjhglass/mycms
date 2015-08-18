<?php
/**
 * 文档控制器
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
	 * 文档列表
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
	 * 新增文档
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function add() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST ['title'])) {
				Tool::alertBack('标题不得为空');
			}
			if (Validate::checkLength($_POST ['title'], 50)) {
				Tool::alertBack('标题不得大于50位');
			}
			if (Validate::checkLength($_POST ['title'], 2, 1)) {
				Tool::alertBack('标题不得小于2位');
			}
			
			if (Validate::checkNull($_POST ['nav'])) {
				Tool::alertBack('必须选择一个栏目');
			} 
			
			if (Validate::checkLength($_POST ['tag'], 30)) {
				Tool::alertBack('TAG标签不得大于30位');
			} 
			
			if (Validate::checkLength($_POST ['keyword'], 30)) {
				Tool::alertBack('关键字不得大于30位');
			}
			
			if (Validate::checkLength($_POST ['source'], 100)) {
				Tool::alertBack('文章来源不得大于100位');
			}
			
			if (Validate::checkLength($_POST ['author'], 20)) {
				Tool::alertBack('作者不得大于20位');
			}
			
			if (Validate::checkLength($_POST ['info'], 200)) {
				Tool::alertBack('内容摘要不得大于200位');
			}
			
			if (Validate::checkNull($_POST ['content'])) {
				Tool::alertBack('详细信息不得为空');
			}
			
			if (!Validate::isNum($_POST ['count'])) {
				Tool::alertBack('浏览次数必须是数字');
			}
			if (!Validate::isNum($_POST ['gold'])) {
				Tool::alertBack('消费金币必须是数字');
			}
			
			if (isset($_POST['attr'])) {
				$this->model->attr = implode(',', $_POST['attr']);
			} else {
				$this->model->attr = '无属性';
			}
			$this->model->title = $_POST['title'];
			$this->model->nav = $_POST['nav'];
			$this->model->tag = $_POST['tag'];
			$this->model->keyword = $_POST['keyword'];
			$this->model->thumbnail = $_POST['thumbnail'];
			$this->model->source = $_POST['source'];
			$this->model->author = $_POST['author'];
			$this->model->info = $_POST['info'];
			$this->model->content = $_POST['content'];
			$this->model->commend = $_POST['commend'];
			$this->model->sort = $_POST['sort'];
			$this->model->gold = $_POST['gold'];
			$this->model->limit = $_POST['limit'];
			$this->model->color = $_POST['color'];
			$this->model->count = $_POST['count'];
			
			$this->model->add() ? Tool::alertLocation('文档发布成功', '?action=add') : Tool::alertBack('文档发布失败');
		}
		
		$this->tmp->assign ( 'add', true );
		$this->tmp->assign ( 'title', '新增文档' );
		$nav = new NavModel();
		$html = '';
		foreach ($nav->listAllTopNav() as $obj) {
			$html .= '<optgroup label="'.$obj->nav_name.'">';
			$nav->pid = $obj->id;
			$children = $nav->listFrontChildNav();
			if ($children) {
				foreach ($children as $navObj) {
					$html .= '<option value="'.$navObj->id.'">'.$navObj->nav_name.'</option>';
				}
			}
			$html .= '</optgroup>';
		}
		$this->tmp->assign ( 'topNavs', $html );
		$this->tmp->assign ( 'author', $_SESSION['admin']['admin_user'] );
	}
	
	/**
	 * 编辑文档
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function edit() {
	}
	
	/**
	 * 删除文档
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function delete() {
	}
}