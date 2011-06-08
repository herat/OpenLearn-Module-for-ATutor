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

$start = intval(trim(strtolower($_GET['start'])));
$maxResults = intval(trim(strtolower($_GET['maxResults'])));

if ($maxResults == 0) $maxResults = 2;  // default

$rows = $obj->getSearchResult($_GET['q'],$start,$maxResults);
//echo count($rows)."<br/>";

$all_results = $obj->getSearchResult($_GET['q']);

if (is_array($all_results)) $total_num = count($all_results);
else $total_num = 0;

// calculate the last record number
if (is_array($rows))
{
	$num_of_results = count($rows);
	
	if ($maxResults > $num_of_results) $last_rec_number = $start + $num_of_results;
	else $last_rec_number = $start + $maxResults;
}
else $last_rec_number = $total_num;

if( is_array($rows) && count($rows) > 0) {
    $i=$start+1;
	echo "<div id='accordion' >";
    foreach( $rows as $row ) {
		
		echo "<h3>".$i.". <a href='#section". $i ."' > ".$row['title']." </a></h3>";
		
		/*if( strlen($row['description']) < 300 )
			echo $row['description']."<br/>";	
		else
        	echo substr($row['description'],0,300)."...<br/>"; */
		echo "<div>";
		
		
		echo "<p>".$row['description']."</p>";
		
			
        $i++;
		$imgs = 
		   "<a href='".$row['cp']."'> 
            	<img src='mods/ol_search_open_learn/cp.png' 
			    alt='Download Content Package' title='Download Content Package' border='0' /> 
          	</a> 
          	<a href='".$row['cc']."'> 
            	<img src='mods/ol_search_open_learn/cc.png' 
				alt='Download Common Cartridge' title='Download Common Cartridge' border='0' /> 
          	</a>";
			
		echo "<br/>".$imgs;
			
		echo "</div>";	
		
    }
	echo "</div>";
	
	if( $total_num > $last_rec_number )
	{
		echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$last_rec_number."'><img src='mods/ol_search_open_learn/next.gif' /> </a>";
	}
	if( $start > 0 )
	{
		$prev = $start-$maxResults;
		echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$prev."'><img src='mods/ol_search_open_learn/prev.gif' /></a>";
	}
	
}
else {
    echo "No results found... for ". $_GET['q'] ." <br/>";
}
?>
<?php
require (AT_INCLUDE_PATH.'footer.inc.php'); ?>

<script type="text/javascript" src="/ATutor/jscripts/infusion/lib/jquery/core/js/jquery.js"></script>
<script type="text/javascript" src="/ATutor/jscripts/infusion/lib/jquery/ui/js/ui.core.js"></script>
<script type="text/javascript" src="/ATutor/jscripts/infusion/lib/jquery/ui/js/ui.accordion.js"></script>        
<script type="text/javascript" src="/ATutor/jscripts/infusion/lib/jquery/ui/js/ui.slider.js"></script>  
<script>
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});
</script>

 