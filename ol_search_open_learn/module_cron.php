<?php
/*******
 * this function named [module_name]_cron is run by the global cron script at the module's specified
 * interval.
 */
 require('update.class.php');


function ol_search_open_learn_cron() {
    global $db;

    //debug('yay i am running!');

	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH.'vitals.inc.php');

	$obj = new Update();
	$obj->parse($_config['ol_last_updation']);
}

?>