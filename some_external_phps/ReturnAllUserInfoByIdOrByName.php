<?php

	function ReturnALLUserInfoByIdOrByName($username = "", $userid = 0){
		
		if (strlen($username) > 0){
			$EndOfQuery = "user.Name = '".$username."'";
		} else if ($userid > 0){
			$EndOfQuery = "user.UID = ".$userid;
		}
		
		$SQL = "SELECT user.Name, user.FirstName, User.LastName, user.Password, user.IMGURL, user.Birthday, user.Text, user.Sex FROM user WHERE ".$EndOfQuery ;
		$MyUserInfoResult = mysql_query($SQL);
		$MyUserInfo = mysql_fetch_array($MyUserInfoResult);
		
		
		return $MyUserInfo;
	}

?>