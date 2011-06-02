<?php
// put your code here

class Update {

    function parse($date) {
        $xml = new XMLReader();
        /*$conn=mysql_connect('localhost:3306','root','root');
		if(!$conn)
		{
			echo ' database connection failed... <br/> ';
		}
		mysql_select_db('atutor',$conn);*/
        global $db;
        $xml->open("http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox&from=".$date."T00:00:00Z");
        //$xml->open("oai2.php.xml");
        $members= array();
        $flag=false;

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

        }
        $res='';

        if(count($members) > 0) {

            //define('AT_INCLUDE_PATH', '../../include/');
            //require (AT_INCLUDE_PATH.'vitals.inc.php');
            $index = 1;
            foreach ( $members as $member) {

                $qry="SELECT * FROM ".TABLE_PREFIX."hello_world where ENTRY='".$member['entry']."' ";

                $result = mysql_query($qry,$db);
                if(mysql_num_rows($result) > 0) {

                    $qry = "UPDATE ".TABLE_PREFIX."hello_world SET DATESTAMP='".$member['datestamp']."' , CATALOG='".$member['catalog'].
                            "' , TITLE='".$member['title']."' , DESCRIPTION='".$member['description']."' , KEYWORDS='".$member['keywords']."' ,".
                            " WEBSITE='".$member['website']."' , CC='".$member['common']."' , CP='".$member['package'].
                            "' WHERE ENTRY='".$member['entry']."'";

                }
                else {
                    $qry='INSERT INTO '.TABLE_PREFIX.'hello_world VALUES ('.$index.',"'.$member['identifier'].'","'.
                            $member['datestamp'].'","'.$member['catalog'].'","'.$member['entry'].'","'.
                            $member['title'].'","'.$member['description'].'","'.$member['keywords'].'","'.
                            $member['website'].'","'.$member['common'].'","'.$member['package'].'")';


                }

                $index++;

                if(mysql_query($qry,$db)) {
                    $tmp="Success";
                }
                else {
                    $tmp="Failed";
                }
                
                //$res .= "<h3>unique id: </h3>".$member['uni']."   ";
                $res .= "<h3>identifier: </h3>".$member['identifier']."   ";
                $res .= "<h3>datestamp: </h3>".$member['datestamp']."   ";
                $res .= "<h3>catalog: </h3>".$member['catalog']."   ";
                $res .= "<h3>entry: </h3>".$member['entry']."   ";
                $res .= "<h3>title: </h3>".$member['title']."   ";
                $res .= "<h3>description: </h3>".$member['description']."   ";
                $res .= "<h3>keywords: </h3>".$member['keywords']."   ";
                $res .= "<h3>Common Cartridge: </h3>".$member['common']."   ";
                $res .= "<h3>Content Package: </h3>".$member['package']."   ";
                $res .= "<h3>Website: </h3>".$member['website']."<hr/>".$qry."<br/>"./*$tmp*/"<hr/><br/>";
            }
          
        }
        $qry= "UPDATE ".TABLE_PREFIX."config SET value=CURDATE() WHERE name='ol_last_updation'";
        mysql_query($qry,$db);
    }
//echo "$res";
//mysql_close($conn);
}
?>