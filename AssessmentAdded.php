<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/IfSomeHwIsSolved.php";
?>
<?php
	include "start_check.php";
	// if ($_SESSION['page'] != 'check_width'){
		// header('Location: check_width_and_send_to.php?user='.$username.'&page='.$current_page_is) and exit;
	// }
	$_SESSION['page'] = "other";
?>
<body>
<div class="container">
<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
<?php

	$Assessment = $_POST["assessment"];
	//echo $Assessment;

	if(IfSomeHwIsSolved(Get_Logged_users_id(),$_GET["hwid"]) > 0){
		$SQL = "UPDATE solvedhomeworks SET solvedhomeworks.Assessment = ".$Assessment." WHERE solvedhomeworks.USERID = ".Get_Logged_users_id()." AND solvedhomeworks.HWID = ".$_GET["hwid"];
	}else{
		echo '<h1>За съжаление тази оценка не можа да се добави!</h1>';
	}
	//echo $SQL;
	$MyUpdate = mysql_query($SQL);
	header('Location: hws_waiting_assessment.php') and exit;

?>
</div>
</body>
