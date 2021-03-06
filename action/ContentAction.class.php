<?php
/**
 * 文档控制器
 * @author 吴金华
 *
 */
class ContentAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct ( $tmp, new ContentModel () );
	}
	public function action() {
		switch ($_GET ['action']) {
			case 'display' :
				$this->display ();
				break;
			case 'add' :
				$this->add ();
				break;
			case 'edit' :
				$this->edit ();
				break;
			case 'delete' :
				$this->delete ();
				return;
			default :
				echo '非法操作';
				break;
		}
	}
	
	/**
	 * 文档列表
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function display() {
		$this->tmp->assign ( 'display', true );
		$this->tmp->assign ( 'title', '文档列表' );
		
		// 创建导航下拉框的列表数据
		$this->tmp->assign ( 'topNavs', $this->makeNav () );
		
		$nav = new NavModel ();
		if (! isset ( $_GET ['nav'] ) || $_GET ['nav'] == '') {
			$childids = $nav->getNavChildIds ();
			$this->model->nav = Tool::objArrOfStr ( $childids, "id" );
		} else {
			$nav->id = $_GET ['nav'];
			!$nav->load() ? Tool::alertBack('类别参数传输错误') : $this->model->nav = "'" . $_GET ['nav'] . "'";
		}
		parent::page ( $this->model->getContentCount () );
		$contents = $this->model->listContentByNav ();
		$contents = Tool::subStr ( $contents, 'title', 20, 'utf-8' );
		$this->tmp->assign ( 'contents', $contents );
	}
	
	/**
	 * 新增文档
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function add() {
		if (isset ( $_POST ['send'] )) {
			$this->checkPostParams();
			
			if (isset ( $_POST ['attr'] )) {
				$this->model->attr = implode ( ',', $_POST ['attr'] );
			} else {
				$this->model->attr = '无属性';
			}
			$this->model->title = $_POST ['title'];
			$this->model->nav = $_POST ['nav'];
			$this->model->tag = $_POST ['tag'];
			$this->model->keyword = $_POST ['keyword'];
			$this->model->thumbnail = $_POST ['thumbnail'];
			$this->model->source = $_POST ['source'];
			$this->model->author = $_POST ['author'];
			$this->model->info = $_POST ['info'];
			$this->model->content = $_POST ['content'];
			$this->model->commend = $_POST ['commend'];
			$this->model->sort = $_POST ['sort'];
			$this->model->gold = $_POST ['gold'];
			$this->model->limit = $_POST ['limit'];
			$this->model->color = $_POST ['color'];
			$this->model->count = $_POST ['count'];
			
			$this->model->add () ? Tool::alertLocation ( '文档发布成功', '?action=display' ) : Tool::alertBack ( '文档发布失败' );
		}
		
		$this->tmp->assign ( 'add', true );
		$this->tmp->assign ( 'title', '新增文档' );
		$this->tmp->assign ( 'topNavs', $this->makeNav () );
		$this->tmp->assign ( 'author', $_SESSION ['admin'] ['admin_user'] );
	}
	
	/**
	 * 编辑文档
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function edit() {
		if (isset($_POST['send'])) {
			$this->checkPostParams();
			
			if (isset ( $_POST ['attr'] )) {
				$this->model->attr = implode ( ',', $_POST ['attr'] );
			} else {
				$this->model->attr = '无属性';
			}
			$this->model->id = $_POST ['id'];
			$this->model->title = $_POST ['title'];
			$this->model->nav = $_POST ['nav'];
			$this->model->tag = $_POST ['tag'];
			$this->model->keyword = $_POST ['keyword'];
			$this->model->thumbnail = $_POST ['thumbnail'];
			$this->model->source = $_POST ['source'];
			$this->model->author = $_POST ['author'];
			$this->model->info = $_POST ['info'];
			$this->model->content = $_POST ['content'];
			$this->model->commend = $_POST ['commend'];
			$this->model->sort = $_POST ['sort'];
			$this->model->gold = $_POST ['gold'];
			$this->model->limit = $_POST ['limit'];
			$this->model->color = $_POST ['color'];
			$this->model->count = $_POST ['count'];
			
			$this->model->modify () ? Tool::alertLocation ( '文档编辑成功', $_POST ['prev_url'] ) : Tool::alertBack ( '文档编辑失败' );
		}
		
		$this->tmp->assign ( 'edit', true );
		$this->tmp->assign ( 'title', '编辑文档' );
		
		$this->model->id = $_GET ['id'];
		$obj = $this->model->load ();
		if (!is_object($obj)) {
			Tool::alertBack ( '文档编号有误！' );
		}
		$this->tmp->assign ( 'id', $obj->id );
		$this->tmp->assign ( 't', $obj->title );
		$this->tmp->assign ( 'tag', $obj->tag );
		$this->tmp->assign ( 'keyword', $obj->keyword );
		$this->tmp->assign ( 'thumbnail', $obj->thumbnail );
		$this->tmp->assign ( 'source', $obj->source );
		$this->tmp->assign ( 'author', $obj->author );
		$this->tmp->assign ( 'info', $obj->info );
		$this->tmp->assign ( 'content', $obj->content );
		$this->tmp->assign ( 'gold', $obj->gold );
		$this->tmp->assign ( 'count', $obj->count );
		$this->tmp->assign ( 'topNavs', $this->makeNav($obj->nav) );
		$this->tmp->assign ( 'attr', $this->makeAttr($obj->attr) );
		$this->tmp->assign ( 'color', $this->makeColor($obj->color) );
		$this->tmp->assign ( 'sort', $this->makeSort($obj->sort) );
		$this->tmp->assign ( 'limit', $this->makeLimit($obj->limit) );
		$this->tmp->assign ( 'commend', $this->makeCommend($obj->commend) );
		$this->tmp->assign ( 'prev_url', PREV_URL );
	}
	
	/**
	 * 删除文档
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function delete() {
		if (isset($_GET['id'])) {
			$this->model->id = $_GET['id'];
			$affected_rows = $this->model->delete();
			if ($affected_rows) {
				Tool::alertLocation ( '恭喜，删除文档成功', PREV_URL );
			} else {
				Tool::alertBack ( '删除失败咯，删除的文档不存在或系统错误' );
			}
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
	/**
	 * 检查输入的参数
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-20
	 */
	private function checkPostParams() {
		if (Validate::checkNull ( $_POST ['title'] )) {
			Tool::alertBack ( '标题不得为空' );
		}
		if (Validate::checkLength ( $_POST ['title'], 50 )) {
			Tool::alertBack ( '标题不得大于50位' );
		}
		if (Validate::checkLength ( $_POST ['title'], 2, 1 )) {
			Tool::alertBack ( '标题不得小于2位' );
		}
			
		if (Validate::checkNull ( $_POST ['nav'] )) {
			Tool::alertBack ( '必须选择一个栏目' );
		}
			
		if (Validate::checkLength ( $_POST ['tag'], 30 )) {
			Tool::alertBack ( 'TAG标签不得大于30位' );
		}
			
		if (Validate::checkLength ( $_POST ['keyword'], 30 )) {
			Tool::alertBack ( '关键字不得大于30位' );
		}
			
		if (Validate::checkLength ( $_POST ['source'], 100 )) {
			Tool::alertBack ( '文章来源不得大于100位' );
		}
			
		if (Validate::checkLength ( $_POST ['author'], 20 )) {
			Tool::alertBack ( '作者不得大于20位' );
		}
			
		if (Validate::checkLength ( $_POST ['info'], 200 )) {
			Tool::alertBack ( '内容摘要不得大于200位' );
		}
			
		if (Validate::checkNull ( $_POST ['content'] )) {
			Tool::alertBack ( '详细信息不得为空' );
		}
			
		if (! Validate::isNum ( $_POST ['count'] )) {
			Tool::alertBack ( '浏览次数必须是数字' );
		}
		if (! Validate::isNum ( $_POST ['gold'] )) {
			Tool::alertBack ( '消费金币必须是数字' );
		}
	}
	
	/**
	 * 创建导航的下拉列表
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-19
	 * @param unknown $n
	 * @return string
	 */
	private function makeNav($n = null) {
		$nav = new NavModel ();
		$html = '';
		foreach ( $nav->listAllTopNav () as $obj ) {
			$html .= '<optgroup label="' . $obj->nav_name . '">';
			$nav->pid = $obj->id;
			$children = $nav->listFrontChildNav ();
			if ($children) {
				foreach ( $children as $navObj ) {
					$selected = '';
					if ($n == $navObj->id) {
						$selected = 'selected="selected"';
					}
					$html .= '<option '.$selected.' value="' . $navObj->id . '">' . $navObj->nav_name . '</option>';
				}
			}
			$html .= '</optgroup>';
		}
		return $html;
	}
	
	/**
	 * 创建属性的多选框
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-20
	 * @param unknown $n
	 * @return string
	 */
	private function makeAttr($attr) {
		$attrHTML = '';
		$attrArr = array('头条', '推荐', '加粗', '跳转');
		$attrs = explode(',', $attr);
		$attrNo = array_diff($attrArr, $attrs);
		if ($attrs[0] != '无属性') {
			foreach ($attrs as $value) {
				$attrHTML .= '<input type="checkbox" checked name="attr[]" value="'.$value.'" />'.$value;
			}
		}
		foreach ($attrNo as $value) {
			$attrHTML .= '<input type="checkbox" name="attr[]" value="'.$value.'" />'.$value;
		}
		return $attrHTML;
	}
	
	/**
	 * 创建颜色的多选框
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-20
	 * @param unknown $color
	 * @return string
	 */
	private function makeColor($color) {
		$colorArr = array(''=>'默认颜色', 'red'=>'红色', 'blue'=>'蓝色', 'orange'=>'橙色');
		$colorHTML = '<select name="color">';
		foreach ($colorArr as $key=>$value) {
			if ($key == $color) {
				$colorHTML .= '<option value="'.$key.'" selected style="color:'.$key.';">'.$value.'</option>';
			} else {
				$colorHTML .= '<option value="'.$key.'" style="color:'.$key.';">'.$value.'</option>';
			}
		}
		$colorHTML .= '</select>';
		return $colorHTML;
	}
	
	/**
	 * 创建文档排序的多选框
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-20
	 * @param unknown $sort
	 * @return string
	 */
	private function makeSort($sort) {
		$sortArr = array('0'=>'默认排序', '1'=>'置顶一天', '2'=>'置顶一周', '3'=>'置顶一月', '4'=>'置顶一年');
		$sortHTML = '<select name="sort">';
		foreach ($sortArr as $key=>$value) {
			if ($key == $sort) {
				$sortHTML .= '<option value="'.$key.'" selected style="color:'.$key.';">'.$value.'</option>';
			} else {
				$sortHTML .= '<option value="'.$key.'" style="color:'.$key.';">'.$value.'</option>';
			}
		}
		$sortHTML .= '</select>';
		return $sortHTML;
	}
	
	/**
	 * 创建文档排序的多选框
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-20
	 * @param unknown $sort
	 * @return string
	 */
	private function makeLimit($limit) {
		$limitArr = array('0'=>'开放浏览', '1'=>'初级会员', '2'=>'中级会员', '3'=>'高级会员', '4'=>'VIP会员');
		$limitHTML = '<select name="limit">';
		foreach ($limitArr as $key=>$value) {
			if ($key == $limit) {
				$limitHTML .= '<option value="'.$key.'" selected style="color:'.$key.';">'.$value.'</option>';
			} else {
				$limitHTML .= '<option value="'.$key.'" style="color:'.$key.';">'.$value.'</option>';
			}
		}
		$limitHTML .= '</select>';
		return $limitHTML;
	}
	
	/**
	 * 创建文档排序的多选框
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-20
	 * @param unknown $commend
	 * @return string
	 */
	private function makeCommend($commend) {
		$commendArr = array('1'=>'允许评论', '0'=>'禁止评论');
		$commendHTML = '';
		foreach ($commendArr as $key=>$value) {
			if ($key == $commend) {
				$commendHTML .= '<input type="radio" name="commend" value="'.$key.'" checked="checked" />'.$value;
			} else {
				$commendHTML .= '<input type="radio" name="commend" value="'.$key.'" />'.$value;
			}
		}
		return $commendHTML;
	}
}