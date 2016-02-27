<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/head_for_datepickers.php";
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
<?php include "main_menu.php";?>

	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
<?php
		$date3 = $_POST["Year1"]."-".$_POST["Month1"]."-".$_POST["Day1"];
		$date4 = $_POST["Year2"]."-".$_POST["Month2"]."-".$_POST["Day2"];
		$date5 = $_POST["Year3"]."-".$_POST["Month3"]."-".$_POST["Day3"];
		$date6 = $_POST["Year4"]."-".$_POST["Month4"]."-".$_POST["Day4"];
	if(($date3!="1970-01-01")&&($date4!="1970-01-01")&&($date5!="1970-01-01")&&($date6!="1970-01-01")){
		$SQL = "SELECT COUNT(schoolyear.USERID) FROM schoolyear, user WHERE schoolyear.USERID = ".Get_Logged_users_id();
		$MyResult = mysql_query($SQL);
		$ThereIsAlreadySchoolyear = mysql_fetch_array($MyResult);

		//echo $ThereIsAlreadySchoolyear[0];

		if ($ThereIsAlreadySchoolyear[0] > 0) {
			$SQL = "UPDATE schoolyear SET Start = '".$date3."', Final = '".$date6."',StartS1 = '".$date3."',FinalS1 = '".$date4."',StartS2 = '".$date5."',FinalS2 = '".$date6."' WHERE schoolyear.USERID = ".Get_Logged_users_id();
		} else {
			$SQL = "INSERT INTO schoolyear (USERID, Start, Final, StartS1, FinalS1, StartS2, FinalS2) VALUES (".Get_Logged_users_id().", '".$date3."', '".$date6."', '".$date3."', '".$date4."', '".$date5."', '".$date6."')";
		}
		$MyInsertionResult = mysql_query($SQL);

		echo "<p>Успешно актуализиране на диапазона!<a href='home.php'> Върнете се в началото!</a></p>";
	} else {
		echo "<p id = 'StandartTitle'>НЕ СТЕ ПОПЪЛНИЛИ ВСИЧКИ ПОЛЕТА <a href = 'add_sf.php'>ВЪРНЕТЕ СЕ</a> И ОПИТАЙТЕ ОТНОВО!</p>";
	}
?>
	</div>

</div>
