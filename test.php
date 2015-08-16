<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/config.js"></script>
<script type="text/javascript">
<!--
CKEDITOR.config.skin='kama'
//-->
</script>
<form method="post">
	<textarea id="ta1" class="ckeditor" name="content">
		
	</textarea>
	<input type="submit" value="提交" />
</form>
<?php
header ( "Content-type: text/html; charset=utf-8" );
echo md5('111111').'<br />';
echo $_POST['content'].'<br />';
