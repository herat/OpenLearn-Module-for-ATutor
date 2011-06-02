<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
admin_authenticate(AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN);
require (AT_INCLUDE_PATH.'header.inc.php');
?>
<div class="admin_container" style="width: 25%;" >
	<ol id="tools">
    	<li class="child-tool">
        	<a href="mods/ol_search_open_learn/change_admin.php">Change configuration</a>
        </li>
    </ol>
	<ol id="tools">
    	<li class="child-tool">
        	<a href="mods/ol_search_open_learn/update_admin.php">Update Now</a>
        </li>
    </ol>
</div>
<br/>
<br/>
<div class="input-form" > 
    <div class="row">
                <h3>Current Configurations</h3>
    
                <dl class="col-list">
                        <dt>Repository URL:</dt>
                        <dd><?php echo $_config['ol_url']; ?></dd>
                </dl>
                <dl class="col-list">
                        <dt>Cron interval:</dt>
                        <dd>
                            <?php
                            global $db;
                            $query = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name='ol_search_open_learn'";
                            $res = mysql_query($query,$db);
                            $tmp = '';
                            $rows = mysql_fetch_assoc($res);
                            echo $rows['cron_interval']. '   ';
                            ?>minutes
                        </dd>
                </dl>
				<dl class="col-list">
                        <dt>Last updated:</dt>
                        <dd><?php echo $_config['ol_last_updation']; 
							//echo date('h:i:s');
						?>
						</dd>
                </dl>
    </div>	
</div>
<!--<form name="change_req" action="mods/ol_search_open_learn/change_admin.php" method="post">
    <table>
        <tr>
            <td>
                Current Repository URL:
            </td>
            <td>
                <?php

                /*echo $_config['ol_url'];*/

                ?>
            </td>
        </tr>
        <tr>
            <td>
                Current CRON interval:
            </td>
            <td>
                <?php

                /*global $db;
                $query = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name='ol_search_open_learn'";
                $res = mysql_query($query,$db);
                $tmp = '';
                $rows = mysql_fetch_assoc($res);
                echo $rows['cron_interval'];*/
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

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>


