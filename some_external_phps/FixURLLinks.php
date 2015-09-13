<?php
	include "GetTitleFromURL.php";
	function FixURLsData($data){
		//echo $data;
		$MyAllWords = explode(" ",$data);
		
		foreach($MyAllWords as $key => $value){
			if ((strpos($MyAllWords[$key],'http') !== false) || (strpos($MyAllWords[$key],'www.') !== false)) {
				
				$FirstLetterIsFound = 0;
				$IndexOfLastLetter = 0;
				for($counter = strlen($MyAllWords[$key])-1;$counter > 0; $counter--){
					if ($FirstLetterIsFound == 0){
						$char = $MyAllWords[$key][$counter];
						//echo "<p>";
						if (preg_match('/[a-zA-Z1-9]/', $char)){
							$IndexOfLastLetter = $counter+1;
							$FirstLetterIsFound = 1;
							//echo $char.' is a letter';
						} else {
							//echo $char.' isn\'t a letter';
						}
						//echo "</p>";
					}
				}
				//echo "<p>IndexOfLastLetter - ".$IndexOfLastLetter."</p>";
				$MyDoneURL = mb_substr($MyAllWords[$key], 0, $IndexOfLastLetter);
				
				$TitleOfPage = get_title($MyDoneURL);
				if (strlen($TitleOfPage) <= 0){
					$TitleOfPage = "link";
				}
				
				$MyTextAfterURL = mb_substr($MyAllWords[$key], $IndexOfLastLetter, (strlen($MyAllWords[$key])-1));
				$MyAllWords[$key] = '<a id = "MyDataURL" target = "blank" href = "'.$MyDoneURL.'">'.$TitleOfPage."</a>".$MyTextAfterURL;
			}
		}
		
		
		
		unset($value);
		unset($key);
		
		$DoneText = "";
		$ForFirstTime = 1;
		foreach($MyAllWords as $value){
			if ($ForFirstTime == 1){
				$ForFirstTime = 0;
				$Space = "";
			} else {
				$Space = " ";
			}
			$DoneText .= $Space.$value;
		}
		unset($value);
	
		return $DoneText;
	}
	
	function ReturnNormalText($data){
		$data = str_replace('<a id = "MyDataURL" target = "blank" href = "',"",$data);
		$data = str_replace('">',"MyTempStringblaaaaaablaaaaaa12332R",$data);
		$data = str_replace('</a>',"MyTempStringblaaaaaablaaaaaa12332R",$data);
		
		$MyArray = explode("MyTempStringblaaaaaablaaaaaa12332R", $data);
		$ReturnData = "";
		$counter = 1;
		foreach($MyArray as $value){
			if ($counter & 1){
				$ReturnData.= $value;
			}
			$counter++;
		}
		
		return $ReturnData;
	}


?>