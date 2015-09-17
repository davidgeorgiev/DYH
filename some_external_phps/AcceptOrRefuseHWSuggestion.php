<?php

	function AcceptHWSuggestion($hwid, $userid){
		
		$SQL = "INSERT INTO uh (USERID, HWID) VALUES (".$userid.", ".$hwid.")";
		$MyInsertionHW = mysql_query($SQL);
		
		$SQL = "DELETE FROM uh_suggested WHERE uh_suggested.HWID = ".$hwid;
		$MyDeletion = mysql_query($SQL);
		
		if (($MyInsertionHW == 1) && ($MyDeletion == 1))
		return 1;
	}
	
	function RefuseHWSuggestion($hwid, $userid){
		$SQL = "DELETE FROM uh_suggested WHERE uh_suggested.HWID = ".$hwid;
		$MyDeletion = mysql_query($SQL);
		
		if ($MyDeletion == 1){
			return 1;
		} else {
			return 0;
		}
	}

?>