<?php
$_user_location	= 'users';
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/ol_search_open_learn/module.css'; // use a custom stylesheet
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
		$img = 
		   "<a href='".$row['cp']."'> 
            	<img src='mods/ol_search_open_learn/cp.png' 
			    alt='Download Content Package' title='Download Content Package' border='0' /> 
          	</a> 
          	<a href='".$row['cc']."'> 
            	<img src='mods/ol_search_open_learn/cc.png' 
				alt='Download Common Cartridge' title='Download Common Cartridge' border='0' /> 
          	</a>";
		echo "<br/>".$imgs."<br/><br/>";
    }
}
else {
    echo "No results found... for  <b>". $_GET['q'] ."</b><br/>";
}
?>
<?php
require (AT_INCLUDE_PATH.'footer.inc.php'); ?>