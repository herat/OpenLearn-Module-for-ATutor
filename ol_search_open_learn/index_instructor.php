<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN);
require (AT_INCLUDE_PATH.'header.inc.php');
?>
<form name="search" method="get" action="mods/ol_search_open_learn/result_instructor.php">
    <table>
        <tr>
            <td>
        	<?php echo _AT('ol_search_open_learn'); ?>:
            </td>
            <td>
                <input type="text" name="q" />
            </td>

        </tr>
        <tr>
          <td>
          <?php echo _AT('ol_bool'); ?>:
          </td>
          <td>
          <input type="radio" name="b" id="bool" value="1" /><?php echo _AT('ol_or'); ?>
          <input type="radio" name="b" id="bool" value="2" checked="checked" /><?php echo _AT('ol_and'); ?>
          </td>
        </tr>
         <tr>
        	<td>
            <?php echo _AT('ol_order'); ?>:
            </td>
            <td>
            	<select name="orderby" id="orderby" >
                    <option value="1" <?php if($orderby==1) echo "selected='selected'" ?>>DEFAULT</option>
                    <option value="2" <?php if($orderby==2) echo "selected='selected'" ?>>TITLE ASC</option>
                    <option value="3" <?php if($orderby==3) echo "selected='selected'" ?>>TITLE DESC</option>
                    <option value="4" <?php if($orderby==4) echo "selected='selected'" ?>>DATE ASC</option>
                    <option value="5" <?php if($orderby==5) echo "selected='selected'" ?>>DATE DESC</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Search" />
            </td>
        </tr>
    </table>
</form>
<?php

require (AT_INCLUDE_PATH.'footer.inc.php'); ?>