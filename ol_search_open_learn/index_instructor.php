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
	 * This php file will be displayed to instructors when they click on "Search OpenLearn"
	 * link provided as a content management tool of the course. It will display one form for
	 * searching OpenLearn's repository.
	 */
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN);
	require (AT_INCLUDE_PATH . 'header.inc.php');
?>
<div class="input-form">
<form name="search" method="get" action="mods/ol_search_open_learn/result_instructor.php" >
    <table>
        <tr>
            <td>
                <label for="key"><?php echo _AT('ol_search_open_learn'); ?>:</label>
            </td>
            <td>
                <input id="key" type="text" name="q" size="40" />
            </td>

        </tr>
        <tr>
            <td>
                <label for="bool">
                <?php
                /**
                 * Display option for selecting boolean operation for
                 * multiple keywords : "And"/"Or"
                 */
                echo _AT('ol_bool');
                ?>:
                </label>
            </td>
            <td>
                <input type="radio" name="b" id="bool" value="1" /><?php echo _AT('ol_or'); ?>
                <input type="radio" name="b" id="bool" value="2" checked="checked" /><?php echo _AT('ol_and'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="orderby">
                <?php 
                /**
                 * Display option for selecting sorting order of search results
                 */
                echo _AT('ol_order');
                ?>:
                </label>
            </td>
            <td>
                <select name="orderby" id="orderby" > 
                    <option value="1" selected="selected"><?php echo _AT('ol_def'); ?></option>
                    <option value="2" ><?php echo _AT('ol_title_asc'); ?></option>
                    <option value="3" ><?php echo _AT('ol_title_desc'); ?></option>
                    <option value="4" ><?php echo _AT('ol_date_asc'); ?></option>
                    <option value="5" ><?php echo _AT('ol_date_desc'); ?></option>
                </select>
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
                    <option value="1" selected="selected"><?php echo _AT('ol_all_form'); ?></option>
                    <option value="2" ><?php echo _AT('ol_title_form'); ?></option>
                    <option value="3" ><?php echo _AT('ol_desc_form'); ?></option>
                    <option value="4" ><?php echo _AT('ol_key_form'); ?></option>
                 </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
	            <input type="submit" value="Search" class="button" />
            </td>
        </tr>
    </table>
</form>
</div>
<?php require (AT_INCLUDE_PATH . 'footer.inc.php'); ?>
<script type="text/javascript">
    document.getElementById('key').focus();
	/**
	 * Function to trim a string
	 * @param string input string
	 * @return string trimmed string	
	 */
	function trim( str ){
		return str.replace(/^\s+|\s+$/g, "");
	}
	/**
	 * Function for validating whether input field is empty or not
	 * @return boolean True if input field is not empty
	 */
	function validate(){
		var key= document.getElementById('key').value;
		if( key == null || trim(key)=="" ) {
			//alert("Enter keyword.");
			document.getElementById('key').focus();
			return false;
		}
		else{
			return true;
		}
	}
</script>
