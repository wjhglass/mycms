<?php
/**
 * 基类控制器
 * @author 吴金华
 *
 */
class Action {
	protected $tmp;
	protected $model;
	
	protected function __construct(&$tmp, &$model) {
		$this->tmp = $tmp;
		$this->model = $model;
	}
}