<?php
	include "create_date_range.php";
	function CollectData($type_for_search, $username, $strDateFrom, $strDateTo){
		//$strDateFrom = date('Y-m-d', strtotime($year."W".$week_number.'-1'));
		//$strDateTo = date('Y-m-d', strtotime($year."W".$week_number.'-7'));
		
		//echo $strDateFrom;
		//echo $strDateTo;
		// $strDateFrom = date("Y-m-d",strtotime('monday this week'));
		// $strDateTo = date("Y-m-d",strtotime("sunday this week"));
		
		// echo 'from';
		// echo $strDateFrom;
		// echo 'to';
		// echo $strDateTo;
		
		$dates_array = createDateRangeArray($strDateFrom,$strDateTo);
		
		
		
		$daily_rank_sum_arr = array();
		foreach ($dates_array as &$value) {
			//echo $value;
			if (Get_Logged_users_id()){
				if ($type_for_search != -1){
					$SQL = "SELECT DISTINCT SUM(homeworks.Rank) FROM homeworks,user,uh,solvedhomeworks WHERE homeworks.Type = ".$type_for_search." AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$value."' AND homeworks.UID NOT IN (SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE solvedhomeworks.USERID = ".Get_Logged_users_id().")";
				} else {
					$SQL = "SELECT DISTINCT SUM(homeworks.Rank) FROM homeworks,user,uh,solvedhomeworks WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$value."' AND homeworks.UID IN (SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE solvedhomeworks.USERID = ".Get_Logged_users_id().")";
				}
			} else {
				$SQL = "SELECT DISTINCT SUM(homeworks.Rank) FROM homeworks,user,uh WHERE homeworks.Type = ".$type_for_search." AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$value."'";
			}
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
		
		$done_array = array();
		for ($i = 0;$i < sizeof($dates_array);$i++){
			array_push($done_array,(array($dates_array[$i],$daily_rank_sum_arr[$i]*10)));
		}
		
		return $done_array;
		// NOW LET'S USE $dates_array and $daily_rank_sum_arr for the graph :D
	}
?>