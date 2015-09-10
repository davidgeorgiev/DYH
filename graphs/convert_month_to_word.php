<?php
	function ConvertMonthToWord($monthnumber){
		switch ($monthnumber){
			case 1: $Word = "Януари";
			break;
			case 2: $Word = "Февруари";
			break;
			case 3: $Word = "Март";
			break;
			case 4: $Word = "Април";
			break;
			case 5: $Word = "Май";
			break;
			case 6: $Word = "Юни";
			break;
			case 7: $Word = "Юли";
			break;
			case 8: $Word = "Август";
			break;
			case 9: $Word = "Септември";
			break;
			case 10: $Word = "Октомври";
			break;
			case 11: $Word = "Ноември";
			break;
			case 12: $Word = "Декември";
			break;
		}
		
		return $Word;
	}
?>