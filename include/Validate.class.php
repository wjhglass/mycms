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
	 *        	表示是大于某一长度，还是小于某一长度，1表示大于，0表示小于
	 */
	public static function checkLength($data, $length, $flag = 0) {
		if ($flag == 0) {
			return mb_strlen ( trim ( $data ), 'UTF-8' ) > $length;
		} else {
			return mb_strlen ( trim ( $data ), 'UTF-8' ) < $length;
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
}