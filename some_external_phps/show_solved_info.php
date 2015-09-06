<?php
echo $sentence;
$index = 0;
$title = "";
$style_of_prograssbar = "";
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
	if ($value > 100) {
		$visual_parameter = 100;
	} else {
		$visual_parameter = $value;
	}
	echo '<div class="progress">
		<div class="'.$style_of_prograssbar.'" role="progressbar" aria-valuenow="'.$visual_parameter.'"aria-valuemin="0" aria-valuemax="100" style="width:'.$visual_parameter.'%">
			'.number_format($value,0).'% '.$title.'
		</div>
	</div>';
	$index++;
}
unset($value);
?>