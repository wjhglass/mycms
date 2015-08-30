<?php
/**
 * 用户实体类
 * @author 吴金华
 *
 */
class UserModel extends Model {
	private $id; // 主键
	private $username; // 用户名
	private $password; // 密码
	private $email; // 电子邮箱
	private $question; // 密码问题
	private $answer; // 密码问题的答案
	private $state; // 状态
	private $regdate; // 注册时间
	private $logintime; // 登录时间
	private $limit; // limit语句
	public function __set($name, $val) {
		if (is_array ( $val )) {
			$this->$name = $val;
		} else {
			$this->$name = Tool::mysqlString ( $val );
		}
	}
	public function __get($name) {
		return $this->$name;
	}
	
	/**
	 * 添加用户
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function add() {
		$guid = Tool::createGuid ();
		$sql = "
			INSERT INTO mycms_user (
				id,
				username,
				password,
				email,
				question,
				answer,
				face,
				regdate
			)
			VALUES
			(
				'$guid',
				'$this->username',
				'$this->password',
				'$this->email',
				'$this->question',
				'$this->answer',
				'$this->face',
				 NOW()
			)";
		return parent::aud ( $sql );
	}
	
	/**
	 * 检测用户名重复
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 * @return string
	 */
	public function checkUsername() {
		$sql = "SELECT
					id
				FROM
					mycms_user
				WHERE
					username='$this->username'
				LIMIT 1";
		return parent::one ( $sql );
	}
	
	/**
	 * 检测邮件重复
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 * @return string
	 */
	public function checkEmail() {
		$sql = "SELECT
					id
				FROM
					mycms_user
				WHERE
					email='$this->email'
				LIMIT 1";
		return parent::one ( $sql );
	}
	
	/**
	 * 注册和登录时更新最近的登录时间戳
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-30
	 */
	public function updateLogintime() {
		$_sql = "UPDATE mycms_user
				SET
					logintime='$this->logintime'
				WHERE
					id='$this->id'
				LIMIT 1";
		return parent::aud($_sql);
	}
	
	/**
	 * 获取6条最近登录的会员
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-30
	 * @return string
	 */
	public function lastLoginUser() {
		$sql = "
				SELECT
					username,
					face
				FROM
					mycms_user
				ORDER BY
					logintime DESC
				LIMIT
					0,6";
		return parent::all($sql);
	}
	
	/**
	 * 验证用户
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-23
	 */
	public function validate() {
		$sql = "
			SELECT 
				id,
				username,
				password,
				face
			FROM 
				mycms_user 
			WHERE 
				username='$this->username'
				AND password='$this->password'
			LIMIT 1";
		return parent::one ( $sql );
	}
}