<?php

/*define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN); */

echo $_FILES['file']['name']."<br/>";
echo $_FILES['file']['tmp_name']."<br/>";
echo $_FILES['file']['size']."<br/>";     
echo intval($_POST['cid']);
echo "<br/>".$_POST['submit']."<br/>";
echo $_POST['ignore_validation']."<br/>";
echo $_POST['allow_test_export']."<br/>";


?>
