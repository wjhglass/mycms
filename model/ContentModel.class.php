<?php
/**
 * 内容实体类
 * @author 吴金华
 *
 */
class ContentModel extends Model {
// 	private $id; // 主键
// 	private $level; // 等级代码
// 	private $level_name; // 等级名称
// 	private $level_info; // 等级信息
// 	private $limit; // limit语句
	public function __set($name, $val) {
		$this->$name = Tool::mysqlString ( $val );
	}
	public function __get($name) {
		return $this->$name;
	}
	
	/**
	 * 获取文章的总记录数
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	public function getLevelCount() {
		$sql = <<<sql
SELECT
	COUNT(0)
FROM
	mycms_level
sql;
		return parent::getCount ( $sql );
	}
	
	/**
	 * 检索文章
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	public function search() {
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
$this->limit
sql;
		return parent::all ( $sql );
	}
	
}