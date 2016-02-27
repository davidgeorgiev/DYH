<?php
  function IfSomeHwIsSolved($userid,$hwid){
    $SQL = "SELECT COUNT(UID) FROM solvedhomeworks WHERE USERID = ".$userid." AND HWID = ".$hwid;
  	$MySelectCountResult = mysql_query($SQL);
  	$MySelectCount = mysql_fetch_array($MySelectCountResult);
    return $MySelectCount[0];
  }
?>
