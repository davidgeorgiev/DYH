<?php
	include "GetTitleFromURL.php";
	
	function getUrls($string) {
		

		$pattern = '#(www\.|https?://)?[a-z0-9]+\.[a-z0-9]{2,4}\S*#i';
		preg_match_all($pattern, $string, $matches);



		return ($matches);
	}
	
	function FixURLsData($string){
		//echo $data;
		//print_r getUrls($string);
		$string = preg_replace(
              "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~",
              "<a id = \"MyDataURL\" target = \"blank\" href=\"\\0\">\\0</a>", 
              $string);
		
		
		
		
		return $string;
	}


?>