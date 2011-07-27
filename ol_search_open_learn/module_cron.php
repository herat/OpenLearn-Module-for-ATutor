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
	
	/*******
	 * this function named [module_name]_cron is run by the global cron script at the module's specified
	 * interval.
	 */
	 ol_search_open_learn_cron();
		
	function ol_search_open_learn_cron() {
		//global $db;
		require('update_cron.class.php');
		require('../../include/config.inc.php');
    $user_name = DB_USER;
    $password = DB_PASSWORD;
    $database = DB_NAME;
    $server = DB_HOST;

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);
		//Create object of update class which is used for updating database
				
		
		$obj = new Update();
		
		$qry = "SELECT * FROM ".TABLE_PREFIX."config WHERE name='ol_last_updation'";
		$r1 = mysql_query($qry);
		$res1 = mysql_fetch_assoc($r1);
		echo $res1['value'];
		$qry = "SELECT * FROM ".TABLE_PREFIX."config WHERE name='ol_url'";
		$r2 = mysql_query($qry);
		$res2 = mysql_fetch_assoc($r2);
		echo $res2['value'];
		
		$obj->parse($res1['value'], $res2['value'],$db_handle,TABLE_PREFIX);
		
	}

?>
