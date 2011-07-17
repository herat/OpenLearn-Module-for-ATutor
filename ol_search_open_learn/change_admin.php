<?php
	/*
	 * This php file is backend code needed for admin panel.
	 * It is used for changing module settings by admin.
	 */
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	admin_authenticate(AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN);
	require (AT_INCLUDE_PATH . 'header.inc.php');
	
	//Include message class for providing feedback to the admin.
	require_once(AT_INCLUDE_PATH . '/classes/Message/Message.class.php');
	global $savant;
	$msg = new Message($savant);
?>

<?php

	if (isset($_POST['submit'])) {
		global $db;
		//Updtae URL and cron interval of module
		$qry = "UPDATE " . TABLE_PREFIX . "config SET value='" .
		trim($_POST['url']) . "' WHERE name='ol_url'";
	
		mysql_query($qry, $db);
	
		$qry = "UPDATE " . TABLE_PREFIX . "modules SET cron_interval=" . trim($_POST['cron']) .
		" WHERE dir_name='ol_search_open_learn'";
	
		mysql_query($qry, $db);
	
		$msg->addFeedback('SETTINGS_CHANGED');
		//Redirect back to the form
		header('Location: index_admin.php');
	}
?>


<?php

	require (AT_INCLUDE_PATH . 'footer.inc.php');
?>