<?php

	function CountSuggestedHomeworks($userid){
		$SQL = "SELECT COUNT(uh_suggested.UID) FROM uh_suggested WHERE uh_suggested.USERID = ".$userid;
		$MyNumberOfSuggestedHWSResult = mysql_query($SQL);
		$MyNumberOfSuggestedHWS = mysql_fetch_array($MyNumberOfSuggestedHWSResult);
		
		return $MyNumberOfSuggestedHWS[0];
	}
	function SuggestedHomeworks($userid){
		$SQL = "SELECT uh_suggested.HWID FROM uh_suggested WHERE uh_suggested.USERID = ".$userid;
		$SuggestedHWIDsResult = mysql_query($SQL);
		return $SuggestedHWIDsResult;
	}

?>