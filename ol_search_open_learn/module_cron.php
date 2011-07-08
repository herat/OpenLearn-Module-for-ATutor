<?php
/*******
 * this function named [module_name]_cron is run by the global cron script at the module's specified
 * interval.
 */
 require('update.class.php');

function ol_search_open_learn_cron() {
    global $db;

    //debug('yay i am running!');

	$obj = new Update();
	$obj->parse($_config['ol_last_updation'],trim($_config['ol_url']));
}

?>