<?php

  function GetSubjectNameByID($subjectID){
    $SQL = "SELECT subjects.NAME FROM subjects WHERE subjects.UID = ".$subjectID;
    $MySubjectName = mysql_query($SQL);
    $MySubjectName = mysql_fetch_array($MySubjectName);
    return $MySubjectName[0];
  }

?>
