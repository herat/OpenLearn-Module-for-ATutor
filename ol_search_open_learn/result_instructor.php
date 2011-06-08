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
	echo "<form name=\"form1\" method=\"post\" action=\"mods/_core/imscp/ims_import.php\" enctype=\"multipart/form-data\" onsubmit=\"openWindow('". AT_BASE_HREF . "tools/prog.php');\">";
    foreach( $rows as $row ) {
		$importbutton= "<input type=\"submit\" name=\"submit\" onclick=\"setClickSource('submit');\" value='import' />";
		echo "<input type=\"hidden\" name=\"url\" id=\"to_url\" value='". $row['cc'] ."' />";
		echo "<input type=\"hidden\" name=\"allow_test_export\" value='1' />";
        echo $i.". <b><a href='".$row['website']."' target='_new' > ".$row['title']." </a></b>". $importbutton ."<br/>";
		
		if( strlen($row['description']) < 300 )
			echo $row['description']."<br/>";	
		else
        	echo substr($row['description'],0,300)."...<br/>";
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
		echo "<br/>".$imgs."<br/><br/>";
    }
	echo "</form>";
}
else {
    echo "No results found... for  <b>". $_GET['q'] ."</b><br/>";
}
?>

<?php
require (AT_INCLUDE_PATH.'footer.inc.php'); ?>

<script language="javascript" type="text/javascript">

var but_src;
function setClickSource(name) {
	but_src = name;
}

function openWindow(page) {
	if (but_src != "cancel") {
		newWindow = window.open(page, "progWin", "width=400,height=200,toolbar=no,location=no");
		newWindow.focus();
	}
}

//Change form action 
function changeFormAction(type){
	var obj = document.exportForm;
	if (type=="cc"){
		obj.action = "mods/_core/imscc/ims_export.php";
	} else if (type=="cp"){
		obj.action = "mods/_core/imscp/ims_export.php";
	}
}

</script>