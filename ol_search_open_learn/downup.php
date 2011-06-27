<?php

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');

authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN);

@set_time_limit(0);


$url_cc = trim($_POST['url']);

$url  = $url_cc;
//$fname= substr(time(), -6). '.zip';
$fname='916643.zip';
$path = $fname;

//file_put_contents($path, get_web_page($url));

$request_url = AT_BASE_HREF."mods/_core/imscp/ims_import.php";
//$request_url = AT_BASE_HREF."mods/ol_search_open_learn/tmp.php";

$post_params['file'] = '@'.getcwd()."/".$fname;
$post_params['submit'] = 'import';
$post_params['allow_test_export']= '1';
$post_params['ignore_validation']= '1';
$post_params['cid']= '0';

$ch = curl_init();
$localfile = getcwd()."/".$fname;
$fp = fopen($localfile, 'r');
curl_setopt($ch, CURLOPT_URL, $request_url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$respon=curl_exec ($ch);
$error_no = curl_errno($ch);
curl_close ($ch);
if ($error_no == 0) 
{
   	$error = 'File uploaded succesfully.';
} 
else 
{
   	$error = 'File upload error.';
}
echo $error;
echo $respon;
	
function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => true,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_COOKIEJAR      => '/tmp/cookies.txt',
        CURLOPT_COOKIEFILE     => '/tmp/cookies.txt'
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
        
    $content = curl_exec( $ch );
    
    curl_close( $ch );

    return $content;
}

?>
