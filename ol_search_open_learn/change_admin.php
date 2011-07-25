<?php
	/****************************************************************/
	/* OpenLearn module for ATutor                                  */
	/* http://atutoropenlearn.wordpress.com                         */
	/*                                                              */
	/* This module allows to search OpenLearn for educational       */
	/* content.														*/
	/* Author: Herat Gandhi											*/
	/* This program is free software. You can redistribute it and/or*/
	/* modify it under the terms of the GNU General Public License  */
	/* as published by the Free Software Foundation.				*/
	/****************************************************************/

	/**
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
	$url_r = trim($_POST['url']); //get repository URL 
	$cron_v = intval(trim($_POST['cron'])); //get CRON interval
	
	//if cron interval is negative or repository URL is blank then return
	//error and redirect to admin panel. 
	if($cron_v < 0){
		$msg->addError('OL_CRON_NOT_VAL');
		header('Location: index_admin.php');
	}
	else if(($cron_v != 0 && ($url_r == null || $url_r == "" )) || ($cron_v != 0 && !url_exist( $url_r ))){
		$msg->addError('OL_URL_NOT_VAL');
		header('Location: index_admin.php');
	}
	//if parameters are set correctly then update database
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
<?php
	/**
	 * Verify URL
	 * 
	 * This function verifies URL entered by Admin.
	 * @param string URL to be verified
	 * @return boolean FALSE for error
	 */ 
	function url_exist($url){
		$c=curl_init();
		curl_setopt($c,CURLOPT_URL,$url);
		curl_setopt($c,CURLOPT_HEADER,1);//get the header
		curl_setopt($c,CURLOPT_NOBODY,1);//and *only* get the header
		curl_setopt($c,CURLOPT_RETURNTRANSFER,1);//get the response as a string from curl_exec(), rather than echoing it
		curl_setopt($c,CURLOPT_FRESH_CONNECT,1);//don't use a cached version of the url
		if(!curl_exec($c)){
			//echo $url.' inexists';
			//return false;
		}else{
			//echo $url.' exists';
			//return true;
		}
		$httpcode=curl_getinfo($c,CURLINFO_HTTP_CODE);
		return ($httpcode<400);
	}
?>
