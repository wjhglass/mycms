<?php
/**
 * 导航实体类
 * @author 吴金华
 *
 */
class NavModel extends Model {
	private $id; // 主键
	private $nav_name; // 导航名称
	private $nav_info; // 导航信息
	private $pid; // 父导航
	private $sort; // 排序
	private $limit; // limit语句
	public function __set($name, $val) {
		if (is_array($val)) {
			$this->$name = $val;
		} else {
			$this->$name = Tool::mysqlString ( $val );
		}
	}
	public function __get($name) {
		return $this->$name;
	}
	
	/**
	 * 显示前台的主导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function displayFrontNav() {
		$sql = "
				SELECT
					id,
					nav_name
				FROM
					mycms_nav
				WHERE
					pid is null
				ORDER BY sort
				LIMIT 0,".NAV_SIZE;
		return parent::all ( $sql );
	}
	
	/**
	 * 加载一个导航信息
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function load() {
		$sql = <<<sql
SELECT
	a.id,
	a.nav_name,
	a.nav_info,
	a.pid,
	b.id nid,
	b.nav_name nnav_name,
	a.sort
FROM
	mycms_nav a
LEFT JOIN
	mycms_nav b
ON a.pid=b.id
WHERE a.id='$this->id' LIMIT 1
sql;
		return parent::one ( $sql );
	}
	
	/**
	 * 通过导航的名称去查找
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function loadByNavName() {
		$sql = <<<sql
SELECT
	a.id,
	a.nav_name,
	a.nav_info
FROM
	mycms_nav a
WHERE a.nav_name='$this->nav_name' LIMIT 1
sql;
		return parent::one ( $sql );
	}
	
	/**
	 * 获取导航的总记录数
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function getNavCount() {
		if ($this->pid == null) {
			$sql = "
				SELECT
					COUNT(0)
				FROM
					mycms_nav
				WHERE 
					pid is null";
		} else {
			$sql = "
				SELECT
					COUNT(0)
				FROM
					mycms_nav
				WHERE 
					pid = '$this->pid'";
		}
		return parent::getCount ( $sql );
	}
	
	/**
	 * 检索导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function search() {
		if ($this->pid == null) {
			$sql = "
				SELECT
					id,
					nav_name,
					nav_info,
					pid,
					sort
				FROM
					mycms_nav
				WHERE 
					pid is null
				ORDER BY
					sort ASC
				$this->limit";
		} else {
			$sql = "
				SELECT
					id,
					nav_name,
					nav_info,
					pid,
					sort
				FROM
					mycms_nav
				WHERE 
					pid = '$this->pid'
				ORDER BY
					sort ASC
				$this->limit";
		}
		return parent::all ( $sql );
	}
	
	/**
	 * 获取所有的主导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	public function listAllTopNav() {
		$sql = "
		SELECT
			id,
			nav_name,
			nav_info,
			pid,
			sort
		FROM
			mycms_nav
		WHERE
			pid is null
		ORDER BY
			sort ASC";
		return parent::all ( $sql );
	}
	
	/**
	 * 获取前台的子导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	public function listFrontChildNav() {
		$sql = "
		SELECT
		id,
		nav_name,
		nav_info,
		pid,
		sort
		FROM
		mycms_nav
		WHERE
		pid = '$this->pid'
		ORDER BY
		sort ASC";
		return parent::all ( $sql );
	}
	
	/**
	 * 获取导航下的子导航
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-18
	 */
	public function getNavChild() {
		$sql = <<<sql
SELECT
	id
FROM
	mycms_nav
WHERE pid='$this->id'
sql;
		return parent::all( $sql );
	}
	
	/**
	 * 获取非主类的id
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-19
	 */
	public function getNavChildIds() {
		$sql = "
				SELECT
					id
				FROM
					mycms_nav
				WHERE pid is not null";
		return parent::all( $sql );
	}
	
	/**
	 * 添加导航
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function add() {
		$guid = Tool::createGuid ();
		$this->sort = $this->loadMaxSortByPid() + 1;
		if ($this->pid == null) {
			$sql = "
				INSERT INTO mycms_nav (
					id,
					nav_name,
					nav_info,
					sort
				)
				VALUES
				(
					'$guid',
					'$this->nav_name',
					'$this->nav_info',
					'$this->sort'
				)";
		} else {
			$sql = "
				INSERT INTO mycms_nav (
					id,
					nav_name,
					nav_info,
					pid,
					sort
				)
				VALUES
				(
					'$guid',
					'$this->nav_name',
					'$this->nav_info',
					'$this->pid',
					'$this->sort'
				)";
		}
		return parent::aud ( $sql );
	}
	
	/**
	 * 修改导航
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function modify() {
		$sql = <<<sql
UPDATE mycms_nav
SET
	nav_name='$this->nav_name',
	nav_info='$this->nav_info'
WHERE
	id='$this->id' LIMIT 1
sql;
		return parent::aud ( $sql );
	}
	
	/**
	 * 删除导航
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	public function delete() {
		$sql = <<<sql
DELETE FROM mycms_nav WHERE id='$this->id' LIMIT 1
sql;
		return parent::aud ( $sql );
	}
	
	/**
	 * 排序
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	public function sort() {
		$sql = '';
		foreach ($this->sort as $key => $value) {
			if (!is_numeric($value)) {
				continue;
			}
			$sql .= "UPDATE mycms_nav SET sort='$value' WHERE id='$key';";
		}
		return parent::multi($sql);
	}
	
	/**
	 * 根据父导航获取最大排序的导航记录的排序
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-15
	 */
	private function loadMaxSortByPid() {
		if ($this->pid == null) {
			$sql = <<<sql
SELECT
	a.sort
FROM
	mycms_nav a
WHERE a.pid is null
ORDER BY sort desc
LIMIT 1
sql;
		} else {
			$sql = <<<sql
SELECT
	a.sort
FROM
	mycms_nav a
WHERE a.pid='$this->pid'
ORDER BY sort desc
LIMIT 1
sql;
		}
		$obj = parent::one ( $sql );
		if ($obj == null) {
			return 0;
		} else {
			return $obj->sort;
		}
	}
}