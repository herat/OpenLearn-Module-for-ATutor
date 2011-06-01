<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
admin_authenticate(AT_ADMIN_PRIV_HELLO_WORLD);
require (AT_INCLUDE_PATH.'header.inc.php');
?>
<form name="change_req" action="mods/ol_search_open_learn/change_admin.php" method="post">
    <table>
        <tr>
            <td>
                Current Repository URL:
            </td>
            <td>
                <?php

                echo $_config['ol_url'];

                ?>
            </td>
        </tr>
        <tr>
            <td>
                Current CRON interval:
            </td>
            <td>
                <?php

                global $db;
                $query = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name='ol_search_open_learn'";
                $res = mysql_query($query,$db);
                $tmp = '';
                $rows = mysql_fetch_assoc($res);
                echo $rows['cron_interval'];
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
</form>

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>


