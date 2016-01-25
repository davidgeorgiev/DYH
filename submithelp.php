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
	$helpstr = mysql_real_escape_string($_POST['helpstr']);
	$helptitle = mysql_real_escape_string($_POST['helptitle']);

	$current_date_time = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

	$SQL = "INSERT INTO neededhelp (USERID, HELPSTR, DATE, Title) VALUES (".$loggeduser.", '".$helpstr."', '".$current_date_time."', '".$helptitle."')";
	$MyInsertionResult = mysql_query($SQL);

?>
	<h1 id = 'StandartTitle' style = "margin-top:4px;"><?php echo $helptitle;?></h1>
	<div id = "StandartBox">
		<div class="row" id = "URLBOX" style = "margin-bottom:20px;margin-top:20px;">
			<?php
				echo "<p id = 'StandartInsideText'>".FixURLsData($helpstr)."</p><p id = 'StandartInsideText' class = 'StandartInsideTextDate'>Публикувано на: ".$current_date_time." от ".GetFullUserNamebyID($loggeduser,1)." ".GetFullUserNamebyID($loggeduser,2)."</p>";
			?>
		</div>
	</div>
	</div>

</div>
