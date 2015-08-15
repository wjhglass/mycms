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
			$reflect=new ReflectionClass($data);
			$string  = $reflect->newInstanceArgs();
			
			foreach ( $data as $key => $value ) {
				$string->$key = Tool::htmlString ( $value ); // 递归
			}
		} else {
			$string = htmlspecialchars ( $data );
		}
		return isset($string) ? $string : '';
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