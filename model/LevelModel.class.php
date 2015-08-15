<?php
/**
 * 等级实体类
 * @author 吴金华
 *
 */
class LevelModel extends Model {
	private $id; // 主键
	private $level; // 等级代码
	private $level_name; // 等级名称
	private $level_info; // 等级信息
	public function __set($name, $val) {
		$this->$name = Tool::mysqlString ( $val );
	}
	public function __get($name) {
		return $this->$name;
	}
	
	/**
	 * 加载一个等级
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function load() {
		$sql = <<<sql
SELECT
	a.id,
	a.`level`,
	a.level_name,
	a.level_info
FROM
	mycms_level a
WHERE a.id='$this->id' LIMIT 1
sql;
		return parent::one ( $sql );
	}
	
	/**
	 * 通过等级的名称去查找
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function loadByLevelName() {
		$sql = <<<sql
SELECT
	a.id,
	a.`level`,
	a.level_name,
	a.level_info
FROM
	mycms_level a
WHERE a.level_name='$this->level_name' LIMIT 1
sql;
		return parent::one ( $sql );
	}
	
	/**
	 * 通过等级的代码去查找
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function loadByLevel() {
		$sql = <<<sql
SELECT
	a.id,
	a.`level`,
	a.level_name,
	a.level_info
FROM
	mycms_level a
WHERE a.`level`='$this->level' LIMIT 1
sql;
		return parent::one ( $sql );
	}
	
	/**
	 * 查询所有等级
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function listAll() {
		$sql = <<<sql
SELECT
	id,
	LEVEL,
	level_name,
	level_info
FROM
	mycms_level
ORDER BY
	LEVEL ASC
sql;
		return parent::all ( $sql );
	}
	
	/**
	 * 添加等级
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function add() {
		$guid = Tool::createGuid ();
		$sql = <<<sql
INSERT INTO mycms_level (
	id,
	LEVEL,
	level_name,
	level_info
)
VALUES
	(
		'$guid',
		'$this->level',
		'$this->level_name',
		'$this->level_info'
)
sql;
		return parent::aud ( $sql );
	}
	
	/**
	 * 修改等级
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function modify() {
		$sql = <<<sql
UPDATE  mycms_level
SET 
	level_name='$this->level_name',
	level_info='$this->level_info'
WHERE 
	id='$this->id' LIMIT 1
sql;
		return parent::aud ( $sql );
	}
	
	/**
	 * 删除等级
	 * 
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function delete() {
		$sql = <<<sql
DELETE FROM mycms_level WHERE id='$this->id' LIMIT 1
sql;
		return parent::aud ( $sql );
	}
}