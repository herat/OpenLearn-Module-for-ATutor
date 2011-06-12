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

$maxResults = intval(trim(strtolower($_GET['maxResults'])));
$maxResults1 = intval(trim(strtolower($_GET['maxResults'])));

?>

Maximum Records: 
<select name="maxResults" id="maxResults" onchange="changeMax()" >
	<option value="5" <?php if($maxResults==5) echo "selected='selected'" ?>>5</option>
    <option value="10" <?php if($maxResults==10) echo "selected='selected'" ?>>10</option>
    <option value="25" <?php if($maxResults==25) echo "selected='selected'" ?>>25</option>
</select>

<?php

$start = intval(trim(strtolower($_GET['start'])));
//$maxResults = intval(trim(strtolower($_GET['maxResults'])));

if ($maxResults == 0) $maxResults = 5;  // default

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
	echo "<div id='accordion'>";
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
		
		//$prevw = "";	
		$prevw = "<a href=\"".$row['website']."\" title=\"".$row['title']."\" rel=\"gb_page_fs[]\">Preview on OL</a>";
			
		echo "<br/>".$imgs.$prevw;
			
		echo "</div>";	
		
    }
	echo "</div>";
	
	if( $start > 0 )
	{
		$prev = $start-$maxResults;
		if( $maxResults1 != 0)
		{
			echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$prev."&maxResults=".$_GET['maxResults']."'><img src='mods/ol_search_open_learn/prev.gif' /></a>&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		else
		{
			echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$prev."'><img src='mods/ol_search_open_learn/prev.gif' /></a>&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	}
	if( $total_num > $last_rec_number )
	{
		if( $maxResults1 != 0)
		{
			echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$last_rec_number."&maxResults=".$_GET['maxResults']."'><img src='mods/ol_search_open_learn/next.gif' /> </a>";
		}
		else
		{
			echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$last_rec_number."'><img src='mods/ol_search_open_learn/next.gif' /> </a>";
		}
	}
	
	
}
else {
    echo "No results found... for ". $_GET['q'] ." <br/>";
}
?>
<?php
require (AT_INCLUDE_PATH.'footer.inc.php'); ?>

<script type="text/javascript">
    var GB_ROOT_DIR = "mods/ol_search_open_learn/greybox/";
</script>
<script type="text/javascript" src="mods/ol_search_open_learn/greybox/AJS.js"></script>

<script type="text/javascript" src="mods/ol_search_open_learn/greybox/gb_scripts.js"></script>
<link href="mods/ol_search_open_learn/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="mods/ol_search_open_learn/greybox/AJS_fx.js"></script>
 

<script type="text/javascript" src="jscripts/infusion/lib/jquery/core/js/jquery.js"></script>
<script type="text/javascript" src="jscripts/infusion/lib/jquery/ui/js/ui.core.js"></script>
<script type="text/javascript" src="jscripts/infusion/lib/jquery/ui/js/ui.accordion.js"></script>        
<script type="text/javascript" src="jscripts/infusion/lib/jquery/ui/js/ui.slider.js"></script>  
<script>
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});		
	
	function changeMax()
	{
		var e = document.getElementById("maxResults");
		var ele= e.options[e.selectedIndex].value;
		
		window.location = "<?php echo $_SERVER[PHP_SELF]."?q=".$_GET['q']."&maxResults="; ?>"+ele;
 		
	}
</script>
