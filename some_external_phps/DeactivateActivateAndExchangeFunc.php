<?php
	function GetTwoWeeksUIDByUserID($userid){
		$SQL = "SELECT twoweeks.UID FROM uw, twoweeks WHERE uw.UserID = ".$userid." AND uw.TwoWeeksID = twoweeks.UID";
		$TwoWeeksIDResult = mysql_query($SQL);
		$TwoWeeksID = mysql_fetch_array($TwoWeeksIDResult);
		
		return $TwoWeeksID[0];
	}
	function DeactivateOtherWeek($userid){
		$SQL = "UPDATE twoweeks SET CheckToOtherWeek = 0 WHERE twoweeks.UID = ".GetTwoWeeksUIDByUserID($userid);
		$DeactivatingResult = mysql_query($SQL);
		if ($DeactivatingResult == 1){
			return "Успешно деактивирахте извънредната програма :)";
		} else {
			return "Деактивирането е неуспешно :(";
		}
	}
	function ActivateOtherWeek($userid){
		$SQL = "UPDATE twoweeks SET CheckToOtherWeek = 1 WHERE twoweeks.UID = ".GetTwoWeeksUIDByUserID($userid);
		$ActivatingResult = mysql_query($SQL);
		if ($ActivatingResult == 1){
			return "Успешно активирахте извънредната програма :)";
		} else {
			return "Активирането е неуспешно :(";
		}
	}
	function ExChangeWeeks($userid){
		$SQL = "SELECT twoweeks.EvenWeekID, twoweeks.OddWeekID FROM twoweeks WHERE twoweeks.UID = ".GetTwoWeeksUIDByUserID($userid);
		$TwoWeeksIDsResult = mysql_query($SQL);
		$TwoWeeksIDs = mysql_fetch_array($TwoWeeksIDsResult);
		
		$SQL = "UPDATE twoweeks SET EvenWeekID = ".$TwoWeeksIDs[1].", OddWeekID = ".$TwoWeeksIDs[0]." WHERE twoweeks.UID = ".GetTwoWeeksUIDByUserID($userid);
		$ExchangeWeeksIDsResult = mysql_query($SQL);
		
		if ($ExchangeWeeksIDsResult == 1){
			return "Успешно разменихте програмите за четна и нечетна седмица :)";
		} else {
			return "Размяната е неуспешна :(";
		}
	}
?>