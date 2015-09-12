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

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">


<?php
	include "some_external_phps/return_hw_info_by_id.php";
	$MyHomeworkInfoArray = returnHomeworkInfoByID($_GET["hwid"]);
	echo '<section id="cd-timeline" class="cd-container">';
	for ($count = 0; $count < sizeof($MyHomeworkInfoArray["Solvings"]); $count++){
		$currentUserID = $MyHomeworkInfoArray["SolversIDs"][$count];
		$myCurrentArray = $MyHomeworkInfoArray["Solvings"];
		
		//print_r($solvers_names);
		if ($MyHomeworkInfoArray["MainInfo"]["NumOfSolvers"] <= 0){
			echo 'Никой не е решил още това домашно :(';
		} else {
			$UserInfo = ReturnALLUserInfoByIdOrByName($myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Name"]);
			
			
			echo '<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">';
				echo '<a href = "home.php?user='.$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Name"].'">';
					echo '<div class="zoom_img_urls" class = "thumb1" style = "float:left;margin-top:-20px;margin-left:-12px;border:solid #d2c9c6;border-radius:50%;width:90px;height:90px;background: url('.$UserInfo["IMGURL"].') 50% 50% no-repeat;background-size: 100% 100%;z-index:100;">';
					echo '</div>';
				echo '</a>';
			echo '</div> <!-- cd-timeline-img -->';
			echo '<style>#MyHWBOX {background-color:#837d7c; border:solid white;border-width:2px;} #MyHWBOX:hover{background-color:#968e8d;}</style>';
			echo '<div class="cd-timeline-content" id = "MyHWBOX">';
			
			
			echo '<h2 style = "background-color:#d2c9c6;
											padding:10px;
											font-size:30px;
											color:#837d7c;
											border-radius:10px;
											font-family: Hattori;
											font-weight:bold;">'.$UserInfo["FirstName"]." ".$UserInfo["LastName"]."</h2>";
			//echo $solvers_names[1];
			$sentence = $MyHomeworkInfoArray["SolveSentences"][$currentUserID];
			$percents = $MyHomeworkInfoArray["SolvingsPercents"][$currentUserID];
			$date = $myCurrentArray[$currentUserID]["Date"];
			$SomePersonalText = $myCurrentArray[$currentUserID]["SomePersonalText"];
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