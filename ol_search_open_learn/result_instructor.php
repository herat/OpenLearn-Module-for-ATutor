<?php
	/****************************************************************/
	/* OpenLearn module for ATutor                                  */
	/* http://atutoropenlearn.wordpress.com                         */
	/*                                                              */
	/* This module allows to search OpenLearn for educational       */
	/* content.														*/
	/* Author: Herat Gandhi											*/
	/* This program is free software. You can redistribute it and/or*/
	/* modify it under the terms of the GNU General Public License  */
	/* as published by the Free Software Foundation.				*/
	/****************************************************************/

	/**
	 * This php file is used for showing search results to instructors.
	 */
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN);

	$_custom_css = $_base_path . 'mods/ol_search_open_learn/module.css'; // use a custom stylesheet
	require (AT_INCLUDE_PATH . 'header.inc.php');
	define('SEP1','&amp;');
	require ('search.class.php');
	// create object of search class
	$obj = new Search();
?>

<?php
	//get input parameters passed by GET method
	$maxResults = intval(trim(strtolower($_GET['max'])));
	$maxResults1 = intval(trim(strtolower($_GET['max'])));
	$start1 = intval(trim(strtolower($_GET['p'])));
	$bool = intval(trim(strtolower($_GET['b'])));
	$orderby = intval(trim(strtolower($_GET['orderby'])));
    $qry = addslashes(filter_input(INPUT_GET,'q',FILTER_SANITIZE_SPECIAL_CHARS));
    $sf = intval(trim($_GET['sf']));
	
	if (!$start1){
		$start1 = 1;
	}
	
	$start = intval(trim(strtolower($_GET['p']))) - 1;
	
	if ($start < 0){
		$start = 0; // default
	}
	if ($sf == 0){
		//default
		$sf = 1;
	}
	if ($maxResults == 0){
		$maxResults = 10;  // default
	}
	if ($orderby == 0){
		$orderby = 1; // default
	}
    if( $bool != 1){
        $bool = 2; //default
    }
	$urlforkey = urlencode($qry);
	
	$start = $start * $maxResults; //get starting result number from page number
	//get search results using all parameters
	$rows = $obj->getSearchResult($qry, $bool, $orderby, $sf, $start, $maxResults);
	//echo count($rows)."<br/>";
	
	//get all search results without any conditions
	$all_results = $obj->getSearchResult($qry, $bool, $orderby, $sf);
	
	if (is_array($all_results)){
		//count total results
		$total_num = count($all_results);
	}
	else{
		$total_num = 0;
	}
	//Search form
?>
<div class="input-form">
<form name="search" method="get" action="mods/ol_search_open_learn/result_instructor.php" >
    <?php
		if ($maxResults1 != 0) {
			echo "<input name='max' type='hidden' value='" . $_GET['max'] . "'/>";
		}
		if ($orderby != 1) {
			echo "<input name='orderby' type='hidden' value='" . $_GET['orderby'] . "'/>";
		}
    ?>
    <table>
        <tr>
            <td>
				<label for="key"><?php echo _AT('ol_search_open_learn'); ?>:</label>
            </td>
            <td>
                <input type="text" name="q" value="<?php echo $qry; ?>" id="key" size="40" />
            </td>

        </tr>
        <tr>
            <td>
		<?php echo _AT('ol_bool'); ?>:
            </td>
            <td>
		<fieldset id="toc">
                <input type="radio" name="b" id="bool" value="1" <?php if ($bool == 1) echo "checked=\"checked\""; ?> />
                <label for="bool"><?php echo _AT('ol_or'); ?></label>
                <input type="radio" name="b" id="bool1" value="2" <?php if ($bool == 2) echo "checked=\"checked\""; ?> />
                <label for="bool1"><?php echo _AT('ol_and'); ?></label>
		</fieldset>
            </td>
        </tr>
        <tr>
           <td>
              <label for="sf" >
               <?php
                /**
                 * Display option for selecting search fields
                 */
                echo _AT('ol_search_fields_form'); ?>:
               </label>
           </td>
           <td>
               <select name="sf" id="sf" >
                   <option value="1" <?php if ($sf == 1) echo "selected='selected'" ?>><?php echo _AT('ol_all_form'); ?></option>
                   <option value="2" <?php if ($sf == 2) echo "selected='selected'" ?>><?php echo _AT('ol_title_form'); ?></option>
                   <option value="3" <?php if ($sf == 3) echo "selected='selected'" ?>><?php echo _AT('ol_desc_form'); ?></option>
                   <option value="4" <?php if ($sf == 4) echo "selected='selected'" ?>><?php echo _AT('ol_key_form'); ?></option>
               </select>
           </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="<?php echo _AT('ol_search_btn'); ?>" class="button" />
            </td>
        </tr>
    </table>
</form>
<br/>

<?php
    //options for configuring search results
    if ($total_num > 0) {
        echo "<table width='100%'>";
        echo "<tr>";
        echo "<td align='left'>";
        echo "<label for='maxResults'>";
        echo _AT('ol_max_reco');
?>: 
</label>
<form name="max" method="get" action="<?php $maxUrl = $_SERVER[PHP_SELF]; echo $maxUrl; ?>" >
        <input type="hidden" value="<?php echo $qry; ?>" name="q" />
        <input type="hidden" value="<?php echo $_GET['b']; ?>" name="b" />
        <input type="hidden" value="<?php echo $_GET['sf']; ?>" name="sf" />
    	<?php
        	if ($orderby > 1) {
 		?>
        	<input type="hidden" value="<?php echo $_GET['orderby']; ?>" name="orderby" />
		<?php
        	}
		?>
        <select name="max" id="maxResults" >
            <option value="5" <?php if ($maxResults == 5) echo "selected='selected'" ?>>5</option>
            <option value="10" <?php if ($maxResults == 10) echo "selected='selected'" ?>>10</option>
            <option value="25" <?php if ($maxResults == 25) echo "selected='selected'" ?>>25</option>
        </select>
        <input type="submit" value="<?php echo _AT('ol_change_btn'); ?>" class="button" />
</form>
</td>

<?php
	echo "<td align='right' >";
    echo "<label for='orderby'>";
	echo _AT('ol_order');
?>:
</label>
<form name="order" method="get" action="<?php $maxUrl = $_SERVER[PHP_SELF]; echo $maxUrl; ?>" >
	<input type="hidden" value="<?php echo $qry; ?>" name="q" />
    <input type="hidden" value="<?php echo $_GET['b']; ?>" name="b" />
    <input type="hidden" value="<?php echo $_GET['sf']; ?>" name="sf" />
	<?php
    	if ($maxResults1 > 0) {
	?>
    	<input type="hidden" value="<?php echo $_GET['max']; ?>" name="max" />
	<?php
    	}
	?>
    <select name="orderby" id="orderby" >
    	<option value="1" <?php if ($orderby == 1) echo "selected='selected'" ?>><?php echo _AT('ol_def'); ?></option>
        <option value="2" <?php if ($orderby == 2) echo "selected='selected'" ?>><?php echo _AT('ol_title_asc'); ?></option>
        <option value="3" <?php if ($orderby == 3) echo "selected='selected'" ?>><?php echo _AT('ol_title_desc'); ?></option>
        <option value="4" <?php if ($orderby == 4) echo "selected='selected'" ?>><?php echo _AT('ol_date_asc'); ?></option>
        <option value="5" <?php if ($orderby == 5) echo "selected='selected'" ?>><?php echo _AT('ol_date_desc'); ?></option>
    </select>
    <input type="submit" value="<?php echo _AT('ol_change_btn'); ?>" class="button" />
</form>
</td>
</tr>
</table>
<?php } ?>
</div>
<input type="hidden" id="opentip" value="<?php echo _AT('ol_open_tip'); ?>" />
<input type="hidden" id="closetip" value="<?php echo _AT('ol_close_tip'); ?>" />
<?php
	//$maxResults = intval(trim(strtolower($_GET['maxResults'])));
	// calculate the last record number
	if (is_array($rows)) {
		$num_of_results = count($rows); //calculate total no. of rows
	
		if ($maxResults > $num_of_results){
			//if maximum allowed records > number of retrieved records then
			$last_rec_number = $start + $num_of_results;
		}
		else{
			//if maximum allowed records <= number of retrieved records then
			$last_rec_number = $start + $maxResults;
		}
	}
	else{
		$last_rec_number = $total_num;
	}
	//display "start-end of total"
	if($total_num > 0) {
		echo "<div align=\"center\" >";
		if( count($rows) == $maxResults ){
			echo ($start+1)."-".($maxResults+$start)."  "._AT('ol_of')."  ".$total_num;
		}
		else if( ($start+1) != $total_num ){
			echo ($start+1)."-".$total_num."  "._AT('ol_of')."  ".$total_num;
		}
		else{
			echo ($start+1)."  "._AT('ol_of')."  " .$total_num;
		}
		echo "</div>";
	}

	//display search results
	if (is_array($rows) && count($rows) > 0) {
		//paginator
	    if ($maxResults1 == 0 && $orderby == 1) {
			print_paginator($start1, $total_num, "q=" . $urlforkey . SEP1 . "b=" . $_GET['b']. SEP1 . "sf=" . $_GET['sf'], $maxResults);
	    } 
	    else if ($orderby == 1 && $maxResults1 > 0) {
		    print_paginator($start1, $total_num, "q=" . $urlforkey . SEP1 . "b=" . $_GET['b'] . SEP1 . "sf=" . $_GET['sf']. SEP1 . "max=" . intval($_GET['max']), $maxResults);
	    } 
	    else if ($maxResults1 == 0 && $orderby > 1) {
		    print_paginator($start1, $total_num, "q=" . $urlforkey . SEP1 . "b=" . $_GET['b'] . SEP1 . "sf=" . $_GET['sf']. SEP1 . "orderby=" . intval($_GET['orderby']), $maxResults);
	    } 
	    else {
		    print_paginator($start1, $total_num, "q=" . $urlforkey . SEP1 . "b=" . $_GET['b'] . SEP1 . "sf=" . $_GET['sf']. SEP1 . "orderby=" . intval($_GET['orderby']) . SEP1 . "max=" . intval($_GET['max']), $maxResults);
	    }
		$i = $start + 1;
		$iter = 0;
		//starting of accordion
        echo "<a href='#' id='focus_here' title='dummy-link'></a>";
		echo "<div id='container'>";
		echo "<dl id='accordion'>";
	
		foreach ($rows as $row) {
	
			$curr_url = $_SERVER[PHP_SELF];
			$curr_url .= "?q=" . $urlforkey;
			if ($maxResults1 > 0) {
				$curr_url .= "&amp;max=" . $maxResults1;
			}
			if ($start != 0) {
				$curr_url .= "&amp;start=" . $start;
			}
			$curr_url .= "#section";
	
			$importbutton = "<input type=\"submit\" name=\"submit\" value='"._AT('ol_import_btn')."' class=\"button\" title=\""._AT('ol_import_unit')."\" />";
	
			echo "<dt> <input class=\"img-ol\" src=\"\" alt=\"\" title=\"\" type=\"image\" /> <a href='#' >" . stripslashes($row['title']) . " </a></dt>";
	
			echo "<dd>";
			echo "<br/>";
			echo "<form name=\"form1\" method=\"post\" action=\"mods/ol_search_open_learn/downup.php\">";
			echo "<input type=\"hidden\" name=\"url\" id=\"to_url".$i."\" value='" . trim($row['cc']) . "' />";
			echo "<input type=\"hidden\" name=\"allow_test_export\" value='1' />";
			echo "<input type=\"hidden\" name=\"ignore_validation\" value='1' />";
			echo "<input type=\"hidden\" name=\"q\" value=' " . $qry . " ' />";
			echo "<input type=\"hidden\" name=\"b\" value=' " . $bool . " ' />";
			echo "<input type=\"hidden\" name=\"p\" value=' " . intval(trim(strtolower($_GET['p']))) . " ' />";
			echo "<input type=\"hidden\" name=\"max\" value=' " . $_GET['max'] . " ' />";
			echo "<input type=\"hidden\" name=\"sf\" value=' " . $_GET['sf'] . " ' />";
			echo "<input type=\"hidden\" name=\"n_val\" value='".$iter."'/>";
			echo $importbutton;
			echo "</form>";
	
	
			echo "<p><strong>"._AT('ol_descri')."</strong><br/>" . stripslashes($row['description']) . "</p>";
			echo "<p><strong>"._AT('ol_keywords')."</strong><br/>" . stripslashes($row['keywords']) . "</p>";
			$datentime = datestamp(stripslashes($row['datestamp']));
			echo "<p><strong>"._AT('ol_last_modi')."</strong><br/>" . $datentime[0] . "  ". _AT('ol_at') ."  ". $datentime[1] . "</p>";
			echo "<br/>";
	
	
			$i++;
			$iter++;
			//link for CC & CP files of unit
			$imgs = "<a href='" . $row['cp'] . "'> <img src='mods/ol_search_open_learn/images/cp.png' alt='"._AT('ol_tool_1')."' title='"._AT('ol_tool_1')."' border='0' /> </a> <a href='" . $row['cc'] . "'> <img src='mods/ol_search_open_learn/images/cc.png' alt='"._AT('ol_tool_2')."' title='"._AT('ol_tool_2')."' border='0' /> </a>";
			//link for popup window of unit
			$prevw = "<a href=\"javascript: void(popup('" . $row['website'] . "','Preview',screen.width*0.45,screen.height*0.45));\" ><img src='mods/ol_search_open_learn/images/popup.gif' alt='"._AT('ol_tool_3')."' title='"._AT('ol_tool_3')."' border='0' /> </a>";
			//link for RSS of unit
			$rss = "<a href=\"javascript: void(popup('" . parseForNumber($row['cc'], $row['entry']) . "','RSS',screen.width*0.45,screen.height*0.45));\"><img src='mods/ol_search_open_learn/images/rss.gif' alt='"._AT('ol_tool_4')."' title='"._AT('ol_tool_4')."' border='0' /></a>";
			//link for .doc file of unit
			$doc_file = "<a href=\"javascript: void(popup('".AT_BASE_HREF."mods/ol_search_open_learn/doc.php?cc=".$row['cc']."&amp;entry=".$row['entry']."','Download',screen.width*0.30,screen.height*0.20));\" ><img src='mods/ol_search_open_learn/images/word.gif' alt='"._AT('ol_tool_5')."' title='"._AT('ol_tool_5')."' border='0' /></a>";
	
			echo "<div align='left' class='menuitems'>".$imgs . $prevw . $rss . $doc_file. "</div><br/>";
	
			echo "</dd>";
		}
	
		echo "</dl>";
		echo "</div>";
		
		//paginator
	    if ($maxResults1 == 0 && $orderby == 1) {
			print_paginator($start1, $total_num, "q=" . $urlforkey . SEP1 . "b=" . $_GET['b']. SEP1 . "sf=" . $_GET['sf'], $maxResults);
	    } 
	    else if ($orderby == 1 && $maxResults1 > 0) {
		    print_paginator($start1, $total_num, "q=" . $urlforkey . SEP1 . "b=" . $_GET['b'] . SEP1 . "sf=" . $_GET['sf']. SEP1 . "max=" . intval($_GET['max']), $maxResults);
	    } 
	    else if ($maxResults1 == 0 && $orderby > 1) {
		    print_paginator($start1, $total_num, "q=" . $urlforkey . SEP1 . "b=" . $_GET['b'] . SEP1 . "sf=" . $_GET['sf']. SEP1 . "orderby=" . intval($_GET['orderby']), $maxResults);
	    } 
	    else {
		    print_paginator($start1, $total_num, "q=" . $urlforkey . SEP1 . "b=" . $_GET['b'] . SEP1 . "sf=" . $_GET['sf']. SEP1 . "orderby=" . intval($_GET['orderby']) . SEP1 . "max=" . intval($_GET['max']), $maxResults);
	    }
	} 
	else {
		echo _AT('ol_no')." <b>" . $qry . "</b> <br/>";
	}
?>
<?php
    
	/**
	 * Get date from stored datestamp
	 * @param string datestamp of unit
	 * @return string date
	 */
    function datestamp($datestamp) {
        $ind = strpos($datestamp, 'T');
        $date = substr($datestamp, 0, $ind);
        $time = substr($datestamp, $ind + 1);
        $time = substr($time, 0, strlen($time) - 1);
        $parts = explode("-", $date);
        $dateandtime = array();
        $dateandtime[0] = $parts[2] . "-" . $parts[1] . "-" . $parts[0];
        $dateandtime[1] = $time;
        return $dateandtime;
    }
	/**
	 * Function for getting Identifier
	 * 
	 * This function filters Identifier from the Common Cartridge URL.
	 * @param string URL of CC package
	 * @param string Entry of article
	 * @return string Identifier of article
	 */
    function parseForNumber($key, $entry) {
        $posofeq = strpos($key, "=");
        $key1 = substr($key, $posofeq + 2);
        //echo $key1."<br/>";
        $posofsl = strpos($key1, "/");
        $key2 = substr($key1, $posofsl + 1);
        //echo $key2."<br/>";
        $posofsl2 = strpos($key2, "/");
        $key3 = substr($key2, 0, $posofsl2);

        $url = "http://openlearn.open.ac.uk/rss/file.php/stdfeed/" . $key3 . "/" . $entry . "_rss.xml";
        //echo $key3;
        return $url;
    }
?>

<script type="text/javascript">
    function changeMax() {
		var e = document.getElementById("maxResults");
		var ele= e.options[e.selectedIndex].value;
	
		window.location = "<?php echo $_SERVER[PHP_SELF] . "?q=" . $qry . "&amp;max="; ?>"+ele;
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
	//open popup window
    function popup(pageURL, title,w,h) {
		//var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		var newWin = window.open(pageURL,title,'toolbar=no,menubar=0,status=0,copyhistory=0,scrollbars=yes,resizable=1,location=0,width='+w+', height='+h);
    }
</script>
<script type="text/javascript">
	/**
	 * Function to trim a string
	 * @param string input string
	 * @return string trimmed string	
	 */
	function trim( str ) {
		return str.replace(/^\s+|\s+$/g, "");
	}
	/**
	 * Function for validating whether input field is empty or not
	 * @return boolean True if input field is not empty
	 */
	function validate() {
		var key= document.getElementById('key').value;
		if( key == null || trim(key)=="" ) {
			//alert("Enter keyword.");
			document.getElementById('key').focus();
			return false;
		}
		else {
			return true;
		}
	}
</script>
<script language="javascript" type="text/javascript" src="jscripts/infusion/lib/jquery/core/js/jquery.js"></script>
<?php 
	if( $_SESSION['n_val'] == '' || $_SESSION['n_val'] == null ) {
?>
<script language="javascript" type="text/javascript" src="mods/ol_search_open_learn/js/accordion.js"></script>
<?php
	}
	else {
?>
<input type="hidden" id="n_val" value="<?php echo $_SESSION['n_val']; ?>" />
<script language="javascript" type="text/javascript" src="mods/ol_search_open_learn/js/accordion_import.js"></script>
<?php		
		$_SESSION['n_val']="";
	}	
	require (AT_INCLUDE_PATH . 'footer.inc.php');
?>


