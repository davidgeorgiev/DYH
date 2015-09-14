<?php

	function CountUnappreciatedHomeworks($userid){
		$SQL = "SELECT COUNT(solvedhomeworks.Assessment) FROM solvedhomeworks WHERE solvedhomeworks.Assessment = 0 AND solvedhomeworks.USERID = ".$userid;
		$MyNumberOfUnappreciatedHWSResult = mysql_query($SQL);
		$MyNumberOfUnappreciatedHWS = mysql_fetch_array($MyNumberOfUnappreciatedHWSResult);
		
		return $MyNumberOfUnappreciatedHWS[0];
	}
	function UnappreciatedHomeworks($userid){
		$SQL = "SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE solvedhomeworks.Assessment = 0 AND solvedhomeworks.USERID = ".$userid;
		$UnappreciatedHWIDsResult = mysql_query($SQL);
		return $UnappreciatedHWIDsResult;
	}

?>