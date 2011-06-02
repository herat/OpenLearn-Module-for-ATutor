<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN);
require (AT_INCLUDE_PATH.'header.inc.php');

require ('search.class.php');

$obj = new Search();
?>	
<?php 
$rows = $obj->getSearchResult($_GET['q']);
//echo count($rows)."<br/>";
if( is_array($rows) && count($rows) > 0) {
    $i=1;
    foreach( $rows as $row ) {
        echo $i.". <b><a href='".$row['website']."' target='_new' > ".$row['title']." </a></b><br/>";
		
		if( strlen($row['description']) < 300 )
			echo $row['description']."<br/>";	
		else
        	echo substr($row['description'],0,300)."...<br/>";
        $i++;
		echo "<br/><br/>";
    }
}
else {
    echo "No results found... for  <b>". $_GET['q'] ."</b><br/>";
}
?>
<?php
require (AT_INCLUDE_PATH.'footer.inc.php'); ?>