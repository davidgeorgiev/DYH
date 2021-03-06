﻿<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	include "css/progressbar.php";
	include "some_external_phps/CheckIfUserIsSolver.php";
	include "graphs/lib/inc/chartphp_dist.php";
?>
	<script src = "graphs/lib/js/jquery.min.js"></script>
	<script src = "graphs/lib/js/chartphp.js"></script>
	<link rel="stylesheet" href="graphs/lib/js/chartphp.css">
	
<?php	
	
	function MakeAreaChart($MyPercentSolvingsArray){
		$p = new chartphp();

		$p->data = array(array(array('Време',$MyPercentSolvingsArray["TimeForSolve"]), array('Оценка',$MyPercentSolvingsArray["Assessment"]), array('Мнение',$MyPercentSolvingsArray["PleasureInPercents"]), array('Дължина',$MyPercentSolvingsArray["LengthInPages"]), array('Научено',$MyPercentSolvingsArray["LearnedInPercents"]), array('Честност',$MyPercentSolvingsArray["IfCheating"])));
		$p->chart_type = "area";

		//print_r(array(array(array('Време',$MyPercentSolvingsArray["TimeForSolve"]), array('Оценка',$MyPercentSolvingsArray["Assessment"]), array('Мнение',$MyPercentSolvingsArray["PleasureInPercents"]), array('Дължина',$MyPercentSolvingsArray["LengthInPages"]), array('Научено',$MyPercentSolvingsArray["LearnedInPercents"]), array('Честност',$MyPercentSolvingsArray["IfCheating"]))));
		// Common Options
		$p->title = "Средна стойност на всички решили";

		return $p->render('c1'); 
	}
	
	function AverageOfIndexInPercents($MyHomeworkInfoArray, $index){
		$ReturnAverageVal = 0;
		for ($count = 0; $count < sizeof($MyHomeworkInfoArray["Solvings"]); $count++){
			$ReturnAverageVal += $MyHomeworkInfoArray["SolvingsPercents"][$MyHomeworkInfoArray["SolversIDs"][$count]][$index];
		}
		return $ReturnAverageVal/$count;
	}
	
	function MakeAverageArray($MyHomeworkInfoArray){
		$DoneArray = array();
		$DoneArray["TimeForSolve"] = AverageOfIndexInPercents($MyHomeworkInfoArray, "TimeForSolve");
		$DoneArray["Assessment"] = AverageOfIndexInPercents($MyHomeworkInfoArray, "Assessment");
		$DoneArray["PleasureInPercents"] = AverageOfIndexInPercents($MyHomeworkInfoArray, "PleasureInPercents");
		$DoneArray["LengthInPages"] = AverageOfIndexInPercents($MyHomeworkInfoArray, "LengthInPages");
		$DoneArray["LearnedInPercents"] = AverageOfIndexInPercents($MyHomeworkInfoArray, "LearnedInPercents");
		$DoneArray["IfCheating"] = AverageOfIndexInPercents($MyHomeworkInfoArray, "IfCheating");
		foreach ($DoneArray as $key => $value){
			if ($DoneArray[$key] > 100){
				$DoneArray[$key] = 100;
			}
			if ($DoneArray[$key] < 0){
				$DoneArray[$key] = 0;
			}
		}
		unset($value);
		//print_r($DoneArray);
		return $DoneArray;
	}
	include "some_external_phps/PrintPercentageBar.php";
?>
<body>


<?php
	$comment_mode = "on";
	
	if (isset($_SESSION['psw']) && isset($_SESSION['name'])) {
		$password = $_SESSION['psw'];
		$username = $_SESSION['name'];
	}
	
	$SQL = "SELECT COUNT(user.Name) FROM user WHERE user.Password = '".$password."'";
	$result = mysql_query($SQL);
	$number_of_users = mysql_fetch_array($result);
	
	if ($number_of_users[0] <= 0) {
		$comment_mode = "off";
	}
	if (isset($_SESSION['psw']) && isset($_SESSION['name'])) {
		$password = $_SESSION['psw'];
		$username = $_SESSION['name'];
	}
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;
	$_SESSION['page'] = "other";

	include "CheckEditMode.php";
	
	$hwid = $_GET['hwid'];
	
	$_SESSION['hwid'] = $_GET['hwid'];
?>



<div class="container">
<?php include "main_menu.php";include "some_external_phps/return_hw_info_by_id.php"; ?>

<?php
	if ($EditMode == 1){
		$Trash = '<a href="delete_hw_confirm.php?hwid='.$_GET['hwid'].'&class='.$username.'&page=homeworks_time_chart" style = "text-decoration:none;color:white;font-size:15px;padding:4px;"><span class="glyphicon glyphicon-trash"></span> </a>';
		$Pencil = '<a href="edit_hw.php?hwid='.$_GET['hwid'].'&class='.$username.'" style = "text-decoration:none;color:white;font-size:15px;"><span class="glyphicon glyphicon-pencil"></span> </a>'; 
	} else {
		$Trash = "";
		$Pencil = "";
	}
	$MyHomeworkInfoArray = returnHomeworkInfoByID($hwid);
	echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';
	
	echo '<div class="page-header">';
		switch($MyHomeworkInfoArray["MainInfo"]["WEEKDAY"]){
			case 0: $weekday = 'ЗА ПОНЕДЕЛНИК';
			break;
			case 1: $weekday = 'ЗА ВТОРНИК';
			break;
			case 2: $weekday = 'ЗА СРЯДА';
			break;
			case 3: $weekday = 'ЗА ЧЕТВЪРТЪК';
			break;
			case 4: $weekday = 'ЗА ПЕТЪК';
			break;
			case 5: $weekday = 'ЗА СЪБОТА';
			break;
			case 6: $weekday = 'ЗА НЕДЕЛЯ';
			break;
		}
		if ($MyHomeworkInfoArray["MainInfo"]["Date"] == gmdate("Y-m-d", time() + 3600*($timezone+date("I")))) {
			$weekday2 = '(днес) ';
		} else {
			$weekday2 = '';
		}
		echo '<h1 style = "color:#3e3a3a;">'.$weekday.' <small id = "smalltag">'.$weekday2.$MyHomeworkInfoArray["MainInfo"]["Date"].'</small></h1>';
		echo '</div>';
		echo '<div class="row">';
		
		echo '	<div class="col-sm-7" style = "margin:10px;background-color: #d2c9c6;border-radius:0px;padding:0px;">';
			switch($MyHomeworkInfoArray["MainInfo"]["Rank"]){
				case 1: $color = "white";
				break;
				case 2: $color = "#a8f293";
				break;
				case 3: $color = "#ffb495";
				break;
				case 4: $color = "#fa7194";
				break;
			}
			
			switch ($MyHomeworkInfoArray["MainInfo"]["Type"]) {
				case 0: $MyType = "Домашно по ";
				break;
				case 1: $MyType = "Изпит по ";
				break;
				case 2: $MyType = "Напомняне по ";
				break;
			}
			
			echo '<h3 style = "background-color: #837d7c;border-width:thin;border-top-left-radius: 0px;border-top-right-radius: 0px; padding: 10px;margin:auto;color:#d2c9c6;"><span style = "background-color:#6b6665;padding:9px;margin-left:-10px;">'.$Trash.$Pencil."</span>".'<span style = "padding-left:13px;">'.$MyType.$MyHomeworkInfoArray["MainInfo"]["Title"].'</span>'.'</h3>';
			if (strlen($MyHomeworkInfoArray["MainInfo"]["IMGURL"]) > 0) {
				echo ' <p style = "border-width:thin; border-style: solid;background-color:#d2c9c6;border-color: #BEBEBE;border-radius:5px; padding: 0px;"><a href = "'.$MyHomeworkInfoArray["MainInfo"]["IMGURL"].'" rel="lightbox"><img src="'.$MyHomeworkInfoArray["MainInfo"]["IMGURL"].'" style = "border-bottom:solid #837d7c;border-width:1px;" alt="HomeWork image" width="100%"></a></p>';
			}
			echo '	<p style = "background-color:#d2c9c6;border-radius:5px; padding: 0px;font-size:18px;padding:20px;color:#565252">'.$MyHomeworkInfoArray["MainInfo"]["Data"].'</p>';
		
		$MyPercentage = ($MyHomeworkInfoArray["MainInfo"]["Rank"]*25);
					
		echo '<div id="progressbar">';
		echo '<div style = "width: '.$MyPercentage.'%;color:#514d4c;font-weight:bold;white-space: nowrap;">';
		echo 'Важност '.$MyPercentage.'%';
		echo '</div>';
		echo '</div>';
		
		echo '<div style="margin-top:50px;margin-left:20px;width:100%;height:400px;min-width:100px;">';
		
			echo MakeAreaChart(MakeAverageArray($MyHomeworkInfoArray));
			
		echo '</div>';
		
		echo '</div>';
		
		
		echo '	<div class="col-sm-4" style = "margin:10px;background-color: #837d7c;border-radius:0px;">';
			echo '	<h3 style = "color:#d2c9c6;padding: 5px;font-weight:-900;">Коментари</h3>';
			
			if ($comment_mode == "on") {
				include "comment_form.php";
			}
			
			echo '<div style = "overflow-y: scroll; height:320px;padding:12px;margin-bottom:15px;">';
			foreach($MyHomeworkInfoArray["Comments"] as $value){
				$UserInfo = ReturnALLUserInfoByIdOrByName($value["Name"]);
				echo '<div style = "background-color:#746f6e;border:solid white;border-width:1px;padding: 9px;margin-bottom:20px;">';
				echo '	<p style = " font-weight: bold;color:white;">'.$UserInfo["FirstName"]." ".$UserInfo["LastName"].'<span style = "color:#d2c9c6;font-size:10px;"> (Публикувано на '.$value["Date"].')</span></p>';
				echo '	<p style = "background-color:#746f6e;color:#d2c9c6;border-radius:5px; padding: 9px;">'.FixURLsData($value["Data"]).'</p>';
				echo '</div>';
			}
			unset($value);
			echo '</div>';
		echo '</div>';
		
		echo '</div>';
	
?>



</div>

<?php

	echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';
	
	if (CheckIfUserIsSolver(Get_Logged_users_id(), $_GET['hwid']) == 1){
		$SolveButton = '<span style = "background-color:#6b6665;padding:12px;margin-left:-10px;"><button class="btn btn-default" style = "background:#6b6665;border:none;color:#d2c9c6;" >Решeно</button></span>';
	} else {
		$SQL = "SELECT user.Name FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
		//echo $SQL;
		$current_logged_in_username_result = mysql_query($SQL);
		$current_logged_in_username = mysql_fetch_array($current_logged_in_username_result);
		$SolveButton = '<a href = "solve_homework.php?hwid='.$_GET['hwid'].'&user='.$current_logged_in_username[0].'"><span style = "background-color:#6b6665;padding:12px;margin-left:-10px;"><button class="btn btn-default" style = "background:#6b6665;border:none;color:#d2c9c6;" >Реши</button></span></a>';
	}
	
	echo '<h3 style = "background-color: #837d7c;border-width:thin;border-top-left-radius: 0px;border-top-right-radius: 0px; padding: 10px;margin:auto;color:#d2c9c6;">'.$SolveButton.'<span style = "padding-left:13px;">Решавания - '.$MyHomeworkInfoArray["MainInfo"]["NumOfSolvers"].'</span></h3>';
			
			for ($count = 0; $count < sizeof($MyHomeworkInfoArray["Solvings"]); $count++){
				$myCurrentArray = $MyHomeworkInfoArray["Solvings"];
				
				$UserInfo = ReturnALLUserInfoByIdOrByName($myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Name"]);
				
				//echo "<h3>user.UID ".$MyHomeworkInfoArray["SolversIDs"][$count]."</h3";
				//echo "<p>".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["UID"]."</p>";
				echo '<div style = "padding-left:20px;padding-bottom:0px;padding-top:5px;background-color:#d2c9c6;">';
				echo '<a href = "home.php?user='.$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Name"].'">';
					echo '<div class="zoom_img_urls" class = "thumb1" style = "float:left;margin-top:14px;margin-left:5px;border:solid #d2c9c6;border-radius:50%;width:100px;height:100px;background: url('.$UserInfo["IMGURL"].') 50% 50% no-repeat;background-size: 100% 100%;z-index:100;">';
					echo '</div>';
				echo '</a>';
				echo '<h2 style = "color:#514d4c;">'.$UserInfo["FirstName"]." ".$UserInfo["LastName"].'<small id = "smalltag"> '.$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Date"]."</small></h2>";
				//echo '<div class="col-sm-4" style = "background-color:white;">';
				
				echo '<div style = "width:100%;background-color:#837d7c;padding:20px;font-size:18px;margin-left:-20px;color:white;">';
				echo '<p>'.$MyHomeworkInfoArray["SolveSentences"][$MyHomeworkInfoArray["SolversIDs"][$count]].'</p>';
				echo '<p style = "color:#514d4c;font-size:21px;">'.$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["SomePersonalText"]."</p>";
				echo '</div>';
				
				
				$myCurrentArray = $MyHomeworkInfoArray["SolvingsPercents"];
				
				
				PrintPercentagebar($MyHomeworkInfoArray, $myCurrentArray, $count, "TimeForSolve", "Време");
				PrintPercentagebar($MyHomeworkInfoArray, $myCurrentArray, $count, "Assessment", "Оценка");
				PrintPercentagebar($MyHomeworkInfoArray, $myCurrentArray, $count, "PleasureInPercents", "Мнение");
				PrintPercentagebar($MyHomeworkInfoArray, $myCurrentArray, $count, "LengthInPages", "Дължина");
				PrintPercentagebar($MyHomeworkInfoArray, $myCurrentArray, $count, "LearnedInPercents", "Научено");
				PrintPercentagebar($MyHomeworkInfoArray, $myCurrentArray, $count, "IfCheating", "Честност");
				
				
				
				
				
				//echo '</div>';
				echo '</div>';
			}
			
			
			
			for ($count = 0; $count < sizeof($MyHomeworkInfoArray["SolvingsPercents"]); $count++){
				
			}
			if ($count == 0){
				echo '<h3>Още не е решено от никого!</h3>';
			}
			
			
			
			
			
			echo '</div>';

?>
</body>
</html>
