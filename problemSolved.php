<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/FixURLLinks.php";
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
	$loggeduser = Get_Logged_users_id();
	$strforhelp = mysql_real_escape_string($_POST['strforhelp']);
	$problemid = $_GET["problemid"];

	$current_date_time = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

	$SQL = "INSERT INTO solvedhelp (USERID, STRFORHELP, DATE, PROBLEMID) VALUES (".$loggeduser.", '".$strforhelp."', '".$current_date_time."', '".$problemid."')";
	$MyInsertionResult = mysql_query($SQL);

	$SQL = "SELECT USERID FROM neededhelp WHERE UID = ".$problemid;
	$MyUserIDResult = mysql_query($SQL);
	$RowMyUserIDResult = mysql_fetch_array($MyUserIDResult);

	echo '<h2>Благодарим! Да се надяваме, че това ще помогне на '.GetFullUserNamebyID($RowMyUserIDResult[0],1).'</h2>';
?>
	</div>

</div>
