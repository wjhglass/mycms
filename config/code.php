<?php
require substr( dirname ( __FILE__ ), 0, -7) . '/init.inc.php';

$vc = new ValidateCode();
$vc->doImg();
$_SESSION['code'] = $vc->getCode();