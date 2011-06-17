<?php

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN);

$ch = curl_init();

$url_cc = trim($_POST['url']);

//download file in content folder of ATutor
$webcontent = file_get_contents($url_cc);
//generate dynamic unique filenames
$fp = fopen(getcwd().'/ol_my_file.zip', 'w');
fwrite($fp, $webcontent);
fclose($fp);

//echo AT_BASE_HREF."mods/_core/imscp/ims_import.php";

//upload file
$uploadfile = getcwd().'/ol_my_file.zip'; // file to be uploaded
 

// define the URL for upload file
curl_setopt($ch, CURLOPT_URL, AT_BASE_HREF."mods/_core/imscp/ims_import.php"); // you can modify this URL based on your environment
curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => "@$uploadfile",'submit' => 'import','allow_test_export' => '1'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_exec($ch);
curl_close($ch);  
 
?>