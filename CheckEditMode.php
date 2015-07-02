<?php
	$SQL = "SELECT COUNT(USER.NAME) FROM USER WHERE USER.NAME = '".$username."' AND USER.PASSWORD = '".$password."'";
	$result = mysql_query($SQL);
	$IsCorrect = mysql_fetch_array($result);
	if ($IsCorrect[0] > 0) {
		$EditMode = 1;
	} else {
		$EditMode = 0;
	}
?>