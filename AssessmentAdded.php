<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
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
<?php
	
	$Assessment = $_POST["assessment"];
	echo $Assessment;
	$SQL = "UPDATE solvedhomeworks SET solvedhomeworks.Assessment = ".$Assessment." WHERE solvedhomeworks.USERID = ".$_GET["userid"]." AND solvedhomeworks.HWID = ".$_GET["hwid"];
	echo $SQL;
	$MyUpdate = mysql_query($SQL);
	header('Location: hws_waiting_assessment.php') and exit;

?>
