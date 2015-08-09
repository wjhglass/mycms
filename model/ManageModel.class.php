<?php
/**
 * 管理员实体类
 * @author 吴金华
 *
 */
class ManageModel extends Model {
	private $id;// 主键
	private $admin_user;// 管理员用户名
	private $admin_password; // 管理员密码
	private $level;// 管理员等级
	
	public function __set($name, $val) {
		$this->$name = $val;
	}
	
	public function __get($name) {
		return $this->$name;
	}
	
	/**
	 * 加载一个管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	public function load() {
		$sql = <<<sql
SELECT
	a.id,
	a.admin_user,
	a.admin_password,
	a.`level`,
	a.login_count,
	a.last_ip,
	a.last_time,
	a.reg_time
FROM
	mycms_manage a
WHERE a.id='$this->id' LIMIT 1
sql;
		return parent::one($sql);
	}
	
	/**
	 * 通过管理员的用户名去查找
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function loadByAdminuser() {
		$sql = <<<sql
SELECT
	a.id,
	a.admin_user,
	a.admin_password,
	a.`level`,
	a.login_count,
	a.last_ip,
	a.last_time,
	a.reg_time
FROM
	mycms_manage a
WHERE a.admin_user='$this->admin_user' LIMIT 1
sql;
		return parent::one($sql);
	}
	
	/**
	 * 通过等级的代码去查找
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function loadByLevel() {
		$sql = <<<sql
SELECT
	a.id,
	a.admin_user,
	a.admin_password,
	a.`level`,
	a.login_count,
	a.last_ip,
	a.last_time,
	a.reg_time
FROM
	mycms_manage a
WHERE a.`level`='$this->level' LIMIT 1
sql;
		return parent::one($sql);
	}
	
	/**
	 * 查询所有管理员
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-2
	 */
	public function listAll() {
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
		return parent::all($sql);
	}
	
	/**
	 * 添加管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	public function add() {
		$guid = Tool::createGuid();
		$sql = <<<sql
INSERT INTO mycms_manage (
	id,
	admin_user,
	admin_password,
	`level`,
	reg_time
)
VALUES
	(
		'$guid',
		'$this->admin_user',
		'$this->admin_password',
		'$this->level',
		NOW()
)
sql;
		return parent::aud($sql);
	}
	
	/**
	 * 修改管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	public function modify() {
		$sql = <<<sql
UPDATE  mycms_manage 
SET 
	admin_password='$this->admin_password',
	level='$this->level' 
WHERE 
	id='$this->id' LIMIT 1
sql;
		return parent::aud($sql);
	}
	
	/**
	 * 删除管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	public function delete() {
		$sql = <<<sql
DELETE FROM mycms_manage WHERE id='$this->id' LIMIT 1
sql;
		return parent::aud($sql);
	}
}