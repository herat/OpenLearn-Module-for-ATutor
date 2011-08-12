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
	 * This php file is used for updating database. It will update database and
	 * redirect admin back to his home page.
	 */
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	
	require('update.class.php');
	//Update database using Update class
	$obj = new Update();
	$obj->parse($_config['ol_last_updation'], trim($_config['ol_url']), $_config['ol_base_url']);
	//redirect to previous page
	header('Location: index_admin.php');
?>
