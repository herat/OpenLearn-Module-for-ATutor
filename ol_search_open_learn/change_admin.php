<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
admin_authenticate(AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN);
require (AT_INCLUDE_PATH.'header.inc.php');

require_once(AT_INCLUDE_PATH . '/classes/Message/Message.class.php');
global $savant;
$msg = new Message($savant); 	
?>

<?php

if(isset ($_POST['submit'])) {
    global $db;
    $qry= "UPDATE ".TABLE_PREFIX."config SET value='". $_POST['url'] ."' WHERE name='ol_url'";
    mysql_query($qry,$db);
    $qry= "UPDATE ".TABLE_PREFIX."modules SET cron_interval=".$_POST['cron']." WHERE dir_name='ol_search_open_learn'";
    mysql_query($qry,$db);
	$msg->addFeedback('SETTINGS_CHANGED');
    header('Location: index_admin.php');
}

?>


<?php
require (AT_INCLUDE_PATH.'footer.inc.php');
?>