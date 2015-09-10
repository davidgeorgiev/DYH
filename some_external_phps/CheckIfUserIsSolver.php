<?php
	function CheckIfUserIsSolver($userid, $hwid) {
		$SQL = "SELECT DISTINCT COUNT(solvedhomeworks.UID) FROM solvedhomeworks,user WHERE solvedhomeworks.USERID = '".$userid."' AND solvedhomeworks.HWID = ".$hwid;
		$result4 = mysql_query($SQL);
		$number_of_solved_hws = mysql_fetch_array($result4);
		if ($number_of_solved_hws[0] > 0){
			return 1;
		} else {
			return 0;
		}
	}