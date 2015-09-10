<?php

	function ReturnPercentsOfShoolYear($username, $timezone){
		
		$SQL = "SELECT COUNT(schoolyear.USERID) FROM schoolyear, user WHERE schoolyear.USERID = user.UID AND user.Name = '".$username."'";
		$MyResult = mysql_query($SQL);
		$ThereIsAlreadySchoolyear = mysql_fetch_array($MyResult);

		//echo $ThereIsAlreadySchoolyear[0];

		if ($ThereIsAlreadySchoolyear[0] > 0) {
			$SQL = "SELECT schoolyear.Start, schoolyear.Final FROM schoolyear, user WHERE schoolyear.USERID = user.UID AND user.Name = '".$username."'";
			//echo $SQL;
			$MyResult = mysql_query($SQL);
			$MyStartAndFinal = mysql_fetch_array($MyResult);
			
			$MyStart = $MyStartAndFinal[0];
			$MyFinal = $MyStartAndFinal[1];
			$MyCurrent = gmdate("Y-m-d", time() + 3600*($timezone+date("I")));
			
			$ts1 = strtotime($MyStart);
			$ts2 = strtotime($MyFinal);
			
			$seconds_diff_full = $ts2 - $ts1;
			
			$ts1 = strtotime($MyStart);
			$ts2 = strtotime($MyCurrent);

			$seconds_diff_current = $ts2 - $ts1;
			
			$Percents = ($seconds_diff_current*100)/$seconds_diff_full;
			
			if ($Percents < 0) {
				return 0;
			} else if ($Percents > 100) {
				return 100;
			} else {
				return number_format($Percents,0);
			}
			
		} else {
			return 0;
		}
	}
	

?>