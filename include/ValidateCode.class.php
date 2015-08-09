<?php
/**
 * 验证码类
 * @author 吴金华
 *
 */
class ValidateCode {
	private $charset = 'abcdefghkmnpqrstuvwxwzABCDEFGHKLMNPRSTUVWXWZ23456789'; // 随机因子
	private $code; // 验证码
	private $codelen = 5; // 验证码长度
	private $width = 130; // 背景宽度
	private $height = 50; // 背景高度
	private $img; // 图形资源句柄
	private $font; // 字体
	private $fontSize = 20; // 字体大小
	private $fontColor = 20; // 字体颜色
	public function __construct() {
		$this->font = ROOT_PATH . '/font/elephant.ttf'; // 字体
	}
	
	/**
	 * 创建背景
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function createBg() {
		$this->img = imagecreatetruecolor ( $this->width, $this->height );
		$color = imagecolorallocate ( $this->img, mt_rand ( 157, 255 ), mt_rand ( 157, 255 ), mt_rand ( 157, 255 ) );
		imagefilledrectangle ( $this->img, 0, $this->height, $this->width, 0, $color );
	}
	
	/**
	 * 生成字体
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function createFont() {
		$x = $this->width / $this->codelen;
		for($i = 0; $i < $this->codelen; $i ++) {
			$this->fontColor = imagecolorallocate ( $this->img, mt_rand ( 0, 156 ), mt_rand ( 0, 156 ), mt_rand ( 0, 156 ) );
			imagettftext ( $this->img, $this->fontSize, mt_rand ( - 30, 30 ), $x * $i + mt_rand ( 1, 5 ), $this->height / 1.4, $this->fontColor, $this->font, $this->code [$i] );
		}
	}
	
	/**
	 * 生成线条和雪花
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function createLine() {
		for ($i = 0; $i < 8; $i++) {
			$color = imagecolorallocate ( $this->img, mt_rand ( 0, 156 ), mt_rand ( 0, 156 ), mt_rand ( 0, 156 ) );
			imageline($this->img, 0, mt_rand ( 0, $this->height ), $this->width, mt_rand ( 0, $this->height ), $color);
		}
		
		for ($i = 0; $i < 100; $i++) {
			$color = imagecolorallocate ( $this->img, mt_rand ( 200, 255 ), mt_rand ( 200, 255 ), mt_rand ( 200, 255 ) );
			imagestring($this->img, mt_rand(1, 5), mt_rand(0, $this->width), mt_rand(0, $this->height), '.', $color);
		}
	}
	
	/**
	 * 输出图形
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function ouput() {
		header ( 'Content-Type:image/png' );
		imagepng ( $this->img );
		imagedestroy ( $this->img );
	}
	
	/**
	 * 对外生成
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function doImg() {
		$this->createBg ();
		$this->createCode ();
		$this->createFont ();
		$this->createLine();
		$this->ouput ();
	}
	
	/**
	 * 获取验证码
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}
	
	/**
	 * 生成一个随机码
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function createCode() {
		$len = strlen ( $this->charset ) - 1;
		$this->code = '';
		for($i = 0; $i < $this->codelen; $i ++) {
			$this->code .= $this->charset [mt_rand ( 0, $len )];
		}
	}
}