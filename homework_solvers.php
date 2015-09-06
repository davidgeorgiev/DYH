<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="vertical-timeline/css/reset.css">
	<link rel="stylesheet" href="vertical-timeline/css/style.css">
	<script src="vertical-timeline/js/modernizr.js"></script>
</head>
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

<div class="container">
<?php include "main_menu.php"; ?>

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.6)">


<?php
	$SQL = "SELECT COUNT(solvedhomeworks.UID) FROM user, solvedhomeworks WHERE solvedhomeworks.USERID = user.UID AND solvedhomeworks.HWID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	$solvers_counter = mysql_fetch_array($result);
	$SQL = "SELECT user.Name, solvedhomeworks.Date FROM user, solvedhomeworks WHERE solvedhomeworks.USERID = user.UID AND solvedhomeworks.HWID = ".$_GET["hwid"]." ORDER BY Date DESC";
	//echo $SQL;
	//print_r($solvers_counter);
	$result = mysql_query($SQL);
	include "Convert_data_from_solvedhomeworks_to_sentence.php";
	echo '<section id="cd-timeline" class="cd-container">';
	while ($solvers_names = mysql_fetch_array($result)){
		echo '<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<img src="vertical-timeline/img/cd-icon-picture.svg" alt="Picture">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">';
		//print_r($solvers_names);
		if ($solvers_counter[0] <= 0){
			echo 'Никой не е решил още това домашно :(';
		} else {
			echo "<h2>".$solvers_names[0]."</h2>";
			//echo $solvers_names[1];
			$returned_array = ConvertDataFromSolvedHomewokrsToSentence($solvers_names[0],$_GET["hwid"]);
			$sentence = $returned_array[0];
			$percents = $returned_array[1];
			$date = $returned_array[2];
			include "some_external_phps/show_solved_info.php";
			echo "</div> <!-- cd-timeline-content -->";
			echo "</div> <!-- cd-timeline-block -->";
		}
	}
	echo "</section> <!-- cd-timeline -->";
	echo '<script src="vertical-timeline/jquery.min.js"></script>
	<script src="vertical-timeline/js/main.js"></script> <!-- Resource jQuery -->';
?>

</div>
</div>