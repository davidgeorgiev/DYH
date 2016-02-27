<?php
  include "ReturnSFDateByIDAndUSERID.php";
  function MakeSimpleDatePicker($Label,$StylesActive,$postnamesid="",$YearParameter1=6,$YearParameter2=20,$customstyleM="",$customstyleD="",$customstyleY="",$add_sf=0){
    echo '<div class="form-group" >';
      echo '<label for="text"';
      if ($StylesActive){echo 'id = "descURL"';}
      if ($StylesActive){echo 'style = "font-family:Exo-Thin;font-size:20px;margin-left:20px;margin-bottom:15px;margin-top:0px;"';}
      echo '>'.$Label.'</label>';
      echo '<select class="form-control"';
      if ($StylesActive){echo 'id = "MyInputBox"';}
      if ($StylesActive){echo 'style = "margin-left:22px;float:left;width:40%;margin-right:21px;"';}
      if (!$StylesActive){echo 'style = "'.$customstyleM.'"';}
      echo ' name="Month'.$postnamesid.'">';
      $myvalue = 0;
      $textstr = "Месец";
      if ($add_sf){
        $SQL = "SELECT COUNT(*) FROM schoolyear WHERE USERID = ".Get_Logged_users_id();
        $IfThereIsSFResult = mysql_query($SQL);
        $IfThereIsSF = mysql_fetch_array($IfThereIsSFResult);
        $IfThereIsSF = $IfThereIsSF[0];
      }
      if (($add_sf)&&($IfThereIsSF>0)){
        $TempPostNamesId = (int)$postnamesid;
        $myvalue = ReturnSFDateByIDAndUSERID("Month",$TempPostNamesId,Get_Logged_users_id());
        $textstr = ConvertMonthToWord($myvalue);
      }
      echo '<option value="'.$myvalue.'">'.$textstr.'</option>';
      for ($counter = 1; $counter <= 12; $counter++){
        if ($counter < 10){
          $Zero = "0";
        } else {
          $Zero = "";
        }
        echo '<option value="'.$Zero.$counter.'">'.ConvertMonthToWord($counter).'</option>';
      }
      echo '</select>';
      echo '<select class="form-control"';
      if ($StylesActive){echo 'id = "MyInputBox"';}
      if ($StylesActive){echo 'style = "width:40%;"';}
      if (!$StylesActive){echo 'style = "'.$customstyleD.'"';}
      echo 'name="Day'.$postnamesid.'">';
      $myvalue = 0;
      $textstr = "Ден";
      if (($add_sf)&&($IfThereIsSF>0)){
        $TempPostNamesId = (int)$postnamesid;
        $myvalue = ReturnSFDateByIDAndUSERID("Day",$TempPostNamesId,Get_Logged_users_id());
        $textstr = $myvalue;
      }
      echo '<option value="'.$myvalue.'">'.$textstr.'</option>';
      for ($counter = 1; $counter <= 31; $counter++){
        if ($counter < 10){
          $Zero = "0";
        } else {
          $Zero = "";
        }
        echo '<option value="'.$Zero.$counter.'">'.$counter.'</option>';
      }
      echo '</select>
        <select class="form-control"';
        if ($StylesActive){echo 'id = "MyInputBox"';}
        if ($StylesActive){echo 'style = "margin-top:18px;"';}
        if (!$StylesActive){echo 'style = "'.$customstyleY.'"';}
        echo 'name="Year'.$postnamesid.'">';
        $myvalue = 0;
        $textstr = "Година";
        if (($add_sf)&&($IfThereIsSF>0)){
          $TempPostNamesId = (int)$postnamesid;
          $myvalue = ReturnSFDateByIDAndUSERID("Year",$TempPostNamesId,Get_Logged_users_id());
          $textstr = $myvalue;
        }
          echo '<option value="'.$myvalue.'">'.$textstr.'</option>';
          for ($counter = (date("Y")-$YearParameter1); $counter > (date("Y")-$YearParameter2); $counter--){
            echo '<option value="'.$counter.'">'.$counter.'</option>';
          }
      echo '</select></div>';
  }
?>
