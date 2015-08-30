<?php
	
	
	$days = " ";
	$hardness = " ";
	
	if ($ViewAllDays == true) {
		$SQL = "SELECT DISTINCT homeworks.Date FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID ORDER BY homeworks.Date ASC";
	} else {
		$SQL = "SELECT DISTINCT homeworks.Date FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date >= '".date("Y-m-d")." 00:00:00' ORDER BY homeworks.Date ASC";
	}
	$result = mysql_query($SQL);
	
	$temp_dates = array();
	while ($dates = mysql_fetch_array($result)) {
		array_push($temp_dates, $dates[0]);
		//echo $dates[0];
	}
	$max = sizeof($temp_dates);
	$strDateFrom = $temp_dates[0];
	$strDateTo = $temp_dates[$max - 1];
	
	// echo 'from';
	// echo $strDateFrom;
	// echo 'to';
	// echo $strDateTo;
	
	$dates_array = createDateRangeArray($strDateFrom,$strDateTo);
	
	$daily_rank_sum_arr = array();
	foreach ($dates_array as &$value) {
		//echo $value;
		
		$SQL = "SELECT DISTINCT SUM(homeworks.Rank) FROM homeworks,user,uh WHERE homeworks.Type = ".$type_for_search." AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$value."'";
		//echo $SQL;
		$result = mysql_query($SQL);
		$daily_rank_sum = mysql_fetch_array($result);
		if ($daily_rank_sum[0] <= 0) {
			$daily_rank_sum[0] = 0;
		}
		array_push($daily_rank_sum_arr, $daily_rank_sum[0]);
	}
	unset($value);
	
	foreach ($daily_rank_sum_arr as &$value) {
		//echo $value;
	}
	unset($value);
	
	// NOW LET'S USE $dates_array and $daily_rank_sum_arr for the graph :D
?>