/**
 * This javascript is to perform the functionalities that are required to implement
 * the add-on content tool. 
 * 
 * Register this javascript @ module.php => $this->_content_tools["js"] 
 */

/*global jQuery*/
/*global ATutor */
/*global tinyMCE */
/*global window */

ATutor = ATutor || {};
ATutor.mods = ATutor.mods || {};
ATutor.mods.ol_search_open_learn = ATutor.mods.ol_search_open_learn || {};

(function () {
    var olsearchopenlearnOnClick = function () {
    	alert("Clicked on hello world tool icon!");
    }
    
	//set up click handlers and show/hide appropriate tools
    var initialize = function () {
        jQuery("#helloworld_tool").click(olsearchopenlearnOnClick);
    };
    
    jQuery(document).ready(initialize);
})();