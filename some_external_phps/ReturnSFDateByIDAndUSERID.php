<?php
  function ReturnRowForSelectById($id){
    if ($id == 1){return "StartS1";}
    else if ($id == 2){return "FinalS1";}
    else if ($id == 3){return "StartS2";}
    else if ($id == 4){return "FinalS2";}
    else{return -1;}

  }
  function ReturnSFDateByIDAndUSERID($type,$id,$userid){
    //echo $type.",".$id.",".$userid;
    $SQL = "SELECT ".ReturnRowForSelectById($id)." FROM schoolyear WHERE USERID = ".$userid;
    //echo "<p>".$SQL."</p>";
    $MyResult = mysql_query($SQL);
    $MyResultRow = mysql_fetch_array($MyResult);
    $DateToReturn = strtotime($MyResultRow[0]);
    if ($type == "Month"){
      return date('m',$DateToReturn);
    }else if($type == "Day"){
      return date('d',$DateToReturn);
    }else if($type == "Year"){
      return date('Y',$DateToReturn);
    }else{
      return -1;
    }
  }
?>
