<?php
/**
 * 文件上传类
 * @author 吴金华
 *
 */
class FileUpload {
	private $error; // 错误代码
	private $maxFileSize; // 指定的最大文件大小
	private $type; // 文件类型
	private $typeArr = array (
			'image/jpeg',
			'image/pjpeg',
			'image/png',
			'image/x-png',
			'image/gif' 
	); // 类型合集
	private $path; // 目录路径
	private $today; // 今天目录
	private $name; // 文件名
	private $tmp; // 临时文件
	private $linkpath; // 链接路径
	private $linktotay; // 今天目录（相对）
	
	/**
	 * 构造方法
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 * @param unknown $filefield        	
	 * @param unknown $maxFileSize        	
	 */
	public function __construct($filefield, $maxFileSize) {
		$this->error = $_FILES [$filefield] ['error'];
		$this->maxFileSize = $maxFileSize;
		$this->type = $_FILES [$filefield] ['type'];
		$this->path = ROOT_PATH . UPDIR;
		$this->linktotay = date ( 'Ymd' ) . '/';
		$this->today = $this->path . $this->linktotay;
		$this->name = $_FILES [$filefield] ['name'];
		$this->tmp = $_FILES [$filefield] ['tmp_name'];
		
		$this->checkError ();
		$this->checkType ();
		$this->checkPath ();
		$this->moveUpload ();
	}
	
	/**
	 * 返回路径
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 * @return string
	 */
	public function getPath() {
		$path = $_SERVER ["SCRIPT_NAME"];
		$dir = dirname ( ($path) );
		$strDir = explode('/',$dir);
		$dir = '/'.$strDir[1];
		if ($dir == '\\')
			$dir = '/';
		$this->linkpath = $dir . $this->linkpath;
		return $this->linkpath;
	}
	
	/**
	 * 移动文件
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function moveUpload() {
		if (is_uploaded_file ( $this->tmp )) {
			if (! move_uploaded_file ( $this->tmp, $this->setNewName () )) {
				Tool::alertBack ( '上传失败！' );
			}
		} else {
			Tool::alertBack ( '临时文件不存在！' );
		}
	}
	
	/**
	 * 设置新文件名
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 * @return string
	 */
	private function setNewName() {
		$nameArr = explode ( '.', $this->name );
		$postfix = $nameArr [count ( $nameArr ) - 1];
		$newname = date ( 'YmdHis' ) . mt_rand ( 100, 1000 ) . '.' . $postfix;
		$this->linkpath = UPDIR . $this->linktotay . $newname;
		return $this->today . $newname;
	}
	
	/**
	 * 验证目录
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function checkPath() {
		if (! is_dir ( $this->path ) || ! is_writeable ( $this->path )) {
			if (! mkdir ( $this->path )) {
				Tool::alertBack ( '主目录创建失败！' );
			}
		}
		if (! is_dir ( $this->today ) || ! is_writeable ( $this->today )) {
			if (! mkdir ( $this->today )) {
				Tool::alertBack ( '子目录创建失败！' );
			}
		}
	}
	
	/**
	 * 验证文件类型
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function checkType() {
		if (! in_array ( $this->type, $this->typeArr )) {
			Tool::alertBack ( '不合法的上传类型！' );
		}
	}
	
	/**
	 * 检查错误的情况
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-16
	 */
	private function checkError() {
		if (! empty ( $this->error )) {
			switch ($this->error) {
				case 1 :
					Tool::alertBack ( '上传文件大小超过约定大小' );
					break;
				case 2 :
					Tool::alertBack ( '上传文件大小超过' . ($this->maxFileSize / 1024) . 'KB' );
					break;
				case 3 :
					Tool::alertBack ( '只有部分文件被上传' );
					break;
				case 4 :
					Tool::alertBack ( '没有任何文件被上传' );
					break;
				default :
					Tool::alertBack ( '未知错误' );
					break;
			}
		}
	}
}