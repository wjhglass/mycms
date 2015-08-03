<?php
require substr ( dirname ( __FILE__ ), 0, - 6 ) . '/init.inc.php';
require ROOT_PATH . '/model/Manage.class.php';

global $tmp;

new Manage ($tmp);
