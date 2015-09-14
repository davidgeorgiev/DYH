<?php

	function ConvertWeekday($weekday){
		switch($weekday){
			case 0: return 'ЗА ПОНЕДЕЛНИК';
			break;
			case 1: return 'ЗА ВТОРНИК';
			break;
			case 2: return 'ЗА СРЯДА';
			break;
			case 3: return 'ЗА ЧЕТВЪРТЪК';
			break;
			case 4: return 'ЗА ПЕТЪК';
			break;
			case 5: return 'ЗА СЪБОТА';
			break;
			case 6: return 'ЗА НЕДЕЛЯ';
			break;
		}
	}
	function ReturnTypeOfHWinWords($type){
		switch($type){
			case 0: return "Домашно";
			break;
			case 1: return "Изпит";
			break;
			case 2: return "Напомняне";
			break;
		}
	}

?>