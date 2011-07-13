<?php
	function getId( $key,$entry )
	{
		$posofeq = strpos($key, "=");
		$key1 = substr($key, $posofeq + 2);
		//echo $key1."<br/>";
		$posofsl = strpos($key1, "/");
		$key2 = substr($key1, $posofsl + 1);
		//echo $key2."<br/>";
		$posofsl2 = strpos($key2, "/");
		$key3 = substr($key2, 0, $posofsl2);
	
		return $key3;
	}
	
	function getURL( $id )
	{
		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		
		@$dom->loadHTMLFile("http://openlearn.open.ac.uk/blocks/formats/download_unit.php?id=".$id);
		
		$members = $dom->getElementsByTagName('a');
		
		foreach ($members as $member) {
			$inter = $member->getAttribute('href');
			if(stripos($inter,".doc") === false)
			{
				
			}
			else
			{
				return $inter;	
			}
		}
		return false;
	}
		$key = $_GET['cc'];
		//echo $key."<br/>";
		$entry = $_GET['entry'];
		//echo $entry."<br/>";
		$id = getId($key,$entry);
		//echo $id."<br/>";
		$url = getURL($id);
		//echo $url."<br/>";
		if( $url === false )
		{
			echo "<h3>Unit does not provide .doc file.</h3>";
		}
		else
		{
			echo "<h3>The unit is available for download: <a href='".$url."'>Download</a></h3>";
		}
		
?>