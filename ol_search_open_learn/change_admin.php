<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
admin_authenticate(AT_ADMIN_PRIV_OL_SEARCH_OPEN_LEARN);
require (AT_INCLUDE_PATH.'header.inc.php');
?>

<?php

if(isset ($_POST['submit'])) {
    global $db;
    $qry= "UPDATE ".TABLE_PREFIX."config SET value='". $_POST['url'] ."' WHERE name='ol_url'";
    mysql_query($qry,$db);
    $qry= "UPDATE ".TABLE_PREFIX."modules SET cron_interval=".$_POST['cron']." WHERE dir_name='ol_search_open_learn'";
    mysql_query($qry,$db);
    header('Location: index_admin.php');
}

?>

<form name="change" action="mods/ol_search_open_learn/change_admin.php" method="post">
    <table>
        <tr>
            <td>
                Repository URL:
            </td>
            <td>
                <input type="text" name="url" value="<?php echo $_config['ol_url']; ?>" />
            </td>
        </tr>
        <tr>
            <td>
                CRON interval:
            </td>
            <td>
<?php

                global $db;
                $query = "SELECT * FROM ".TABLE_PREFIX."modules WHERE dir_name='ol_search_open_learn'";
                $res = mysql_query($query,$db);
                $tmp = '';
                $rows = mysql_fetch_assoc($res);

                ?>
                <input type="text" name="cron" value="<?php echo $rows['cron_interval']; ?>" />
				minutes
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" value="Change"/>
            </td>
        </tr>
    </table>
</form>
<?php
require (AT_INCLUDE_PATH.'footer.inc.php');
?>