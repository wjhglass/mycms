<?php
/**
 * 验证类
 * @author 吴金华
 *
 */
class Validate {
	/**
	 * 判断是否为空
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 * @param unknown $data
	 *        	要判断的数据
	 */
	public static function checkNull($data) {
		return trim ( $data ) == "";
	}
	
	/**
	 * 判断长度
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 * @param unknown $data
	 *        	要判断的数据
	 * @param unknown $length
	 *        	要检查的长度
	 * @param unknown $flag
	 *        	表示是大于某一长度，还是小于某一长度，1表示大于，0表示小于，2表示等于
	 */
	public static function checkLength($data, $length, $flag = 0) {
		if ($flag == 0) {
			return mb_strlen ( trim ( $data ), 'UTF-8' ) > $length;
		} else if ($flag == 1) {
			return mb_strlen ( trim ( $data ), 'UTF-8' ) < $length;
		} else if ($flag == 2) {
			return mb_strlen ( trim ( $data ), 'UTF-8' ) == $length;
		}
		return false;
	}
	
	/**
	 * 判断是否相等
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 * @param unknown $data
	 *        	要判断的数据
	 * @param unknown $compareData
	 *        	需要相等的值
	 */
	public static function checkEquals($data, $compareData) {
		return trim ( $data ) == trim ( $compareData );
	}
	
	/**
	 * 验证电子邮件
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 * @param unknown $data
	 * @return boolean
	 */
	static public function checkEmail($data) {
		return preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$data);
	}
	
	/**
	 * 判断数据是否是数字
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-17
	 * @param unknown $data
	 */
	public static function isNum($data) {
		return is_numeric($data);
	}
	
	/**
	 * 验证session是否存在
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public static function checkSession() {
		if (!isset($_SESSION['admin'])) {
			Tool::alertBack('非法登录');
		}
	}
}