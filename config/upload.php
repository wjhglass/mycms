<?php
require substr( dirname ( __FILE__ ), 0, -7) . '/init.inc.php';

if (isset( $_POST['send'] )) {
	$fileupload = new FileUpload('pic', $_POST['MAX_FILE_SIZE']);
	$path = $fileupload->getPath();
	$img = new Image($path);
	$img->thumb(150,100);		//1-100
	$img->out();
	Tool::alertOpenerClose('缩略图上传成功', $path);
} else {
	Tool::alertBack('文件过大或者其他未知错误导致浏览器崩溃！');
}