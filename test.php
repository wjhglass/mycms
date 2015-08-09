<?php
header ( "Content-type: text/html; charset=utf-8" );
require 'init.inc.php';
require 'include/ValidateCode.class.php';

$vc = new ValidateCode();
$vc->doImg();