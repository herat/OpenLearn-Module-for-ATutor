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
	 require('update.class.php');
	
	function ol_search_open_learn_cron() {
		global $db;
		//Create object of update class which is used for updating database
		$obj = new Update();
		$obj->parse($_config['ol_last_updation'],trim($_config['ol_url']));
	}

?>