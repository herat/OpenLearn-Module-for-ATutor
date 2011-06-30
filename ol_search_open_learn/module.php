<?php
/*******
 * doesn't allow this file to be loaded with a browser.
 */
if (!defined('AT_INCLUDE_PATH')) {
    exit;
}

/******
 * this file must only be included within a Module obj
 */
if (!isset($this) || (isset($this) && (strtolower(get_class($this)) != 'module'))) {
    exit(__FILE__ . ' is not a Module');
}

/*******
 * assign the instructor and admin privileges to the constants.
 */
define('AT_PRIV_OL_SEARCH_OPEN_LEARN',       $this->getPrivilege());
define('AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN', $this->getAdminPrivilege());

/*******
 * create a side menu box/stack.
 */
$this->_stacks['ol_search_open_learn'] = array('title_var'=>'ol_search_open_learn', 'file'=>'mods/ol_search_open_learn/side_menu.inc.php');
// ** possible alternative: **
// $this->addStack('hello_world', array('title_var' => 'hello_world', 'file' => './side_menu.inc.php');

/*******
 * create optional sublinks for module "detail view" on course home page
 * when this line is uncommented, "mods/hello_world/sublinks.php" need to be created to return an array of content to be displayed
 */
$this->_list['ol_search_open_learn'] = array('title_var'=>'ol_search_open_learn','file'=>'mods/ol_search_open_learn/sublinks.php');

// Uncomment for tiny list bullet icon for module sublinks "icon view" on course home page
$this->_pages['mods/ol_search_open_learn/index.php']['icon']      = 'mods/ol_search_open_learn/hello_world.jpg';

// Uncomment for big icon for module sublinks "detail view" on course home page
$this->_pages['mods/hol_search_open_learn/index.php']['img']      = 'mods/ol_search_open_learn/hello_world.jpg';

// ** possible alternative: **
// the text to display on module "detail view" when sublinks are not available
$this->_pages['mods/ol_search_open_learn/index.php']['text']      = _AT('ol_search_open_learn_text');

/*******
 * if this module is to be made available to students on the Home or Main Navigation.
 */
$_group_tool = $_student_tool = 'mods/ol_search_open_learn/index.php';

/*******
 * add the admin pages when needed.
 */
if (admin_authenticate(AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN, TRUE) || admin_authenticate(AT_ADMIN_PRIV_ADMIN, TRUE)) {
    $this->_pages[AT_NAV_ADMIN] = array('mods/ol_search_open_learn/index_admin.php');
	
	
    $this->_pages['mods/ol_search_open_learn/index_admin.php']['title_var'] = 'ol_search_open_learn';
    $this->_pages['mods/ol_search_open_learn/index_admin.php']['parent']    = AT_NAV_ADMIN;

	$this->_pages['mods/ol_search_open_learn/change_admin.php']['title_var'] = 'update_param';
    $this->_pages['mods/ol_search_open_learn/change_admin.php']['parent']    = AT_NAV_ADMIN;
}

/*******
 * instructor Manage section:
 */
 
$_pages['mods/_core/content/index.php']['children'][]  = 'mods/ol_search_open_learn/index_instructor.php';
 
$this->_pages['mods/ol_search_open_learn/index_instructor.php']['title_var'] = 'ol_search_open_learn';
$this->_pages['mods/ol_search_open_learn/index_instructor.php']['parent']   = 'mods/_core/content/index.php';

$this->_pages['mods/ol_search_open_learn/result_instructor.php']['title_var'] = 'search_results';
$this->_pages['mods/ol_search_open_learn/result_instructor.php']['parent']   = 'mods/_core/content/index.php';

// ** possible alternative: **
// $this->pages['./index_instructor.php']['title_var'] = 'hello_world';
// $this->pages['./index_instructor.php']['parent']    = 'tools/index.php';

/*******
 * student page.
 */
$this->_pages['mods/ol_search_open_learn/index.php']['title_var'] = 'ol_search_open_learn';
$this->_pages['mods/ol_search_open_learn/index.php']['img']       = 'mods/ol_search_open_learn/hello_world.jpg';

/* public pages 
$this->_pages[AT_NAV_PUBLIC] = array('mods/hello_world/index_public.php');
$this->_pages['mods/hello_world/index_public.php']['title_var'] = 'ol_search_open_learn';
$this->_pages['mods/hello_world/index_public.php']['parent'] = AT_NAV_PUBLIC;*/

/* my start page pages */
$this->_pages[AT_NAV_START]  = array('mods/ol_search_open_learn/index_mystart.php');
/*$this->_pages['mods/ol_search_open_learn/index_mystart.php']['title_var'] = 'ol_search_open_learn';
$this->_pages['mods/ol_search_open_learn/index_mystart.php']['parent'] = AT_NAV_START;*/

$this->_pages['mods/ol_search_open_learn/result_gen.php']['title_var'] = 'search_results';
$this->_pages['mods/ol_search_open_learn/result_gen.php']['parent'] = 'mods/ol_search_open_learn/index.php';


/*******
 * Use the following array to define a tool to be added to the Content Editor's icon toolbar. 
 * id = a unique identifier to be referenced by javascript or css, prefix with the module name
 * class = reference to a css class in the module.css or the primary theme styles.css to style the tool icon etc
 * src = the src attribute for an HTML img element, referring to the icon to be embedded in the Content Editor toolbar
 * title = reference to a language token rendered as an HTML img title attribute
 * alt = reference to a language token rendered as an HTML img alt attribute
 * text = reference to a language token rendered as the text of a link that appears below the tool icon
 * js = reference to the script that provides the tool's functionality
 */

$this->_content_tools[] = array("id"=>"ol_search_open_learn_tool", 
        "class"=>"fl-col clickable",
        "src"=>AT_BASE_HREF."mods/ol_search_open_learn/hello_world.jpg",
        "title"=>_AT('ol_search_open_learn_tool'),
        "alt"=>_AT('ol_search_open_learn_tool'),
        "text"=>_AT('ol_search_open_learn'),
        "js"=>AT_BASE_HREF."mods/ol_search_open_learn/content_tool_action.js");

/*******
 * Register the entry of the callback class. Make sure the class name is properly namespaced, 
 * for instance, prefixed with the module name, to enforce its uniqueness.
 * This class must be defined in "ModuleCallbacks.class.php".
 * This class is an API that contains the static methods to act on core functions.
 */
$this->_callbacks['ol_search_open_learn'] = 'SearchOpenLearnCallbacks';

function ol_search_open_learn_get_group_url($group_id) {
    return 'mods/ol_search_open_learn/index.php';
}
?>