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
		echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
		exit ();
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