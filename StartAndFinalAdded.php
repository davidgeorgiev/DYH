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
	
	$date = mysql_real_escape_string($_POST['date1']);
	$date1 = date('Y-m-d',strtotime($date));
	$date = mysql_real_escape_string($_POST['date2']);
	$date2 = date('Y-m-d',strtotime($date));
	
	$SQL = "SELECT COUNT(schoolyear.USERID) FROM schoolyear, user WHERE schoolyear.USERID = ".Get_Logged_users_id();
	$MyResult = mysql_query($SQL);
	$ThereIsAlreadySchoolyear = mysql_fetch_array($MyResult);
	
	//echo $ThereIsAlreadySchoolyear[0];
	
	if ($ThereIsAlreadySchoolyear[0] > 0) {
		$SQL = "UPDATE schoolyear SET Start = '".$date1."', Final = '".$date2."' WHERE schoolyear.USERID = ".Get_Logged_users_id();
	} else {
		$SQL = "INSERT INTO schoolyear (USERID, Start, Final) VALUES (".Get_Logged_users_id().", '".$date1."', '".$date2."')";
	}
	$MyInsertionResult = mysql_query($SQL);
	
	echo "<p>Успешно актуализиране на диапазона</p>";
	
?>		
	</div>

</div>