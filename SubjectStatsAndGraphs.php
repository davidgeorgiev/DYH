<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/FixURLLinks.php";
  include "graphs/lib/inc/chartphp_dist.php";
  include "some_external_phps/PrintSubjectGraphStats.php";
	include "start_check.php";
	CheckFriendShipByNameAndKickOut($_GET["user"], Get_Logged_users_id());
	// if ($_SESSION['page'] != 'check_width'){
		// header('Location: check_width_and_send_to.php?user='.$username.'&page='.$current_page_is) and exit;
	// }
	$_SESSION['page'] = "other";
?>
<script src = "graphs/lib/js/jquery.min.js"></script>
<script src = "graphs/lib/js/chartphp.js"></script>
<link rel="stylesheet" href="graphs/lib/js/chartphp.css">
<body>
<div class="container">
<?php include "main_menu.php";?>

	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
<?php
	$CheckArg = 0;
	if($_GET["period"]=="year"){
  	$SQL = "SELECT Start,Final FROM schoolyear WHERE USERID = ".Get_Logged_users_id();
		$CheckArg = 1;
	}else if($_GET["period"]=="firstsemester"){
		$SQL = "SELECT StartS1,FinalS1 FROM schoolyear WHERE USERID = ".Get_Logged_users_id();
		$CheckArg = 1;
	}else if($_GET["period"]=="secondsemester"){
		$SQL = "SELECT StartS2,FinalS2 FROM schoolyear WHERE USERID = ".Get_Logged_users_id();
		$CheckArg = 1;
	}
	if($CheckArg == 1){
	  $MyStartFinalResult = mysql_query($SQL);
	  $MyStartFinalResultArr = mysql_fetch_array($MyStartFinalResult);
	  //print_r(MakeMyUserAverageSubjectStatisticsMonthsArray($MyStartFinalResultArr[0],$MyStartFinalResultArr[1],$_GET["SubjectID"],Get_Logged_users_id()));

	  //print_r($myArr);
	  PrintSubjectGraphStats($_GET["SubjectID"],$MyStartFinalResultArr[0],$MyStartFinalResultArr[1],GetUserIDbyName($_GET["user"]));
	} else {
		echo "<p id = 'StandartTitle'>ОПИТВАТЕ СЕ ДА ДОСТЪПИТЕ НЕВАЛИДЕН АДРЕС</p>";
	}
?>
  </div>

  </div>
</body>
