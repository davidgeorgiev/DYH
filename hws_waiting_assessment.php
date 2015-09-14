<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/PrintHWInfoInTableByID.php";
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
<?php include "main_menu.php";
	$MyUnappreciatedHomeworks = UnappreciatedHomeworks(Get_Logged_users_id());
	
	while($CurrentUnappreciatedHomeworkID = mysql_fetch_array($MyUnappreciatedHomeworks)){
		PrintHWInfoInTableByID($CurrentUnappreciatedHomeworkID[0]);
	}

?>



</body>