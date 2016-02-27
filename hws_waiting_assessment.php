<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/IfSomeHwIsSolved.php";
	include "some_external_phps/return_hw_info_by_id.php";
	include "some_external_phps/CheckIfUserIsSolver.php";
	include "some_external_phps/CheckMyAssessmentForHWWithID.php";
	include "some_external_phps/PrintHWInfoInTableByID.php";
	include "some_external_phps/PrintHomeworksTimeline.php";

?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="vertical-timeline/css/reset.css">
	<link rel="stylesheet" href="vertical-timeline/css/style.css">
	<script src="vertical-timeline/js/modernizr.js"></script>
</head>
<?php
	include "start_check.php";
	if ($_SESSION['page'] != 'check_width'){
		header('Location: check_width_and_send_to.php?user='.$username.'&page=hws_waiting_assessment') and exit;
	}
	$_SESSION['page'] = "other";
?>
<body>
<div class="container">
<?php include "main_menu.php";
	$MyUnappreciatedHomeworks = UnappreciatedHomeworks(Get_Logged_users_id());
	echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);margin-top:50px;">';
	while($CurrentUnappreciatedHomeworkID = mysql_fetch_array($MyUnappreciatedHomeworks)){
		if ($_GET["height"] > $_GET["width"]){
			PrintHWInfoInTableByID($CurrentUnappreciatedHomeworkID[0], $timezone, $EditMode, $username, Get_Logged_users_id());
		} else {
			PrintHomeworksTimeline($CurrentUnappreciatedHomeworkID[0], $timezone, $EditMode, $username, Get_Logged_users_id());
		}
	}
	echo '</div>';

?>



</body>
