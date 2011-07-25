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
	 * This php file contains all the configurations for the module.
	 */
	
	/* * *****
	 * doesn't allow this file to be loaded with a browser.
	 */
	if (!defined('AT_INCLUDE_PATH')) {
		exit;
	}
	
	/* * ****
	 * this file must only be included within a Module obj
	 */
	if (!isset($this) || (isset($this) && (strtolower(get_class($this)) != 'module'))) {
		exit(__FILE__ . ' is not a Module');
	}
	
	/* * *****
	 * assign the instructor and admin privileges to the constants.
	 */
	define('AT_PRIV_OL_SEARCH_OPEN_LEARN', $this->getPrivilege());
	define('AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN', $this->getAdminPrivilege());
	
	/* * *****
	 * create a side menu box/stack.
	 */
	$this->_stacks['ol_search_open_learn'] = array('title_var' => 'ol_search_open_learn', 'file' => 'mods/ol_search_open_learn/side_menu.inc.php');
		
	/* * *****
	 * create optional sublinks for module "detail view" on course home page
	 * 
	 */
	$this->_list['ol_search_open_learn'] = array('title_var' => 'ol_search_open_learn', 'file' => 'mods/ol_search_open_learn/sublinks.php');
	$this->_pages['mods/ol_search_open_learn/index.php']['icon'] = 'mods/ol_search_open_learn/bullet.gif';
	$this->_pages['mods/hol_search_open_learn/index.php']['img'] = 'mods/ol_search_open_learn/ol_logo.jpg';
	
	// ** possible alternative: **
	// the text to display on module "detail view" when sublinks are not available
	$this->_pages['mods/ol_search_open_learn/index.php']['text'] = _AT('ol_search_open_learn_text');
	
	/* * *****
	 * if this module is to be made available to students on the Home or Main Navigation.
	 */
	$_group_tool = $_student_tool = 'mods/ol_search_open_learn/index.php';
	
	/* * *****
	 * add the admin pages when needed.
	 */
	if (admin_authenticate(AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN, TRUE) || admin_authenticate(AT_ADMIN_PRIV_ADMIN, TRUE)) {
		$this->_pages[AT_NAV_ADMIN] = array('mods/ol_search_open_learn/index_admin.php');
	
	
		$this->_pages['mods/ol_search_open_learn/index_admin.php']['title_var'] = 'ol_search_open_learn';
		$this->_pages['mods/ol_search_open_learn/index_admin.php']['parent'] = AT_NAV_ADMIN;
	
		$this->_pages['mods/ol_search_open_learn/change_admin.php']['title_var'] = 'update_param';
		$this->_pages['mods/ol_search_open_learn/change_admin.php']['parent'] = AT_NAV_ADMIN;
	}
	
	/* * *****
	 * instructor Manage section:
	 */
	
	$_pages['mods/_core/content/index.php']['children'][] = 'mods/ol_search_open_learn/index_instructor.php';
	
	$this->_pages['mods/ol_search_open_learn/index_instructor.php']['title_var'] = 'ol_search_open_learn';
	$this->_pages['mods/ol_search_open_learn/index_instructor.php']['parent'] = 'mods/_core/content/index.php';
	
	$this->_pages['mods/ol_search_open_learn/result_instructor.php']['title_var'] = 'search_results';
	$this->_pages['mods/ol_search_open_learn/result_instructor.php']['parent'] = 'mods/_core/content/index.php';
	
	/* * *****
	 * student page.
	 */
	$this->_pages['mods/ol_search_open_learn/index.php']['title_var'] = 'ol_search_open_learn';
	$this->_pages['mods/ol_search_open_learn/index.php']['img'] = 'mods/ol_search_open_learn/ol_logo.jpg';
	
	/* my start page pages */
	$this->_pages[AT_NAV_START] = array('mods/ol_search_open_learn/index_mystart.php');
	/* $this->_pages['mods/ol_search_open_learn/index_mystart.php']['title_var'] = 'ol_search_open_learn';
	  $this->_pages['mods/ol_search_open_learn/index_mystart.php']['parent'] = AT_NAV_START; */
	
	$this->_pages['mods/ol_search_open_learn/result_gen.php']['title_var'] = 'search_results';
	$this->_pages['mods/ol_search_open_learn/result_gen.php']['parent'] = 'mods/ol_search_open_learn/index.php';
	
	$this->_content_tools[] = array("id" => "ol_search_open_learn_tool",
		"class" => "fl-col clickable",
		"src" => AT_BASE_HREF . "mods/ol_search_open_learn/ol_logo.jpg",
		"title" => _AT('ol_search_open_learn_tool'),
		"alt" => _AT('ol_search_open_learn_tool'),
		"text" => _AT('ol_search_open_learn'),
		"js" => AT_BASE_HREF . "mods/ol_search_open_learn/content_tool_action.js");
	
	
	function ol_search_open_learn_get_group_url($group_id) {
		return 'mods/ol_search_open_learn/index.php';
	}
?>
