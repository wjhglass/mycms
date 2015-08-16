<?php
require substr(dirname(__FILE__),0,-7).'/init.inc.php';
if (isset($_GET['type'])) {
	//查看了源代码，他的名称是：upload
	$fileupload = new FileUpload('upload',$_POST['MAX_FILE_SIZE']);
	$ckefn = $_GET['CKEditorFuncNum'];
	$path = $fileupload->getPath();
	$img = new Image($path);
	$img->ckeImg(650,0);
	$img->out();
	echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($ckefn,\"$path\",'图片上传成功！');</script>";
	exit();
} else {
	Tool::alertBack('警告：由于非法操作导致上传失败！');
}
?>