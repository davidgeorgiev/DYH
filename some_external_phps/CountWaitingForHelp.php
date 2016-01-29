<?php
  function CountWaitingForHelp($userid){
    $SQL = "SELECT COUNT(UID) FROM neededhelp WHERE USERID = ".$userid;
    $NumOfWaitingResult = mysql_query($SQL);
    $FetchedNumOfWaitingResult = mysql_fetch_array($NumOfWaitingResult);
    $number_of_waiting_for_help = $FetchedNumOfWaitingResult[0];
    return $number_of_waiting_for_help;
  }
?>
