<?php

	function CheckMyAssessmentForHWWithID($hwid, $loggedUserid){
		$assessment = 0;
		
			$SQL = "SELECT solvedhomeworks.Assessment FROM solvedhomeworks WHERE solvedhomeworks.USERID = ".$loggedUserid." AND solvedhomeworks.HWID = ".$hwid;
			$MyAssessmentResult = mysql_query($SQL);
			$MyAssessment = mysql_fetch_array($MyAssessmentResult);
		
		switch($MyAssessment[0]){
			case 0: $assessment = "Още няма";
			break;
			case 1: $assessment = "Не е за оценка";
			break;
			case 2: $assessment = "Слаб 2";
			break;
			case 3: $assessment = "Среден 3";
			break;
			case 4: $assessment = "Добър 4";
			break;
			case 5: $assessment = "Много добър 5";
			break;
			case 6: $assessment = "Отличен 6";
			break;
		}
		
		return $assessment;
	}

?>