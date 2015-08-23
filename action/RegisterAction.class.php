<?php
/**
 * 注册控制器控制器
 * @author 吴金华
 *
 */
class RegisterAction extends Action {
	public function __construct(&$tmp) {
		parent::__construct ( $tmp, new ContentModel () );
	}
	public function execute() {
		
	}
	
}