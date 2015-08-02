<?php
/**
 * 模版类
 * @author Administrator
 *
 */
class Templates {
	// 变量数组
	private $vars = array ();
	private $configs = array ();
	public function __construct() {
		if (! is_dir ( TPL_DIR ) || ! is_dir ( TPL_C_DIR ) || ! is_dir ( CACHE )) {
			exit ( 'ERROR：模版目录或编译目录或缓存目录不存在，请手工添加！' );
		}
		
		$sxe = simplexml_load_file ( ROOT_PATH . '/config/profile.xml' );
		$taglib = $sxe->xpath ( '/root/taglib' );
		
		foreach ( $taglib as $tag ) {
			$this->configs ["$tag->name"] = "$tag->value";
		}
	}
	
	/**
	 * 注入变量
	 *
	 * @param unknown $var
	 *        	注入的变量名
	 * @param unknown $value
	 *        	注入的变量值
	 */
	public function assign($var, $value) {
		if (isset ( $var ) && ! empty ( $var )) {
			$this->vars [$var] = $value;
		} else {
			exit ( 'ERROR：请设置模板变量' );
		}
	}
	
	/**
	 * 显示模版文件中的内容
	 */
	public function display($tplname) {
		$tplfile = TPL_DIR . $tplname;
		// 判断模版是否存在
		if (! file_exists ( $tplfile )) {
			exit ( 'ERROR：模版文件不存在！' );
		}
		
		// 生成编译文件
		$parfile = TPL_C_DIR . md5 ( $tplname ) . $tplname . '.php';
		// 缓存编译文件
		$cachefile = CACHE . md5 ( $tplname ) . $tplname . '.html';
		
		// 其余缓存后如果已经编译不在重新编译，直接载入缓存即可
		if (IS_CACHE) {
			if (file_exists ( $cachefile ) && file_exists ( $parfile )) {
				// 判断编译文件没有修改过
				if (filemtime ( $parfile ) >= filemtime ( $tplfile ) && filemtime ( $cachefile ) >= filemtime ( $parfile )) {
					include $cachefile;
					return;
				}
			}
		}
		
		if (! file_exists ( $parfile ) || filemtime ( $parfile ) < filemtime ( $tplfile )) {
			// 引入模版解析类
			require_once ROOT_PATH . '/include/Parser.class.php';
			
			// 编译文件
			$parser = new Praser ( $tplfile );
			$parser->compile ( $parfile );
		}
		
		include $parfile;
		
		if (IS_CACHE) {
			// 获取缓冲区中的数据，并且创建缓存文件
			file_put_contents ( $cachefile, ob_get_contents () );
			// 清楚缓冲区
			ob_end_clean ();
			// 载入缓存的静态页面
			include $cachefile;
		}
	}
	
	/**
	 * 解析模块模版而不需要生成缓存文件
	 * 
	 * @param unknown $tplname        	
	 */
	public function create($tplname) {
		$tplfile = TPL_DIR . $tplname;
		// 判断模版是否存在
		if (! file_exists ( $tplfile )) {
			exit ( 'ERROR：模版文件不存在！' );
		}
		
		// 生成编译文件
		$parfile = TPL_C_DIR . md5 ( $tplname ) . $tplname . '.php';
		
		if (! file_exists ( $parfile ) || filemtime ( $parfile ) < filemtime ( $tplfile )) {
			// 引入模版解析类
			require_once ROOT_PATH . '/include/Parser.class.php';
			
			// 编译文件
			$parser = new Praser ( $tplfile );
			$parser->compile ( $parfile );
		}
		
		include $parfile;
	}
}

?>