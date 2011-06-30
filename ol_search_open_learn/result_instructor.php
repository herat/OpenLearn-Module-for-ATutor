<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN);
require (AT_INCLUDE_PATH.'header.inc.php');

require ('search.class.php');

$obj = new Search();
?>

<?php

$maxResults = intval(trim(strtolower($_GET['maxResults'])));
$maxResults1 = intval(trim(strtolower($_GET['maxResults'])));
$start = intval(trim(strtolower($_GET['start'])));
?>

<form name="search" method="get" action="mods/ol_search_open_learn/result_instructor.php">
    <?php
    if( $maxResults1 != 0 ) {
        echo "<input name='maxResults' type='hidden' value='".$_GET['maxResults']."'/>";
    }
    ?>
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
            <td colspan="2">
                <input type="submit" value="Search" />
            </td>
        </tr>
    </table>
</form>
<br/>
<?php echo _AT('ol_max_reco');?>: 
<form name="max" method="get" action="<?php $maxUrl = $_SERVER[PHP_SELF];
echo $maxUrl; ?>" >
    <input type="hidden" value="<?php echo $_GET['q'];?>" name="q" />
    <select name="maxResults" id="maxResults">
        <option value="5" <?php if($maxResults==5) echo "selected='selected'" ?>>5</option>
        <option value="10" <?php if($maxResults==10) echo "selected='selected'" ?>>10</option>
        <option value="25" <?php if($maxResults==25) echo "selected='selected'" ?>>25</option>
    </select>
    <input type="submit" value="Change" />
</form>
<br/>

<?php 


//$maxResults = intval(trim(strtolower($_GET['maxResults'])));

if ($maxResults == 0) $maxResults = 5;  // default

$rows = $obj->getSearchResult($_GET['q'],$start,$maxResults);
//echo count($rows)."<br/>";

$all_results = $obj->getSearchResult($_GET['q']);

if (is_array($all_results)) $total_num = count($all_results);
else $total_num = 0;

// calculate the last record number
if (is_array($rows)) {
    $num_of_results = count($rows);

    if ($maxResults > $num_of_results) $last_rec_number = $start + $num_of_results;
    else $last_rec_number = $start + $maxResults;
}
else $last_rec_number = $total_num;

if( $start > 0 ) {
    $prev = $start-$maxResults;
    if( $maxResults1 != 0) {
        echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$prev."&maxResults=".$_GET['maxResults']."'><img src='mods/ol_search_open_learn/prev.gif' alt='Previous' /></a>&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    else {
        echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$prev."'><img src='mods/ol_search_open_learn/prev.gif' alt='Previous' /></a>&nbsp;&nbsp;&nbsp;&nbsp;";
    }
}
if( $total_num > $last_rec_number ) {
    if( $maxResults1 != 0) {
        echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$last_rec_number."&maxResults=".$_GET['maxResults']."'><img src='mods/ol_search_open_learn/next.gif' alt='Next' /> </a>";
    }
    else {
        echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$last_rec_number."'><img src='mods/ol_search_open_learn/next.gif' alt='Next' /> </a>";
    }
}

if( is_array($rows) && count($rows) > 0) {
    $i=$start+1;

    echo "<dl id='accordion'>";

    foreach( $rows as $row ) {

        $curr_url = $_SERVER[PHP_SELF];
        $curr_url .= "?q=".$_GET['q'];
        if( $maxResults1 > 0 ) {
            $curr_url .= "&maxResults=".$maxResults1;
        }
        if( $start != 0 ) {
            $curr_url .= "&start=".$start;
        }
        $curr_url .= "#section";

        $importbutton= "<input type=\"submit\" name=\"submit\" value='import' />";

        echo "<dt><h3>".$i.".<a href='#' >".$row['title']." </a></h3></dt>";

        echo "<dd>";
        echo "<form name=\"form1\" method=\"post\" action=\"mods/ol_search_open_learn/downup.php\">";
        echo "<input type=\"hidden\" name=\"url\" id=\"to_url\" value='". trim($row['cc']) ."' />";
        echo "<input type=\"hidden\" name=\"allow_test_export\" value='1' />";
        echo "<input type=\"hidden\" name=\"ignore_validation\" value='1' />";
        echo $importbutton;
        echo "</form>";


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

        $prevw = "<a href=\"javascript: void(window.open('".trim($row['website'])."','Preview','toolbar=no,menubar=0,status=0,copyhistory=0,scrollbars=yes,resizable=1,location=0,width=350,height=200'));\" >Preview on OL</a>";

        echo "<br/>".$imgs.$prevw;

        echo "</dd>";

    }

    echo "</dl>";



    if( $start > 0 ) {
        $prev = $start-$maxResults;
        if( $maxResults1 != 0) {
            echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$prev."&maxResults=".$_GET['maxResults']."'><img src='mods/ol_search_open_learn/prev.gif' alt='Previous' /></a>&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        else {
            echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$prev."'><img src='mods/ol_search_open_learn/prev.gif' alt='Previous' /></a>&nbsp;&nbsp;&nbsp;&nbsp;";
        }
    }
    if( $total_num > $last_rec_number ) {
        if( $maxResults1 != 0) {
            echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$last_rec_number."&maxResults=".$_GET['maxResults']."'><img src='mods/ol_search_open_learn/next.gif' alt='Next' /> </a>";
        }
        else {
            echo "<a href='".$_SERVER[PHP_SELF]."?q=".$_GET['q']."&start=".$last_rec_number."'><img src='mods/ol_search_open_learn/next.gif' alt='Next' /> </a>";
        }
    }


}
else {
    echo "<br/>No results found... for ". $_GET['q'] ." <br/>";
}
?>
<?php
require (AT_INCLUDE_PATH.'footer.inc.php'); ?>

<script>
    function changeMax()
    {
        var e = document.getElementById("maxResults");
        var ele= e.options[e.selectedIndex].value;

        window.location = "<?php echo $_SERVER[PHP_SELF]."?q=".$_GET['q']."&maxResults="; ?>"+ele;

    }
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

<script language="javascript" type="text/javascript" src="/ATutor/jscripts/infusion/lib/jquery/core/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="mods/ol_search_open_learn/accordion.js"></script>
