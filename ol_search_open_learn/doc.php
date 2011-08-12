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
    
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	/**
	 * Function for getting Identifier
	 * 
	 * This function filters Identifier from the Common Cartridge URL.
	 * @param string URL of CC package
	 * @param string Entry of article
	 * @return string Identifier of article
	 */
	function getId( $key,$entry ){
		//find position of "=" in CC URL
		$posofeq = strpos($key, "=");
		//get part of URL which follows "="
		$key1 = substr($key, $posofeq + 2);
		//echo $key1."<br/>";
		//find position of first "/"
		$posofsl = strpos($key1, "/");
		//again filter string
		$key2 = substr($key1, $posofsl + 1);
		//echo $key2."<br/>";
		//find position of first "/"
		$posofsl2 = strpos($key2, "/");
		//ID is retrieved in $key3
		$key3 = substr($key2, 0, $posofsl2);
	
		return $key3;
	}
	
	/**
	 * Function for getting URL of .doc file
	 * 
	 * This function parses "Download Unit" page for unit and returns URL of
	 * .doc file.
	 * @param string Identifier
	 * @return mixed false on failure
	 */
	function getURL( $id, $configurl ){
		//create object of DOMDocument class
		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		//load HTML page of "Download Unit"
		@$dom->loadHTMLFile($configurl.$id);
		//find all <a> tag in HTML
		$members = $dom->getElementsByTagName('a');
		//iterate through all <a> to find that <a> which has URL of .doc file
		foreach ($members as $member) {
			$inter = $member->getAttribute('href');
			//if current tag does not have .doc URL continue
			if(stripos($inter,".doc") === false){
				
			}
			//else return because we found the link which we are looking for
			else{
				//return link to .doc file
				return $inter;	
			}
		}
		//return false because unit does not provide .doc file
		return false;
	}
	$key = $_GET['cc'];
	//echo $key."<br/>";
	$entry = $_GET['entry'];
	//echo $entry."<br/>";
	$id = getId($key,$entry);
	//echo $id."<br/>";
	$url = getURL($id,$_config['ol_doc_url']);
	//echo $url."<br/>";
	//if $url is false then unit does not provide .doc file
	if( $url === false ){
		echo "<h3>"._AT('ol_not_doc')."</h3>";
	}
	//else display option for downloading .doc file
	else{
		echo "<h3>"._AT('ol_doc_avail')." <a href='".$url."'>"._AT('ol_dwnld')."</a></h3>";
	}
		
?>
