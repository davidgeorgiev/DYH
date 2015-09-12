<?php

	function CheckIfFriends($userID1, $userID2) {
		
		$SQL = "SELECT COUNT(friends.UID) FROM friends WHERE ((friends.FirstPersonID = ".$userID1." AND friends.SecondPersonID = ".$userID2.") OR (friends.FirstPersonID = ".$userID2." AND friends.SecondPersonID = ".$userID1.")) AND friends.FirstConfirm = 1 AND SecondConfirm = 1";
		$MyCheckIfFriendsResult = mysql_query($SQL);
		$MyCheckIfFriends = mysql_fetch_array($MyCheckIfFriendsResult);
		
		return $MyCheckIfFriends[0];
	}
	function CheckIfRequestSent($SenderID, $RecieverID) {
		
		$SQL = "SELECT COUNT(friends.UID) FROM friends WHERE (friends.FirstPersonID = ".$SenderID." AND friends.SecondPersonID = ".$RecieverID.") AND friends.FirstConfirm = 1 AND friends.SecondConfirm = 0";
		$MyCheckIfSentResult = mysql_query($SQL);
		$MyCheckIfSent = mysql_fetch_array($MyCheckIfSentResult);
		
		return $MyCheckIfSent[0];
	}
	function CountWaitingRequests($userid){
		$SQL = "SELECT COUNT(friends.UID) FROM friends WHERE friends.SecondPersonID = ".$userid." AND friends.SecondConfirm = 0";
		$MyNumOfWaitingResult = mysql_query($SQL);
		$MyNumOfWaiting = mysql_fetch_array($MyNumOfWaitingResult);
		
		return $MyNumOfWaiting[0];
	}
	function WaitingRequests($userid){
		$SQL = "SELECT friends.FirstPersonID FROM friends WHERE friends.SecondPersonID = ".$userid." AND friends.SecondConfirm = 0";
		$MyWaitingResult = mysql_query($SQL);
		
		return $MyWaitingResult;
	}
	function AcceptRequest($SenderID, $RecieverID){
		$SQL = "UPDATE friends SET friends.SecondConfirm = 1 WHERE friends.SecondPersonID = ".$RecieverID." AND friends.FirstPersonID = ".$SenderID;
		$MyAcceptResult = mysql_query($SQL);
		
		return $MyAcceptResult;
	}
	function RefuseRequest($SenderID, $RecieverID){
		$SQL = "DELETE FROM friends WHERE friends.SecondPersonID = ".$RecieverID." AND friends.FirstPersonID = ".$SenderID;
		$MyRefuseResult = mysql_query($SQL);
		
		return $MyRefuseResult;
	}

?>