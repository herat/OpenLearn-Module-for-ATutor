<?php
	/*
	 * This php file is backend code needed for admin panel.
	 * It is used for changing module settings by admin.
	 */
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	admin_authenticate(AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN);
	
	//Include message class for providing feedback to the admin.
	require_once(AT_INCLUDE_PATH . '/classes/Message/Message.class.php');
	global $savant;
	$msg = new Message($savant);
?>

<?php
	$url_r = trim($_POST['url']);
	$cron_v = intval(trim($_POST['cron']));
	
	if($cron_v < 0 || $url_r == null || $url_r == "" ){
		$msg->addError('OL_DB_NOT_UPDATED');
		header('Location: index_admin.php');
	}
	/*else if($cron_v != 0 && ($url_r == null || $url_r == "" )){
		$msg->addError('OL_DB_NOT_UPDATED');
		header('Location: index_admin.php');
	}*/
	else if (isset($_POST['submit'])) {
		global $db;
		//Updtae URL and cron interval of module
		$qry = "UPDATE " . TABLE_PREFIX . "config SET value='" . $url_r . "' WHERE name='ol_url'";
	
		mysql_query($qry, $db);
	
		$qry = "UPDATE " . TABLE_PREFIX . "modules SET cron_interval=" . $cron_v . " WHERE dir_name='ol_search_open_learn'";
	
		mysql_query($qry, $db);
	
		$msg->addFeedback('SETTINGS_CHANGED');
		//Redirect back to the form
		header('Location: index_admin.php');
	}
?>

