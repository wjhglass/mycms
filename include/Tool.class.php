<?php
/**
 * 工具类
 * @author 吴金华
 *
 */
class Tool {
	/**
	 * 弹窗跳转
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 * @param unknown $_info
	 *        	弹窗信息
	 * @param unknown $_url
	 *        	即将要跳转的url
	 */
	public static function alertLocation($_info, $_url) {
		if (empty ( $_info )) {
			header ( 'Location:' . $_url );
			exit ();
		} else {
			echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
			exit ();
		}
	}
	
	/**
	 * 弹窗返回
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 * @param unknown $_info
	 *        	弹窗信息
	 */
	public static function alertBack($_info) {
		echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
		exit ();
	}
	
	/**
	 * 弹窗赋值关闭(上传专用)
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 * @param unknown $info        	
	 * @param unknown $path        	
	 */
	static public function alertOpenerClose($info, $path) {
		echo "<script type='text/javascript'>alert('$info');</script>";
		echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$path';</script>";
		echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
		echo "<script type='text/javascript'>opener.document.content.pic.src='$path';</script>";
		echo "<script type='text/javascript'>window.close();</script>";
		exit ();
	}
	
	/**
	 * 将当前文件转换成.tpl文件名
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 * @return string
	 */
	static public function tplName() {
		$str = explode ( '/', $_SERVER ["SCRIPT_NAME"] );
		$str = explode ( '.', $str [count ( $str ) - 1] );
		return $str [0];
	}
	
	/**
	 * 显示html过滤
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 * @param unknown $data        	
	 * @return string
	 */
	public static function htmlString($data) {
		if (is_array ( $data )) {
			foreach ( $data as $key => $value ) {
				$string [$key] = Tool::htmlString ( $value ); // 递归
			}
		} elseif (is_object ( $data )) {
			// 反射出类传入的类的实例
			$reflect = new ReflectionClass ( $data );
			$string = $reflect->newInstanceArgs ();
			
			foreach ( $data as $key => $value ) {
				$string->$key = Tool::htmlString ( $value ); // 递归
			}
		} else {
			$string = htmlspecialchars ( $data );
		}
		return isset ( $string ) ? $string : '';
	}
	
	/**
	 * 将html字符串转换成html标签
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-18
	 * @param unknown $_str        	
	 * @return string
	 */
	static public function unHtml($_str) {
		return htmlspecialchars_decode ( $_str );
	}
	
	/**
	 * 数据库输入过滤
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 * @param unknown $data        	
	 * @return Ambigous <unknown, string>
	 */
	public static function mysqlString($data) {
		return ! GPC ? addslashes ( $data ) : $data;
	}
	
	/**
	 * 将对象数组转换成字符串，并且去掉最后的逗号
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-18
	 * @param unknown $object        	
	 * @param unknown $field        	
	 * @return string
	 */
	static public function objArrOfStr($object, $field) {
		$html = '';
		if ($object) {
			foreach ( $object as $value ) {
				$fld = $value->$field;
				$html .= "'$fld',";
			}
		}
		
		$retStr = stripslashes ( substr ( $html, 0, strlen ( $html ) - 1 ) );
		return $retStr;
	}
	
	/**
	 * 字符串截取
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-17
	 * @param unknown $object        	
	 * @param unknown $field        	
	 * @param unknown $length        	
	 * @param unknown $encoding        	
	 * @return unknown
	 */
	static public function subStr($object, $field, $length, $encoding) {
		if ($object) {
			if (is_array ( $object )) {
				foreach ( $object as $value ) {
					if (mb_strlen ( $value->$field, $encoding ) > $length) {
						$value->$field = mb_substr ( $value->$field, 0, $length, $encoding ) . '...';
					}
				}
			} else {
				$object = mb_substr ( $object, 0, $length, $encoding );
			}
		}
		return $object;
	}
	
	/**
	 * 清理session
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public static function unSession() {
		if (session_start ()) {
			session_destroy ();
		}
	}
	
	/**
	 * 创建一个guid
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 * @param string $namespace        	
	 * @return string
	 */
	public static function createGuid($namespace = '') {
		static $guid = '';
		$uid = uniqid ( "", true );
		$data = $namespace;
		$data .= $_SERVER ['REQUEST_TIME'];
		$data .= $_SERVER ['HTTP_USER_AGENT'];
		$data .= $_SERVER ['REMOTE_ADDR'];
		$data .= $_SERVER ['REMOTE_PORT'];
		$hash = strtoupper ( hash ( 'ripemd128', $uid . $guid . md5 ( $data ) ) );
		return $hash;
	}
}