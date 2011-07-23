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
	 * This file updates database from recent OpenLearn repository changes.
	 */
	/**
	  * Class for parsing XML file of repository( for updating database from repository )
	  * 
	  * This class parses XML file and updates database used for searching. 
	  * 
	  * @access	public
	  */
	class Update {
		
		/**
		  * Function for parsing XML file of repository
		  * 
		  * This function parses XML file and updates database used for searching. 
		  * @param string last modified date
		  * @param string URL of OL repository
		  */
		function parse($date, $urlforrepo) {
			//create object of class XMLReader for reading XML file
			$xml = new XMLReader();
			//Parsing may take a few minutes because OL repository is quite large.
			@set_time_limit(0);
			global $db;
			//open XML file
			$xml->open($urlforrepo . "&from=" . $date . "T00:00:00Z");
			//$xml->open("oai2.php.xml");
			$members = array(); //main array which will contain all entries of repo.
			$flag = false;
			$resumption = 'dummy';//resumption token of repository
			//parse while resumption token is not null.
			while ($resumption != '') {
				if ($resumption == 'dummy') {
					$xml->open($urlforrepo . "&from=" . $date . "T00:00:00Z");
				} 
				else {
					$xml->open('http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&resumptionToken=' . $resumption);
				}
				//main logic starts
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
					//starting tag of keyword
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
						if ($resumption == 'dummy'){
							$resumption = '';
						}
					}
					if ($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'resumptionToken') {
						$resumption = $xml->readString();
					}
				}
			}
			$res = '';
			//insert or update records in database
			if (count($members) > 0) {
	
				//define('AT_INCLUDE_PATH', '../../include/');
				//require (AT_INCLUDE_PATH.'vitals.inc.php');
	
				$qry = "SELECT * FROM " . TABLE_PREFIX . "ol_search_open_learn";
				$result = mysql_query($qry, $db);
				//index starts from last number of record in database + 1	
				$index = mysql_num_rows($result) + 1;
	
				foreach ($members as $member) {
	
					$qry = "SELECT * FROM " . TABLE_PREFIX . "ol_search_open_learn where ENTRY='" . $member['entry'] . "' ";
					//try to get record from database having same entry
					$result = mysql_query($qry, $db);
					//if record exists in database then update it else insert it in database
					if (mysql_num_rows($result) > 0) {
	
						$qry = "UPDATE " . TABLE_PREFIX . "ol_search_open_learn SET DATESTAMP='" . $member['datestamp'] . "' , CATALOG='" .
						       $member['catalog'] . "' , TITLE='" . 
							   $member['title'] . "' , DESCRIPTION='" . 
							   $member['description'] . "' , 	KEYWORDS='" . $member['keywords'] . "' ," . " WEBSITE='" . 
							   $member['website'] . "' , CC='" . $member['common'] . "' , CP='" . 
							   $member['package'] . "' WHERE ENTRY='" . $member['entry'] . "'";
					} 
					else {
						$qry = 'INSERT INTO ' . TABLE_PREFIX . 'ol_search_open_learn VALUES (' . $index . ',"' . $member['identifier'] . '","' .
								$member['datestamp'] . '","' . $member['catalog'] . '","' . $member['entry'] . '","' .
								$member['title'] . '","' . $member['description'] . '","' . $member['keywords'] . '","' .
								$member['website'] . '","' . $member['common'] . '","' . $member['package'] . '")';
						$index++;
					}
					
					$tmp = "Success";
	
					if (mysql_query($qry, $db)) {
						$tmp = "Success";
					} 
					else {
						echo $qry;
						exit;
						$tmp = "Failed";
					}
	
					/*$res .= "<h3>unique id: </h3>".$member['uni']."   ";
					$res .= "<h3>identifier: </h3>" . $member['identifier'] . "   ";
					$res .= "<h3>datestamp: </h3>" . $member['datestamp'] . "   ";
					$res .= "<h3>catalog: </h3>" . $member['catalog'] . "   ";
					$res .= "<h3>entry: </h3>" . $member['entry'] . "   ";
					$res .= "<h3>title: </h3>" . $member['title'] . "   ";
					$res .= "<h3>description: </h3>" . $member['description'] . "   ";
					$res .= "<h3>keywords: </h3>" . $member['keywords'] . "   ";
					$res .= "<h3>Common Cartridge: </h3>" . $member['common'] . "   ";
					$res .= "<h3>Content Package: </h3>" . $member['package'] . "   ";
					$res .= "<h3>Website: </h3>" . $member['website'] . "<hr/>" . $qry . "<br/>" . /* $tmp "<hr/><br/>";*/
				}
			}
			define('AT_INCLUDE_PATH', '../../include/');
			require_once(AT_INCLUDE_PATH . '/classes/Message/Message.class.php');
			global $savant;
			//feedback messsage for admin
			$msg = new Message($savant);
			//change date of last updation
			if ($tmp != "Failed") {
				$qry = "UPDATE " . TABLE_PREFIX . "config SET value=CURDATE() WHERE name='ol_last_updation'";
				$feedback = array('OL_DB_UPDATED');
				$msg->addFeedback($feedback);
				mysql_query($qry, $db);
				$qry = "UPDATE " . TABLE_PREFIX . "config SET value='".date('H:i:s')."' WHERE name='ol_last_time'";
				mysql_query($qry, $db);
			} 
			else {
				$msg->addError('OL_DB_NOT_UPDATED');
			}
		}
	
	//echo "$res";
	//mysql_close($conn);
	}
?>
