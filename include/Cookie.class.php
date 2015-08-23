<?php
/**
 * cookie操作类
 * @author 吴金华
 *
 */
class Cookie {
	private $name;
	private $value;
	private $time;
	
	/**
	 * 构造方法
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 * @param unknown $name        	
	 * @param string $value        	
	 * @param number $time        	
	 */
	public function __construct($name, $value = '', $time = 0) {
		$this->name = $name;
		$this->value = $value;
		if (empty ( $time )) {
			$this->time = 0;
		} else {
			$this->time = time () + $time;
		}
	}
	
	/**
	 * 创建cookie
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function setCookie() {
		setcookie ( $this->name, $this->value, $this->time );
	}
	
	/**
	 * 获取cookie
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 * @return unknown
	 */
	public function getCookie() {
		return isset($_COOKIE ["$this->name"]) ? $_COOKIE ["$this->name"] : '';
	}
	
	/**
	 * 移除cookie
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function unCookie() {
		setcookie ( $this->name, '', - 1 );
	}
}
?>