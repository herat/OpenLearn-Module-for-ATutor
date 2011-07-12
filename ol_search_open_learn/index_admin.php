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
    <!--<ol id="tools">
    	<li class="child-tool">
        	<a href="mods/ol_search_open_learn/change_admin.php">Change configuration</a>
    </li>
</ol>-->
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
    <!--<div class="row">
                <h3>Current Configurations</h3>

                <dl class="col-list">
                        <dt>Repository URL:</dt>
                        <dd><?php //echo $_config['ol_url'];   ?></dd>
                </dl>
                <dl class="col-list">
                        <dt>Cron interval:</dt>
                        <dd>
    <?php
            /* global $db;
              $query = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name='ol_search_open_learn'";
              $res = mysql_query($query,$db);
              $tmp = '';
              $rows = mysql_fetch_assoc($res);
              echo $rows['cron_interval']. '   '; */
    ?>minutes
                                        </dd>
                                </dl>
                				<dl class="col-list">
                                        <dt>Last updated:</dt>
                                        <dd><?php
            //echo $_config['ol_last_updation'];
            //echo date('h:i:s');
    ?>
                						</dd>
                                </dl>
                    </div>-->
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
<!--<form name="change_req" action="mods/ol_search_open_learn/change_admin.php" method="post">
    <table>
        <tr>
            <td>
                Current Repository URL:
            </td>
            <td>
<?php
                    /* echo $_config['ol_url']; */
?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Current CRON interval:
                                                    </td>
                                                    <td>
<?php
                    /* global $db;
                      $query = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name='ol_search_open_learn'";
                      $res = mysql_query($query,$db);
                      $tmp = '';
                      $rows = mysql_fetch_assoc($res);
                      echo $rows['cron_interval']; */
?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <input type="submit" name="button1" value="Change"/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form> -->

<?php require (AT_INCLUDE_PATH . 'footer.inc.php'); ?>


