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
	 * This file parses OpenLearn repository. It can work in either online or offline mode.
	 */
	 
	/** 
	 * Checks whether internet connection is available or not
	 *
	 * This function tries to open a socket connection to www.google.com.
	 * If connection establishment is successful then we may know that internet 
	 * connection is available.
	 * @return boolean status of connection
	 */
	function checkConnection() {
		//Initiates a socket connection to www.google.com at port 80
		$conn = @fsockopen("www.google.com", 80, $errno, $errstr, 30);
		//check if $conn is not null
		if ($conn) {
			$status = true;
			fclose($conn);
		} 
		else {
			$status = false;
		}
		return $status;//returns status of internet connection
	}
	
	/**
	  * Class for parsing XML file of repository
	  * 
	  * This class parses XML file and creates initial database used for searching. 
	  * It may work on both online and offline modes. If internet connection is not
	  * available then XML file attached in the module is used.
	  *
	  * @access	public
	  */
	class Parser {
		/**
		  * Function for parsing XML file of repository
		  * 
		  * This function parses XML file and creates initial database used for searching. 
		  * It may work on both online and offline modes. If internet connection is not
		  * available then XML file attached in the module is used.
		  *
		  */
		function parse() {	
		    //create object of class XMLReader for reading XML file
			$xml = new XMLReader();
			//Parsing may take a few minutes because OL repository is quite large.
			@set_time_limit(0);
	
			global $db;
			$connS = false;
			//Find internet connection's status
			$conn = checkConnection();
		
			$op = '';
			if ($conn) {
				//internet connection is available so we can directly parse using URL
				$connS = true;
				$xml->open("http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox");
				$op = '1';
			} 
			else {
				$connS = false;
				//internet connection is unavailable so we need to use repository's offline version
				$xml->open("../../ol_search_open_learn/oai2.php.xml");
				$op = '2';
			}
	
			$members = array();//main array which will contain all entries of repo.
			$flag = false;
			$resumption = 'dummy';//resumption token of repository
			//parse while resumption token is not null.
			while ($resumption != '') {
				if ($resumption == 'dummy' && $connS) {
					//if this is first iteration then use following URL
					$xml->open('http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox');
				} 
				else if ($connS) {
					//if this is not first URL then use resumption token of last page
					$xml->open('http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&resumptionToken=' . $resumption);
				}
				//main logic of parsing
				while ($xml->read()) {
	
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'record') {
						//starting of a new record
						$member = array();
						$flag = false;
						//$member['uni']='';
					}
					//starting tag of identifier
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'identifier' && !isset($member['identifier'])) {
						$member['identifier'] = addslashes(trim($xml->readString()));
					}
					//starting tag of datestamp
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'datestamp' && !isset($member['datestamp'])) {
						$member['datestamp'] = addslashes(trim($xml->readString()));
					}
					//starting tag of entry
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'entry' && !isset($member['entry'])) {
						$member['entry'] = trim($xml->readString());
					}
					//starting tag of catalog
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'catalog' && !isset($member['catalog'])) {
						$member['catalog'] = addslashes(trim($xml->readString()));
					}
					//starting tag of description
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'description' && !isset($member['description'])) {
						$tag1 = '';
	
						while ($tag1 != 'title') {
							$xml->read();
							$tag1 = $xml->localName;
						}
	
						$member['title'] = addslashes(trim($xml->readString()));
	
						while ($tag1 != 'description') {
							$xml->read();
							$tag1 = $xml->localName;
						}
	
						$member['description'] = addslashes(trim($xml->readString()));
	
						$member['keywords'] = '';
					}
					//starting tag of keywords
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'keyword' && !$flag) {
						$member['keywords'] .= addslashes(trim($xml->readString())) . ", ";
					}
					if ($xml->nodeType == XMLReader::END_ELEMENT && $xml->localName == 'general') {
						$flag = true;
						rtrim($member['keywords']);
						$member['keywords'] = substr($member['keywords'], 0, strlen($member['keywords']) - 2);
					}
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'manifestation') {
						$data = $xml->readString();
						$tag = '';
						if (strpos($data, 'web site') > 0) {
							//echo 'case 1<br/>';
							while ($tag != 'location') {
								$xml->read();
								$tag = $xml->localName;
							}
							$member['website'] = trim($xml->readString());
						} 
						else if (strpos($data, 'Common Cartridge') > 0) {
							//echo 'case 2<br/>';
							while ($tag != 'location') {
								$xml->read();
								$tag = $xml->localName;
							}
							$member['common'] = trim($xml->readString());
						} 
						else if (strpos($data, 'Content Package') > 0) {
							//echo 'case 3<br/>';
							while ($tag != 'location') {
								$xml->read();
								$tag = $xml->localName;
							}
							$member['package'] = trim($xml->readString());
						}
					}
					//record ends insert record to the main array
					if ($xml->nodeType == XMLReader::END_ELEMENT && $xml->localName == 'record') {
						$members[] = $member;
					}
					//read resumption token
					if ($connS && $xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'resumptionToken') {
						$resumption = $xml->readString();
					}
				}
				if (!$connS)//if in offline mode then only one iteration is needed
					break;
			}
			$res = '';
			$index = 1;
			//enter records in database
			if (count($members) > 0) {
	
				foreach ($members as $member) {
	
					$qry = 'INSERT INTO ' . TABLE_PREFIX . 'ol_search_open_learn VALUES (' . $index . ',"' . $member['identifier'] . '","' .
							$member['datestamp'] . '","' . $member['catalog'] . '","' . $member['entry'] . '","' .
							$member['title'] . '","' . $member['description'] . '","' . $member['keywords'] . '","' .
							$member['website'] . '","' . $member['common'] . '","' . $member['package'] . '")';
	
					$index++;
	
					if (mysql_query($qry, $db)) {
						$tmp = "Success";
					} 
					else {
						$tmp = "Failed";
					}
				}
			}
			//enter date when database last updated in config table which will be used by admin later on
			if ($connS) {
				//online mode
				$qry = "UPDATE " . TABLE_PREFIX . "config SET value=CURDATE() WHERE name='ol_last_updation'";
			} 
			else {
				//offline mode
				$qry = "UPDATE " . TABLE_PREFIX . "config SET value='2011-06-28' WHERE name='ol_last_updation'";
			}
			mysql_query($qry, $db);
			//insert current time of installation in database
			$qry = "INSERT INTO ".TABLE_PREFIX."config VALUES ('ol_last_time','".date('H:i:s')."')";
			mysql_query($qry, $db);
		}
	
	//echo "$res";
	//mysql_close($conn);
	}
?>
