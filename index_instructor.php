<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
authenticate(AT_PRIV_HELLO_WORLD);
require (AT_INCLUDE_PATH.'header.inc.php');
?>
<form name="search" method="post" action="">
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
<?php

if( isset($_POST['q']) )
{
		echo $_POST['q'];
		$_POST['q']='';
}
require (AT_INCLUDE_PATH.'footer.inc.php'); ?>