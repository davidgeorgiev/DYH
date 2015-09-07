<?php
	$today = date('Y-m-d');
	$tomorrow = date('Y-m-d', strtotime("tomorrow"));
	
	include "return_hw_info_by_id.php";
	$MyHomeworkInfoArray = returnHomeworkInfoByID(87);
	
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
	//echo "<p>".$today."</p>";
	//echo "<p>".$tomorrow."</p>";
	echo "</div>";
?>