﻿<?php
$index = 0;
$title = "";
$style_of_prograssbar = "";
echo '<div>';
echo '<div class="dropdown" style = "width:40%;padding-right:10px;margin-top:10px;">';
echo '<button class="btn btn-default dropdown-toggle" style = "min-width:100%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:-22px;" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
echo 'Графики';
echo '</button>';
echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style = "width:280%;" id = "MyHWBOX">';
foreach ($percents as $value) {
	
	switch ($index){
		case 0: $title = "Време";
		break;
		case 1: $title = "Оценка";
		break;
		case 2: $title = "Мнение";
		break;
		case 3: $title = "Дължина";
		break;
		case 4: $title = "Научено";
		break;
		case 5: $title = "Честност";
		break;
	}
	if (($value <= 25) && ($value > 0)) {
		$style_of_prograssbar = "progress-bar progress-bar-danger";
	} else if (($value <= 50) && ($value > 25)) {
		$style_of_prograssbar = "progress-bar progress-bar-warning";
	} else if (($value <= 75) && ($value > 50)) {
		$style_of_prograssbar = "progress-bar progress-bar-info";
	} else if ($value > 75) {
		$style_of_prograssbar = "progress-bar progress-bar-success";
	}
	if (($title == "Оценка") && ($value < 0)){
		$value = 0;
	}
	if ($value > 100) {
		$visual_parameter = 100;
	} else {
		$visual_parameter = $value;
	}
	echo '<div style = "float:left;margin:10px;border-radius:10px;border:solid #c8ccc1;padding-left:15px;padding-right:15px;"><p style = "font-size:16px;text-align:center;color:gray;">'.$title.'</p><div class="progress" style = "text-align:center;">
		
		<div class="'.$style_of_prograssbar.'" role="progressbar" aria-valuenow="'.$visual_parameter.'"aria-valuemin="0" aria-valuemax="100" style="width:'.$visual_parameter.'%">
			<span style = "color:black;">'.number_format($value,0).'%</span>
		</div>
		
	</div></div>';
	$index++;
}
echo '</ul>';
echo '</div>';
echo '<p style = "color:#514d4b;font-family: Arial;font-size:20px;margin-top:20px;">'.$sentence.'</p>';
echo '<p style = "color:#514d4b;font-family: Arial;font-size:25px;margin-top:20px;">'.$SomePersonalText.'</p>';
echo '<span class="cd-date" style="color:#6f6967;font-family: MyDays;font-size:22px;font-weight:bold;">'.$date.'</span>';
echo "</div>";
unset($value);
?>