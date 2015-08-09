<?php
class Page {
	private $total; // 总记录的条数
	private $pageSize; // 每页显示的条数
	private $curPage; // 当前页码
	private $pageNum; // 总页码
	private $limit; // limit语句
	private $url; // 链接地址
	private $bothNum; // 两边保持数字分页的量
	
	public function __construct($total, $pageSize) {
		$this->total = $total;
		$this->pageSize = $pageSize;
		$this->pageNum = ceil ( $this->total / $this->pageSize );
		$this->curPage = $this->setCurPage ();
		$this->limit = 'LIMIT ' . ($this->curPage - 1) * $this->pageSize . ', ' . $this->pageSize;
		$this->url = $this->getUrl ();
		$this->bothNum = BOTH_NUM;
	}
	
	/**
	 * 获取当前页码
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 * @return unknown number
	 */
	private function setCurPage() {
		if (! empty ( $_GET ['curPage'] )) {
			if ($_GET ['curPage'] > 0) {
				if ($_GET ['curPage'] > $this->pageNum) {
					return $this->pageNum;
				} else {
					return $_GET ['curPage'];
				}
			} else {
				return 1;
			}
		} else {
			return 1;
		}
	}
	
	/**
	 * 显示首页
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function head() {
		if (! isset ( $this->curPage ) || $this->curPage <= 1) {
			return '';
		}
		return ' <a href="' . $this->url . '">首页</a> ';
	}
	
	/**
	 * 显示上一页
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function prev() {
		if ($this->curPage <= 1) {
			return '<span>上一页</span>';
		}
		return ' <a href="' . $this->url . '&curPage=' . ($this->curPage - 1) . '">上一页</a> ';
	}
	
	/**
	 * 数字目录
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 * @return string
	 */
	private function pageList() {
		$pagelist = '';
		for($i = $this->bothNum; $i >= 1; $i --) {
			$page = $this->curPage - $i;
			if ($page < 1)
				continue;
			$pagelist .= ' <a href="' . $this->url . '&curPage=' . $page . '">' . $page . '</a> ';
		}
		$pagelist .= ' <span class="me">' . $this->curPage . '</span> ';
		for($i = 1; $i <= $this->bothNum; $i ++) {
			$page = $this->curPage + $i;
			if ($page > $this->pageNum)
				break;
			$pagelist .= ' <a href="' . $this->url . '&curPage=' . $page . '">' . $page . '</a> ';
		}
		return $pagelist;
	}
	
	/**
	 * 显示下一页
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function next() {
		if ($this->curPage >= $this->pageNum) {
			return '<span>下一页</span>';
		}
		return ' <a href="' . $this->url . '&curPage=' . ($this->curPage + 1) . '">下一页</a> ';
	}
	
	/**
	 * 显示尾页
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function tail() {
		if ($this->curPage >= $this->pageNum) {
			return '';
		}
		return ' <a href="' . $this->url . '&curPage=' . $this->pageNum . '">尾页</a> ';
	}
	
	/**
	 * 显示页脚
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 * @return Ambigous <unknown, number, unknown>
	 */
	public function display() {
		return $this->head () . $this->prev () . $this->pageList () . $this->next () . $this->tail () . '<span>共计'.$this->total.'条</span><span>每页'.$this->pageSize.'条</span><span>总'.$this->pageNum.'页</span>';
	}
	
	/**
	 * 获取url
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	private function getUrl() {
		$url = $_SERVER ['REQUEST_URI'];
		$parseurl = parse_url ( $url );
		if (isset ( $parseurl ['query'] )) {
			parse_str ( $parseurl ['query'], $_query );
			unset ( $_query ['curPage'] );
			$url = $parseurl ['path'] . '?' . http_build_query ( $_query );
		}
		return $url;
	}
	public function __set($name, $val) {
		$this->$name = $val;
	}
	public function __get($name) {
		return $this->$name;
	}
}
