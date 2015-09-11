<?php
function ConvertWeekdayFromPhp($weekday, $FullOrNot){
	if ($FullOrNot == 0){
		switch($weekday){
			case 1: $convertered_weekday = 'П';
			break;
			case 2: $convertered_weekday = 'В';
			break;
			case 3: $convertered_weekday = 'С';
			break;
			case 4: $convertered_weekday = 'Ч';
			break;
			case 5: $convertered_weekday = 'П';
			break;
			case 6: $convertered_weekday = 'С';
			break;
			case 0: $convertered_weekday = 'Н';
			break;
		}
	} else {
		switch($weekday){
			case 1: $convertered_weekday = 'Понеделник';
			break;
			case 2: $convertered_weekday = 'Вторник';
			break;
			case 3: $convertered_weekday = 'Сряда';
			break;
			case 4: $convertered_weekday = 'Четвъртък';
			break;
			case 5: $convertered_weekday = 'Петък';
			break;
			case 6: $convertered_weekday = 'Събота';
			break;
			case 0: $convertered_weekday = 'Неделя';
			break;
		}
	}
	return $convertered_weekday;
}
?>