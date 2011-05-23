<?php
$_user_location	= 'users';
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/hello_world/module.css'; // use a custom stylesheet
require (AT_INCLUDE_PATH.'header.inc.php');
?>	
<?php 
		echo $_GET['q'];
?>
<?php
require (AT_INCLUDE_PATH.'footer.inc.php'); ?>