<?php
$_user_location	= 'users';
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/hello_world/module.css'; // use a custom stylesheet
require (AT_INCLUDE_PATH.'header.inc.php');
?>

<form name="search" method="get" action="mods/hello_world/result_gen.php">
<table>
	<tr>
    	<td>
        	Search OpenLearn:
        </td>
        <td>
        	<input type="text" name="q" />
        </td>
        
	</tr>
    <tr>
    	<td colspan="2">
        	<input type="submit" value="Search" />
        </td>
    </tr>
</table>
</form>

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>