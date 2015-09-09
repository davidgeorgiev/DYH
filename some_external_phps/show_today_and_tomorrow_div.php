<?php
	
	$today_date = gmdate("Y-m-d", time() + 3600*($timezone+date("I")));
	//$tomorrow = date('Y-m-d', strtotime("tomorrow"));
	
	include "return_hw_info_by_id.php";
	include "SettingButtonTT.php";
	//include "checkIfHaveToShowOtherWeek.php";
	//include "ReturnUserIDByUserName.php";
	//echo '<div class = "todayandtomorrow" style = ""margin:100px;">';
	$date = new DateTime($today_date);
	$week = $date->format("W");
	
	function getWeekday($date) {
		return date('w', strtotime($date));
	}
	$today = getWeekday($today_date);
	$tomorrow = getWeekday($today_date)+1;
	
	if($week&1) {
		$eoweek = "OddWeekID";
		$Label = "Седмицата е нечетна</h1>";
	} else {
		$eoweek = "EvenWeekID";
		$Label = "<h1>Седмицата е четна</h1>";
	}
	if (CheckIfHaveToShowOtherWeek(ReturnUserIdByUserName($username)) == 1) {
		$eoweek = "OtherWeekID";
		$Label = "<h1>Седмицата е извънредна</h1>";
	}
	
	//$eoweek = "OtherWeekID";
	if ($EditMode == 1) {
		echo $button_to_render2;
	}
	echo '<div style = "text-align:center;border:1px solid #c8ccc1;border-radius: 5px;padding: 10px;color: #243746;background-color: white;font-size:24;font-family:Arial	;font-weight: bold;">'.$Label.'</div>';
	include "some_external_phps/print_curriculum.php";
	echo '<div class="row" style = "margin-left: 9%;margin-bottom: 10%;>';
		echo '<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">';
			echo '<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">';
			PrintCurriculum($_GET["user"], $eoweek, $today, "- днес");
			echo "</div>";
			echo '<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">';
			PrintCurriculum($_GET["user"], $eoweek, $tomorrow, "- утре");
			echo "</div>";
		echo "</div>";
	echo "</div>";
	
	$SQL = "SELECT homeworks.UID FROM homeworks WHERE homeworks.Date = '".$today_date."'";
	//echo $SQL;
	$MyHomeworksIdsResult = mysql_query($SQL);
	while ($MyHomeworksIds = mysql_fetch_array($MyHomeworksIdsResult)){
		//echo $MyHomeworksIds[0];
		$MyHomeworkInfoArray = returnHomeworkInfoByID($MyHomeworksIds[0]);
		//PrintMyHomeworkData($MyHomeworkInfoArray);
	}
	
	
	
	
	
?>	
<?php	
	function PrintMyHomeworkData($MyHomeworkInfoArray) {
		echo '<div style = "font-size:20px;color:black;">';
		echo "<p>//START PRINTING MAININFO</p>";
		echo "<p>Публикувано от ".$MyHomeworkInfoArray["MainInfo"]["Name"]."</p>";
		echo "<p>Заглавие ".$MyHomeworkInfoArray["MainInfo"]["Title"]."</p>";
		echo "<p>Описание ".$MyHomeworkInfoArray["MainInfo"]["Data"]."</p>";
		echo "<p>Дата ".$MyHomeworkInfoArray["MainInfo"]["Date"]."</p>";
		echo "<p>Тип ".$MyHomeworkInfoArray["MainInfo"]["Type"]."</p>";
		echo "<p>Важност ".$MyHomeworkInfoArray["MainInfo"]["Rank"]."</p>";
		echo "<p>Ден от седмицата ".$MyHomeworkInfoArray["MainInfo"]["WEEKDAY"]."</p>";
		echo "<p>Адрес към снимка ".$MyHomeworkInfoArray["MainInfo"]["IMGURL"]."</p>";
		echo "<p>Брой на коментарите ".$MyHomeworkInfoArray["MainInfo"]["NumOfComments"]."</p>";
		echo "<p>Брой на решенията ".$MyHomeworkInfoArray["MainInfo"]["NumOfSolvers"]."</p>";
		
		echo "<p>//START PRINTING COMMENTS</p>";
		foreach($MyHomeworkInfoArray["Comments"] as $value){
			echo "<p>Публикувано от ".$value["Name"]."</p>";
			echo "<p>Дата ".$value["Date"]."</p>";
			echo "<p>Съдържание ".$value["Data"]."</p>";
		}
		unset($value);
		
		echo "<p>//START PRINTING SOLVINGS</p>";
		for ($count = 0; $count < sizeof($MyHomeworkInfoArray["Solvings"]); $count++){
			$myCurrentArray = $MyHomeworkInfoArray["Solvings"];
			echo "<p>user.UID ".$MyHomeworkInfoArray["SolversIDs"][$count]."</p>";
			//echo "<p>".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["UID"]."</p>";
			echo "<p>Име ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Name"]."</p>";
			echo $MyHomeworkInfoArray["SolveSentences"][$MyHomeworkInfoArray["SolversIDs"][$count]];
			echo "<p>Време за решение ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["TimeForSolve"]."</p>";
			echo "<p>Оценка ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Assessment"]."</p>";
			echo "<p>Мнение ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["PleasureInPercents"]."</p>";
			echo "<p>Дължина в страници ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["LengthInPages"]."</p>";
			echo "<p>Научено ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["LearnedInPercents"]."</p>";
			echo "<p>Честност ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["IfCheating"]."</p>";
			echo "<p>Дата ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Date"]."</p>";
			echo "<p>Лично мнение ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["SomePersonalText"]."</p>";
		}
		for ($count = 0; $count < sizeof($MyHomeworkInfoArray["SolvingsPercents"]); $count++){
			$myCurrentArray = $MyHomeworkInfoArray["SolvingsPercents"];
			echo "<p>Време за решение в проценти ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["TimeForSolve"]."</p>";
			echo "<p>Оценка в проценти ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["Assessment"]."</p>";
			echo "<p>Мнение в проценти ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["PleasureInPercents"]."</p>";
			echo "<p>Дължина в страници в проценти ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["LengthInPages"]."</p>";
			echo "<p>Научено в проценти ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["LearnedInPercents"]."</p>";
			echo "<p>Честност в проценти ".$myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]]["IfCheating"]."</p>";
		}
	}
	//echo "<p>".$today."</p>";
	//echo "<p>".$tomorrow."</p>";
	//echo "</div>";
?>