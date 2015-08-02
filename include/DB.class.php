<?php
/**
 * 数据库连接类
 * @author 吴金华
 *
 */
class DB {
	/**
	 * 获取对象句柄
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-2
	 * @return 获得到的对象句柄
	 */
	public static function getDB() {
		// 连接数据库并且获取数据库对象句柄
		$mysqli = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_NAME );
		// 判断数据库连接是否正确
		if (mysqli_connect_errno ()) {
			echo '数据库连接错误！错误代码：' . mysqli_connect_error ();
			exit ();
		}
		
		// 设置编码集
		$mysqli->set_charset ( 'utf8' );
		
		return $mysqli;
	}
	
	/**
	 * 清理数据库
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-2
	 * @param unknown $result
	 *        	要清理的结果集
	 * @param unknown $db
	 *        	要清理的句柄
	 */
	public static function unDB(&$result, &$db) {
		if (is_object ( $result )) {
			// 清理结果集
			$result->free ();
			// 销毁结果集对象
			$result = null;
		}
		
		if (is_object ( $db )) {
			// 关闭数据库
			$db->close ();
			// 销毁对象句柄
			$db = null;
		}
	}
}

?>