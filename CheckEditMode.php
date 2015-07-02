<?php
	$SQL = "SELECT COUNT(user.Name) FROM user WHERE user.Name = '".$username."' AND user.Password = '".$password."'";
	$result = mysql_query($SQL);
	$IsCorrect = mysql_fetch_array($result);
	if ($IsCorrect[0] > 0) {
		$EditMode = 1;
	} else {
		$EditMode = 0;
	}
?>