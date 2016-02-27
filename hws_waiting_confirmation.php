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
		header('Location: check_width_and_send_to.php?user='.$username.'&page=hws_waiting_confirmation') and exit;
	}
	$_SESSION['page'] = "other";
?>
<body>
<div class="container">
<?php include "main_menu.php";
	$MySuggestedHomeworks = SuggestedHomeworks(Get_Logged_users_id());

	while($CurrentSuggestedHomeworkID = mysql_fetch_array($MySuggestedHomeworks)){
		echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);margin-top:50px;">';
		if ($_GET["height"] > $_GET["width"]){
			PrintHWInfoInTableByID($CurrentSuggestedHomeworkID[0], $timezone, 0, $username, Get_Logged_users_id());
		} else {
			PrintHomeworksTimeline($CurrentSuggestedHomeworkID[0], $timezone, 0, $username, Get_Logged_users_id());
		}
		echo '<a href = "accept_hw_suggestion.php?hwid='.$CurrentSuggestedHomeworkID[0].'"><button class="btn btn-default" style = "width:50%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-ok"></span> Приемам</button></a>';
		echo '<a href = "refuse_hw_suggestion.php?hwid='.$CurrentSuggestedHomeworkID[0].'"><button class="btn btn-default" style = "width:50%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-remove"></span> Отхвърлям</button></a>';
		echo '</div>';
	}


?>



</body>
