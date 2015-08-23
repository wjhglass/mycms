<?php
/**
 * 静态页面局部不缓存
 * @author 吴金华
 *
 */
class Cache {
	private $flag;
	public function __construct($noCache) {
		$this->flag = in_array(Tool::tplName(), $noCache);
	} 
	
	/**
	 * 返回是否缓存页面的bool值
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function isNoCachePage() {
		return $this->flag;
	}
	
	/**
	 * 执行具体的动作
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function execute() {
		switch ($_GET['type']) {
			case 'details':
				$this->details();
				break;
			case 'list':
				$this->listc();
				break;
			case 'header' :
				$this->header();
				break;
		}
	}
	
	/**
	 * 详细缓存
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function details() {
		$content = new ContentModel ();
		$content->id = $_GET ['id'];
		$this->updateCount ( $content );
		$this->load ( $content );
	}
	
	/**
	 * 列表缓存
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function listc() {
		$content = new ContentModel ();
		$content->id = $_GET ['id'];
		$this->load ( $content );
	}
	
	/**
	 * 累计
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 * @param unknown $content
	 */
	private function updateCount(&$content) {
		$content->updateCount ();
	}
	
	/**
	 * 获取
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 * @param unknown $content
	 */
	private function load(&$content) {
		$count = $content->load ()->count;
		echo "
			function getContentCount() {
				document.write('$count');
			}
		";
	}
	
	/**
	 * header
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function header() {
		$cookie = new Cookie('username');
		if ($cookie->getCookie()) {
			echo "
			function getHeader() {
				document.write('{$cookie->getCookie()}，您好！ <a href=\"register.php?action=logout\">退出</a> ');
			}
			";
		} else {
			echo "
				function getHeader() {
					document.write('<a href=\"register.php?action=reg\" class=\"usera\">注册</a> <a href=\"register.php?action=login\" class=\"usera\">登录</a>');
				}
				";
		}
	
	}
}