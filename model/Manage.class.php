<?php
/**
 * 管理员实体类
 * @author 吴金华
 *
 */
class Manage {
	/**
	 * 查询所有管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-2
	 */
	public function listAll() {
		$db = DB::getDB();
		$sql = <<<sql
SELECT
	a.id,
	a.admin_user,
	a.admin_password,
	b.level_name,
	a.login_count,
	a.last_ip,
	a.last_time,
	a.reg_time
FROM
	mycms_manage a
LEFT JOIN mycms_level b ON a.`level` = b.`level`
ORDER BY a.reg_time DESC
LIMIT 0,10
sql;
		// 获取结果集
		$result = $db->query ( $sql );
		
		$manages = array();
		// 打印出第一组数据
		while (!!$object = $result->fetch_object()) {
			 $manages[] = $object;
		}
		
		DB::unDB($result, $db);
		
		return $manages;
	}
	
	/**
	 * 添加管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-2
	 */
	public function add() {
		
	}
}