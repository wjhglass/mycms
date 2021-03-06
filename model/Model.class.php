<?php

/**
 * 基类模型
 * @author 吴金华
 *
 */
class Model {
	/**
	 * 增删修模型
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	protected function aud($sql) {
		$db = DB::getDB ();
		$db->query ( $sql );
		$affected_rows = $db->affected_rows;
		$result = null;
		Db::unDB ( $result, $db );
		return $affected_rows;
	}
	
	/**
	 * 加载一个对象
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	protected function one($sql) {
		$db = DB::getDB ();
		// 获取结果集
		$result = $db->query ( $sql );
		
		$obj = null;
		// 打印出第一组数据
		if (! ! $object = $result->fetch_object ()) {
			$obj = $object;
		}
		
		DB::unDB ( $result, $db );
		
		return Tool::htmlString ( $obj );
	}
	
	/**
	 * 获取总记录数
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 * @param unknown $sql        	
	 * @return unknown
	 */
	protected function getCount($sql) {
		$db = DB::getDB ();
		
		$result = $db->query ( $sql );
		$total = $result->fetch_row ()[0];
		DB::unDB ( $result, $db );
		
		return $total;
	}
	
	/**
	 * 查找多条数据
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-4
	 */
	protected function all($sql) {
		$db = DB::getDB ();
		// 获取结果集
		$result = $db->query ( $sql );
		
		$models = array ();
		// 打印出第一组数据
		while ( ! ! $object = $result->fetch_object () ) {
			$models [] = $object;
		}
		
		DB::unDB ( $result, $db );
		
		return Tool::htmlString ( $models );
	}
	
	/**
	 * 执行多条sql语句
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 * @param unknown $sql
	 */
	public function multi($sql)	{
		$db = DB::getDB();
		$db->multi_query($sql);
		$result = null;
		DB::unDB($result, $db);
		return true;
	}
}