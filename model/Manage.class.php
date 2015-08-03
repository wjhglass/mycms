<?php
/**
 * 管理员实体类
 * @author 吴金华
 *
 */
class Manage {
	private $tmp;
	private $id;// 主键
	private $admin_user;// 管理员用户名
	private $admin_password; // 管理员密码
	private $level;// 管理员等级

	//构造方法，初始化
	public function __construct(&$tmp) {
		$this->tmp = $tmp;
		$this->Action();
	}
	
	/**
	 * 业务流程控制器
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	private function Action() {
		switch ($_GET ['action']) {
			case 'list' :
				$this->tmp->assign ( 'list', true );
				$this->tmp->assign ( 'title', '管理员列表' );
				$this->tmp->assign ( 'manages', $this->listAll () );
				break;
			case 'add' :
				if (isset ( $_POST ['send'] )) {
					$this->admin_user = $_POST ['admin_user'];
					$this->admin_password = md5 ( $_POST ['admin_password'] );
					$this->level = $_POST ['level'];
					$affected_rows = $this->add ();
					if ($affected_rows) {
						Tool::alertLocation('恭喜，添加管理员成功', 'manage.php?action=list');
					} else {
						Tool::alertBack('添加失败咯');
					}
				}
				$this->tmp->assign ( 'add', true );
				$this->tmp->assign ( 'title', '新添管理员' );
				break;
			case 'edit' :
				if (isset($_POST['send'])) {
					$this->id = $_POST['id'];
					$this->admin_password = md5($_POST['admin_password']);
					$this->level = $_POST['level'];
					$this->modify() ? Tool::alertLocation('恭喜你，修改管理员成功！', 'manage.php?action=list') : Tool::alertBack('很遗憾，修改管理员失败！');
				}
				
				$this->tmp->assign ( 'edit', true );
				$this->tmp->assign ( 'title', '编辑管理员' );
				$this->id = $_GET['id'];
				isset($this->id) ? true : Tool::alertLocation('请输入id！', '.');
				is_object($this->load()) ? true : Tool::alertBack('管理员传值的id有误！');
				$obj = $this->load();
				$this->tmp->assign ( 'id', $obj->id );
				$this->tmp->assign ( 'level', $obj->level );
				$this->tmp->assign ( 'admin_user', $obj->admin_user );
				break;
			case 'delete' :
				if (isset($_GET['id'])) {
					$this->id = $_GET['id'];
					$affected_rows = $this->delete();
					if ($affected_rows) {
						Tool::alertLocation('恭喜，删除管理员成功', 'manage.php?action=list');
					} else {
						Tool::alertBack('删除失败咯，删除信息不存在或系统错误');
					}
				} else {
					Tool::alertBack('操作非法，请按规章制度办事哦！');
				}
				return;
			default :
				echo '非法操作';
				break;
		}
		$this->tmp->display('manage.tpl');
	}
	
	/**
	 * 加载一个管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	public function load() {
		$db = DB::getDB ();
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
		// 获取结果集
		$result = $db->query ( $sql );
		
		$obj = null;
		// 打印出第一组数据
		if ( ! ! $object = $result->fetch_object () ) {
			$obj = $object;
		}
		
		DB::unDB ( $result, $db );
		
		return $obj;
	}
	
	/**
	 * 查询所有管理员
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-2
	 */
	public function listAll() {
		$db = DB::getDB ();
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
		
		$manages = array ();
		// 打印出第一组数据
		while ( ! ! $object = $result->fetch_object () ) {
			$manages [] = $object;
		}
		
		DB::unDB ( $result, $db );
		
		return $manages;
	}
	
	/**
	 * 添加管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	public function add() {
		$db = DB::getDB ();
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
		$db->query ( $sql );
		$affected_rows = $db->affected_rows;
		$result = null;
		Db::unDB ( $result, $db );
		
		return $affected_rows;
	}
	
	/**
	 * 修改管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	public function modify() {
		$db = DB::getDB ();
		$sql = <<<sql
UPDATE  mycms_manage 
SET 
	admin_password='$this->admin_password',
	level='$this->level' 
WHERE 
	id='$this->id' LIMIT 1
sql;
		$db->query ( $sql );
		$affected_rows = $db->affected_rows;
		$result = null;
		Db::unDB( $result, $db );
		
		return $affected_rows;
	}
	
	/**
	 * 删除管理员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-3
	 */
	public function delete() {
		$db = DB::getDB ();
		$sql = <<<sql
DELETE FROM mycms_manage WHERE id='$this->id' LIMIT 1
sql;
		$db->query ( $sql );
		$affected_rows = $db->affected_rows;
		$result = null;
		Db::unDB ( $result, $db );
		
		return $affected_rows;
	}
}