<?php
// put your code here
function checkConnection() {
    //Initiates a socket connection to www.google.com at port 80
    $conn = @fsockopen("www.google.com", 80, $errno, $errstr, 30);
    if ($conn) {
        $status = true;
        fclose($conn);
    }
    else {
        $status = false;
    }
    return $status;
}
class Parser {
    function parse() {
        
        $xml = new XMLReader();
        @set_time_limit(0);
        global $db;
        $connS = false;
        $conn = checkConnection();
        
	   
        $op='';
	if( $conn ) {
            $connS = true;
            $xml->open("http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox");
            $op = '1';
        }
        else {
			$connS = false;
            $xml->open("../../ol_search_open_learn/oai2.php.xml");
            $op = '2';
        }

        
        $members= array();
        $flag=false;
        $resumption = 'dummy';

        while( $resumption != '' ) {
            if($resumption == 'dummy' && $connS) {
                $xml->open('http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox');
            }
            else if($connS) {
                $xml->open('http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&resumptionToken='.$resumption);
            }

            while( $xml -> read() ) {

                if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'record') {
                    $member = array();
                    $flag = false;
                    //$member['uni']='';
                }
                if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'identifier' && !isset($member['identifier'])) {
                    $member['identifier']=$xml->readString();
                }
                if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'datestamp' && !isset($member['datestamp'])) {
                    $member['datestamp']=$xml->readString();
                }
                if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'entry' && !isset($member['entry'])) {
                    $member['entry']=$xml->readString();
                }
                if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'catalog' && !isset($member['catalog'])) {
                    $member['catalog']=$xml->readString();
                }
                /*if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'entry')
			{
				$ty = $xml->readString();
				if(strpos($ty, 'id'))
				{
					$member['uni']=$ty;
					//echo'<br/>Here in If condition part '.$member['uni'].'<br/>';
				}
			}
			if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'title' && !isset($member['title']))
			{
				$member['title']=$xml->readString();
			}*/
                if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'description' && !isset($member['description'])) {
                    $tag1= '';

                    while($tag1 != 'title') {
                        $xml->read();
                        $tag1= $xml->localName;
                    }

                    $member['title']=$xml->readString();

                    while($tag1 != 'description') {
                        $xml->read();
                        $tag1= $xml->localName;
                    }

                    $member['description']=$xml->readString();

                    $member['keywords']='';
                }
                if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'keyword' && !$flag ) {
                    $member['keywords'] .= $xml->readString().", ";
                }
                if($xml->nodeType == XMLReader::END_ELEMENT && $xml->localName == 'general' ) {
                    $flag = true;
                    rtrim($member['keywords']);
                    $member['keywords'] = substr($member['keywords'],0,strlen($member['keywords'])-2);
                }
                if($xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'manifestation' ) {
                    $data = $xml->readString();
                    $tag='';
                    if( strpos($data, 'web site') > 0 ) {
                        //echo 'case 1<br/>';
                        while($tag != 'location') {
                            $xml->read();
                            $tag= $xml->localName;
                        }
                        $member['website']=$xml->readString();
                    }
                    else if( strpos($data, 'Common Cartridge') > 0 ) {
                        //echo 'case 2<br/>';
                        while($tag != 'location') {
                            $xml->read();
                            $tag= $xml->localName;
                        }
                        $member['common']=$xml->readString();
                    }
                    else if(strpos($data, 'Content Package') > 0) {
                        //echo 'case 3<br/>';
                        while($tag != 'location') {
                            $xml->read();
                            $tag= $xml->localName;
                        }
                        $member['package']=$xml->readString();
                    }
                }
                if($xml->nodeType == XMLReader::END_ELEMENT && $xml->localName == 'record') {
                    $members[]=$member;
                }
                if($connS && $xml->nodeType == XMLReader::ELEMENT && $xml->localName == 'resumptionToken') {
                    $resumption = $xml->readString();
                }
            }
            if( !$connS )
                break;
        }
        $res='';
        $index = 1;
        if(count($members) > 0) {

            foreach ( $members as $member) {

                $qry='INSERT INTO '.TABLE_PREFIX.'ol_search_open_learn VALUES ('.$index.',"'.$member['identifier'].'","'.
                        $member['datestamp'].'","'.$member['catalog'].'","'.$member['entry'].'","'.
                        $member['title'].'","'.$member['description'].'","'.$member['keywords'].'","'.
                        $member['website'].'","'.$member['common'].'","'.$member['package'].'")';

                $index++;

                if(mysql_query($qry,$db)) {
                    $tmp="Success";
                }
                else {
                    $tmp="Failed";
                }


            }
        }
        if($connS)
        {
            $qry = "INSERT INTO ".TABLE_PREFIX."config VALUES ('ol_last_updation',CURDATE())";
            
        }
        else
        {
            $qry = "INSERT INTO ".TABLE_PREFIX."config VALUES ('ol_last_updation','2011-06-28')";
            
        }
        mysql_query($qry,$db);
    }
//echo "$res";
//mysql_close($conn);
}
?>
