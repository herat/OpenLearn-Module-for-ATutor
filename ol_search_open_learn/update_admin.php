<?php
/*
 * This php file is used for updating database. It will update database and
 * redirect admin back to his home page.
 */
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH . 'vitals.inc.php');

require('update.class.php');

$obj = new Update();
$obj->parse($_config['ol_last_updation'], trim($_config['ol_url']));

header('Location: index_admin.php');
?>