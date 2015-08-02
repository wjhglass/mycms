<?php
require substr ( dirname ( __FILE__ ), 0, - 6 ) . '/init.inc.php';
require ROOT_PATH . '/model/Manage.class.php';
global $tmp;

switch ($_GET ['action']) {
	case 'list' :
		$tmp->assign('list', true);
		$tmp->assign('title', '管理员列表');
		break;
	case 'add' :
		$tmp->assign('add', true);
		$tmp->assign('title', '新添管理员');
		break;
	case 'edit' :
		$tmp->assign('edit', true);
		$tmp->assign('title', '编辑管理员');
		break;
	case 'delete' :
		$tmp->assign('delete', true);
		$tmp->assign('title', '删除管理员');
		break;
	default :
		echo '非法操作';
		break;
}

$manage = new Manage ();

$tmp->assign ( 'manages', $manage->listAll () );
$tmp->display ( 'manage.tpl' );
