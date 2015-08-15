<?php
class Praser {
	// 字段，保存模板内容
	private $tpl;
	public function __construct($tplfile) {
		if (! $this->tpl = file_get_contents ( $tplfile )) {
			exit ( 'ERROR：模板文件读取错误！' );
		}
	}
	
	/**
	 * 解析普通变量
	 */
	private function parVar() {
		$patten = '/\{\$([\w]+)\}/';
		if (preg_match ( $patten, $this->tpl )) {
			$this->tpl = preg_replace ( $patten, "<?php echo \$this->vars['$1'];?>", $this->tpl );
		}
	}
	
	/**
	 * 解析if语句
	 */
	private function parIf() {
		$pattenIf = '/\{if\s+\$([\w]+)\}/';
		$pattenEndIf = '/\{\/if\}/';
		$pattenElse = '/\{else\}/';
		if (preg_match ( $pattenIf, $this->tpl )) {
			if (preg_match ( $pattenEndIf, $this->tpl )) {
				$this->tpl = preg_replace ( $pattenIf, "<?php if (isset(\$this->vars['$1']) && \$this->vars['$1'] == true) {?>", $this->tpl );
				$this->tpl = preg_replace ( $pattenEndIf, "<?php } ?>", $this->tpl );
				if (preg_match ( $pattenElse, $this->tpl )) {
					$this->tpl = preg_replace ( $pattenElse, "<?php } else { ?>", $this->tpl );
				}
			} else {
				exit ( 'ERROR：if语句没有关闭！' );
			}
		}
	}
	
	/**
	 * 解析foreach语句
	 */
	private function parForeach() {
		$pattenForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
		$pattenEndForeach = '/\{\/foreach\}/';
		$pattenVar = '/\{@([\w]+)([\w\-\>\+]*)\}/';
		if (preg_match ( $pattenForeach, $this->tpl )) {
			if (preg_match ( $pattenEndForeach, $this->tpl )) {
				$this->tpl = preg_replace ( $pattenForeach, "<?php foreach (\$this->vars['$1'] as \$$2=>\$$3) { ?>", $this->tpl );
				$this->tpl = preg_replace ( $pattenEndForeach, "<?php } ?>", $this->tpl );
				if (preg_match ( $pattenVar, $this->tpl )) {
					$this->tpl = preg_replace ( $pattenVar, "<?php echo \$$1$2?>", $this->tpl );
				}
			} else {
				exit ( 'ERROR：foreach语句必须有结尾标签！' );
			}
		}
	}
	
	/**
	 * 解析include语句
	 */
	private function parInclude() {
		$patten = '/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/';
		if (preg_match_all ( $patten, $this->tpl, $file )) {
			foreach ( $file [2] as $value ) {
				if (! file_exists ( 'templates/' . $value )) {
					exit ( 'ERROR：包含文件出错！' );
				}
				$this->tpl = preg_replace ( $patten, "<?php \$tmp->create('$2')?>", $this->tpl );
			}
		}
	}
	
	/**
	 * PHP代码注释
	 */
	private function parCommon() {
		$patten = '/\{#\}(.*)\{#\}/';
		if (preg_match ( $patten, $this->tpl )) {
			$this->tpl = preg_replace ( $patten, "<?php /* $1 */?>", $this->tpl );
		}
	}
	
	/**
	 * 解析config
	 */
	private function parConfig() {
		$patten = '/<!--\{([\w]+)\}-->/';
		if (preg_match ( $patten, $this->tpl )) {
			$this->tpl = preg_replace ( $patten, "<?php echo \$this->configs['$1'];?>", $this->tpl );
		}
	}
	
	/**
	 * 编译
	 *
	 * @param unknown $parfile
	 *        	被编译后生成的文件
	 */
	public function compile($parfile) {
		// 解析模板内容
		$this->parVar ();
		$this->parIf ();
		$this->parForeach ();
		$this->parInclude ();
		$this->parCommon ();
		$this->parConfig ();
		
		// 生成编译文件
		if (! file_put_contents ( $parfile, $this->tpl )) {
			exit ( 'ERROR：编译文件生成出错！' );
		}
	}
}

?>