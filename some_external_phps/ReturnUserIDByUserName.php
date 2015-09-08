<?php
	function ReturnUserIdByUserName($username){
		$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$username."'";
		//echo $SQL;
		$result = mysql_query($SQL);
		$userid = mysql_fetch_array($result);
		
		return $userid[0];
	}
?>