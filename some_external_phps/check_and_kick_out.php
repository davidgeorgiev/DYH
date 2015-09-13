<?php
	function CheckFriendShipByNameAndKickOut($username, $loggedUserID){
		$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$username."'";
		$Result = mysql_query($SQL);
		$userid = mysql_fetch_array($Result);
		if ($userid[0] != $loggedUserID){
			if (CheckIfFriends($userid[0], $loggedUserID) == 0){
				header('Location: you_are_not_friends.php?secured_user='.$username) and exit;
			}
		}
	
	}
?>