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
			case 'index' :
				$this->index();
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
	private function header() {
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
	
	/**
	 * 首页缓存
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	private function index() {
		$cookie = new Cookie ( 'username' );
		$username = $cookie->getCookie ();
		$cookie = new Cookie ( 'face' );;
		$face = $cookie->getCookie ();
		$menber = '';
		if ($username && $face) {
			$menber .= '<h2>会员信息</h2>';
			$menber .= '<div class="a">您好，<strong>'.$username.'</strong>欢迎光临本系统！</div>';
			$menber .= '<div class="b">';
			$menber .= '<img src="images/'.$face.'" alt="'.$username.'" />';
			$menber .= '<a href="###">个人中心</a>';
			$menber .= '<a href="###">我的评论</a>';
			$menber .= '<a href="register.php?action=logout">退出登录</a>';
			$menber .= '</div>';
			
			echo "
				function getIndexLogin() {
					document.write('$menber');
				}
			";
		}
		else {
			$menber .= '<h2>会员登录</h2>';
			$menber .= '<form method="post" action="register.php?action=login" name="login">';
			$menber .= '<label>用户名：<input type="text" name="username" class="text" /></label>';
			$menber .= '<label>密　码：<input type="password" name="password" class="text" /></label>';
			$menber .= '<label class="yzm">验证码：<input type="text" name="code" class="text code" /> <img src="config/code.php" width="130" height="50" alt="验证码" onclick=this.src="config/code.php?tm=" + Math.random(); class="code" /></label>';
			$menber .= '<p>';
			$menber .= '<input type="submit" name="send" value="登录" class="submit" onclick="return checkLogin();" />';
			$menber .= '<a href="register.php?action=reg">注册会员</a>';
			$menber .= '<a href="javascript:;">忘记密码？</a>';
			$menber .= '</p>';
			$menber .= '</form>';
			echo "
				function getIndexLogin() {
					document.write('$menber');
				}
			";
		}
	}
}