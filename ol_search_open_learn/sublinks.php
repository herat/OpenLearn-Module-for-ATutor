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
	 * This file fills the box created for course on homepage of course.
	 */
	if (!defined('AT_INCLUDE_PATH')) { exit; }
	
	/*****
	* Free form PHP can appear here to retreive current information
	* from the module, or a text description of the module where there is
	* not current information
	*****/
	
	//global $db;
	
	//$link_limit = 3;		// Number of links to be displayed on "detail view" box
	
	$list[0] = _AT('ol_mod_def');
	/*$list[] = ' <form id="search_ol1" name="search_ol1" method="get" action="../mods/ol_search_open_learn/result_gen.php">
	<input type="text" name="q" id="key" />
	<br/>
	<br/>
	<input type="submit" value="'. _AT('ol_search_btn') .'" class="button" />
	</form> ';*/
	return $list;
	
	/*$sql = "SELECT id, value FROM ".TABLE_PREFIX."OL_SEARCH_OPEN_LEARN WHERE course_id=".$_SESSION[course_id].
		   " ORDER BY value LIMIT $link_limit";
	$result = mysql_query($sql, $db);
	
	if (mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_assoc($result)) {
			/****
			* SUBLINK_TEXT_LEN, VALIDATE_LENGTH_FOR_DISPLAY are defined in include/lib/constance.lib.inc
			* SUBLINK_TEXT_LEN determins the maxium length of the string to be displayed on "detail view" box.
			****
			$list[] = '<a href="'.AT_BASE_HREF.url_rewrite('mods/ol_search_open_learn/index.php?id='. $row['hello_world_id']).'"'.
					  (strlen($row['value']) > SUBLINK_TEXT_LEN ? ' title="'.$row['value'].'"' : '') .'>'. 
					  validate_length($row['value'], SUBLINK_TEXT_LEN, VALIDATE_LENGTH_FOR_DISPLAY) .'</a>';
		}
		return $list;	
	} else {
		return 0;
	}*/

?>
