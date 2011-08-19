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
	 * This php file presents basic UI shown to the admin.
	 * Using this panel admin can change cron interval of module and URL
	 * of OpenLearn's repository. Admin can also update his database.
	 */
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	admin_authenticate(AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN);
	require (AT_INCLUDE_PATH . 'header.inc.php');
	
	//Print feedbacks from other pages.
	require_once(AT_INCLUDE_PATH . '/classes/Message/Message.class.php');
	global $savant;
	$msg = new Message($savant);
	
	$msg->printFeedbacks();
?>
<div class="input-form">
	<p>
    	<?php 
			//display instructions to admin
			echo _AT('ol_admin_main');
		?>
    </p>
	<ul>
    	<li>
        	<?php 
				echo _AT('ol_admin_lpanel');
			?>
        </li>
        <li>
        	<?php 
				echo _AT('ol_admin_rpanel');
			?>
        </li>
    </ul>
</div>
<div class="container" style="width: 50%;  float: left;"> 
    <div class="input-form">
           <div class="row">
				<?php echo _AT('ol_last_update'); ?>:
                <?php echo $_config['ol_last_updation']; echo "  "._AT('ol_at'); ?>
                <?php echo AT_date(_AT('server_date_format'), $_config['ol_last_time'], AT_DATE_UNIX_TIMESTAMP); ?>
            </div>
            <div class="row">
                <form name="updateoldb" action="mods/ol_search_open_learn/update_admin.php" method="get">
                    <input type="submit" value="<?php echo _AT('ol_update'); ?>" name="updatereq" class="button"/>
                </form>
                    <!--<a href=""><?php //echo _AT('ol_update'); ?></a> -->
            </div>
     </div>
</div>
<div class="container" style="width: 50%; float: right;"> 
    <div class="input-form"> 
        <form name="changeadminsett" action="mods/ol_search_open_learn/change_admin.php" method="post">
            <div class="row">
                  <label for="form_url"><?php echo _AT('ol_repo_url'); ?>:</label>
                  <input size="60" id="form_url" type="text" name="url" value="<?php echo $_config['ol_url']; ?>" />
            </div>
            <div class="row">
                  <label for="form_cron"><?php echo _AT('ol_cron_interval'); ?>:</label>
                  <?php
					  global $db;
					  $query = "SELECT * FROM " . TABLE_PREFIX . "modules WHERE dir_name='ol_search_open_learn'";
					  $res = mysql_query($query, $db);
					  $tmp = '';
					  $rows = mysql_fetch_assoc($res);
                   ?>
                   <input size="10" type="text" id="form_cron" name="cron" value="<?php echo $rows['cron_interval']; ?>" />
                   <?php echo _AT('ol_min'); ?>
            </div>  
            <div class="row">
            	<input type="submit" class="button" name="submit" value="<?php echo _AT('ol_save'); ?>"/>
            </div>    
        </form>
    </div>
</div>
<?php require (AT_INCLUDE_PATH . 'footer.inc.php'); ?>


