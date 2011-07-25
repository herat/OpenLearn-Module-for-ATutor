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
	 * This file extends the content string manipulation. 
	 * It affects the output of course content and news content at course home page.
	 * Input parameter: global variable $_input. This variable contains the input 
	 * content/news string.
	 * Output: $_input. Please make sure to assign the manipulated string back to $_input.
	 */
	
	/*******
	 * Global input string. DO NOT CHANGE.
	 */
	global $_input;
	
	/*******
	 * Example, replace special tag "[black][/black]" with html
	 */
	$_input = str_replace('[black]','<span style="color: black;">',$_input);
	$_input = str_replace('[/black]','</span>',$_input);

?>