<?php
	function CheckIfHaveToShowOtherWeek($userid){
		$ShowOtherWeek = 0;
		
		$SQL = "SELECT twoweeks.CheckToOtherWeek FROM uw, twoweeks WHERE uw.UserID = ".$userid." AND uw.TwoWeeksID = twoweeks.UID";
		//echo $SQL;
		$IfShowResult = mysql_query($SQL);
		$ShowOtherWeek = mysql_fetch_array($IfShowResult);
		
		return $ShowOtherWeek[0];
	}
?>