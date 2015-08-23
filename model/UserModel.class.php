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
				 NOW()
			)";
		return parent::aud ( $sql );
	}
}