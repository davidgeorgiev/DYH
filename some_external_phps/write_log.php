<?php
	function AddOrUpdateLog($username){
		$if_thereis_a_log_by_this_user = mysql_query("SELECT COUNT(UID) FROM logs WHERE logs.USERNAME = '".$username."'");
		$my_res_log = mysql_fetch_array($if_thereis_a_log_by_this_user);
		if ($my_res_log[0] > 0){
			$UID_for_update = mysql_query("SELECT UID,NUM FROM logs WHERE logs.USERNAME = '".$username."'");
			$my_UID_for_update = mysql_fetch_array($UID_for_update);
			mysql_query("UPDATE logs SET NUM = ".($my_UID_for_update[1]+1)." WHERE USERNAME = '".$username."'");
		} else {
			mysql_query("INSERT INTO logs (USERNAME, NUM) VALUES ('".$username."', 1)");
		}
	}
?>