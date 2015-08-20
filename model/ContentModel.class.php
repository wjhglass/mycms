<?php
/**
 * 内容实体类
 * @author 吴金华
 *
 */
class ContentModel extends Model {
	private $id; // 编号
	private $title; // 标题
	private $nav; // 栏目
	private $attr; // 属性
	private $tag; // 标签
	private $keyword; // 关键字
	private $thumbnail; // 缩略图
	private $source; // 文章来源
	private $author; // 作者
	private $info; // 摘要
	private $content; // 详细信息
	private $commend; // 是否允许评论
	private $sort; // 文档排序
	private $gold; // 消费金币
	private $limit; // 阅读权限
	private $color; // 消费金币
	private $count; // 浏览次数
	private $pubdate; // 发布时间
	private $midifydate; // 修改时间
	
	public function __set($name, $val) {
		$this->$name = Tool::mysqlString ( $val );
	}
	public function __get($name) {
		return $this->$name;
	}
	
	/**
	 * 获取单条文档内容
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-18
	 */
	public function load() {
		$sql = <<<sql
		SELECT
			id,
			title,
			nav,
			attr,
			tag,
			keyword,
			thumbnail,
			info,
			commend,
			content,
			count,
			gold,
			source,
			author,
			color,
			sort,
			`limit`,
			pubdate
		FROM
			mycms_content
		WHERE id='$this->id'
		LIMIT 1
sql;
		return parent::one($sql);
	}
	
	/**
	 * 获取文档的总记录数
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
	 * 获取文档的总记录数
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-9
	 */
	public function getContentCount() {
		$nav = stripslashes($this->nav);
		$sql = <<<sql
SELECT
	COUNT(0)
FROM
	mycms_content
WHERE nav in ($nav)
sql;
		return parent::getCount ( $sql );
	}
	
	/**
	 * 检索文档
	 *
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
	
	/**
	 * 根据导航获取所有的文档列表
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-17
	 */
	public function listContentByNav() {
		$nav = stripslashes($this->nav);
		$sql = <<<sql
SELECT
	a.id,
	a.title,
	a.title t,
	a.attr,
	a.nav,
	a.pubdate,
	a.info,
	a.thumbnail,
	a.info,
	a.count,
	b.nav_name
FROM
	mycms_content a
LEFT JOIN
	mycms_nav b
ON
	a.nav=b.id
WHERE a.nav in ($nav)
ORDER BY a.pubdate DESC
$this->limit
sql;
		return parent::all ( $sql );
	}
	
	/**
	 * 添加文档
	 *
	 * @author 吴金华
	 * @version 1.0
	 * @since 2015-8-17
	 */
	public function add() {
		$guid = Tool::createGuid ();
		$sql = "
				INSERT INTO mycms_content (
					id,
					title,
					nav,
					attr,
					tag,
					keyword,
					thumbnail,
					source,
					author,
					info,
					content,
					commend,
					sort,
					`limit`,
					color,
					count,
					gold,
					pubdate
				)
				VALUES
				(
					'$guid',
					'$this->title',
					'$this->nav',
					'$this->attr',
					'$this->tag',
					'$this->keyword',
					'$this->thumbnail',
					'$this->source',
					'$this->author',
					'$this->info',
					'$this->content',
					'$this->commend',
					'$this->sort',
					'$this->limit',
					'$this->color',
					'$this->count',
					'$this->gold',
					 NOW()
				)";
		return parent::aud ( $sql );
	}
}