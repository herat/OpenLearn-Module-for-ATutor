<?php
	/*
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
<div class="admin_container" style="width: 25%;" >
   <ol id="tools">
        <li class="child-tool">
            <a href="mods/ol_search_open_learn/update_admin.php"><?php echo _AT('ol_update'); ?></a>
        </li>
    </ol>
    <ol id="tools">
        <li class="child-tool">
            <?php echo _AT('ol_last_update'); ?>:
            <?php echo $_config['ol_last_updation']; ?>
        </li>
    </ol>
</div>
<br/>
<br/>
<div class="input-form" > 
	<form name="change" action="mods/ol_search_open_learn/change_admin.php" method="post">
    	<table>
        	<tr>
                <td>
                    <?php echo _AT('ol_repo_url'); ?>:
                </td>
                <td>
                    <input type="text" name="url" size="150" value="<?php echo $_config['ol_url']; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo _AT('ol_cron_interval'); ?>:
                </td>
                <td>
                    <?php
						global $db;
						$query = "SELECT * FROM " . TABLE_PREFIX . "modules WHERE dir_name='ol_search_open_learn'";
						$res = mysql_query($query, $db);
						$tmp = '';
						$rows = mysql_fetch_assoc($res);
                    ?>
                    <input type="text" name="cron" value="<?php echo $rows['cron_interval']; ?>" />
                    <?php echo _AT('ol_min'); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="<?php echo _AT('ol_change'); ?>"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php require (AT_INCLUDE_PATH . 'footer.inc.php'); ?>


