<?php 
$timezone  = +2; //(GMT -5:00) EST (U.S. & Canada) 
echo gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I"))); 
//echo $rfc_1123_date; 
?>