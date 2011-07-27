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
	 //require('../../include/config.inc.php');
	 		
	function ol_search_open_learn_cron() {
		
		require('update_cron.class.php');
				
		//$db_handle = mysql_connect(DB_HOST.":".DB_PORT, DB_USER, DB_PASSWORD);
		//$db_found = mysql_select_db(DB_NAME, $db_handle);
		global $db;
		$db_handle = $db;
		//Create object of update class which is used for updating database
		$obj = new Update();
		
		$qry = "SELECT * FROM ".TABLE_PREFIX."config WHERE name='ol_last_updation'";
		$r1 = mysql_query($qry,$db_handle);
		$res1 = mysql_fetch_assoc($r1);
		
		$qry = "SELECT * FROM ".TABLE_PREFIX."config WHERE name='ol_url'";
		$r2 = mysql_query($qry,$db_handle);
		$res2 = mysql_fetch_assoc($r2);
				
		$obj->parse($res1['value'], $res2['value'],$db_handle,TABLE_PREFIX);
		
	}

?>
