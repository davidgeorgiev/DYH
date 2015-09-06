<?php
	function ConvertDataFromSolvedHomewokrsToSentence($myusername,$myhwid){
		$FirstPartOfSentence = $SecondPartOfSentence = $ThirdPartOfSentence = $FourthPartOfSentence = $FifthPartOfSentence = $SixthPartOfSentence = "";
		$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$myusername."'";
		$myuseridresult = mysql_query($SQL);
		$myuserid = mysql_fetch_array($myuseridresult);
		//echo $myuserid[0];
		$SQL = "SELECT solvedhomeworks.TimeForSolve, solvedhomeworks.Assessment, solvedhomeworks.PleasureInPercents, solvedhomeworks.LengthInPages, solvedhomeworks.LearnedInPercents, solvedhomeworks.IfCheating, solvedhomeworks.Date FROM solvedhomeworks WHERE solvedhomeworks.HWID = ".$myhwid." AND solvedhomeworks.USERID = ".$myuserid[0];
		//echo $SQL;
		$mydataresult = mysql_query($SQL);
		$mydata = mysql_fetch_array($mydataresult);
		//print_r($mydata);
		
		//echo $mydata["TimeForSolve"];
		//echo "sdsdf".$mydata[0];
		$mydatesolved = explode(" ", $mydata["Date"])[0];
		$mytimesolved = explode(" ", $mydata["Date"])[1];
		switch ($mydata["TimeForSolve"]) {
			case 0: $FirstPartOfSentence = "Реших го за по-малко от един час на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 1: $FirstPartOfSentence = "Реших го за един час на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 2: $FirstPartOfSentence = "Реших го за около два часа на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 5: $FirstPartOfSentence = "Трудих се неуморно повече от два часа на ".$mydatesolved." и в крайна сметка успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 12: $FirstPartOfSentence = "Мъчих се цял ден, или нощ беше не си спомням, да го решавам, направо се скапах от умора, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 44: $FirstPartOfSentence = "Решавах го в продължение на няколко дни, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 84: $FirstPartOfSentence = "Решавах го цяла седмица, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 252: $FirstPartOfSentence = "Мъчих се цял месец да го решавам, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 400: $FirstPartOfSentence = "Мъчих се няколко месеца да го решавам, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
		}
		$SecondPartOfSentence = "като трябва да се има предвид, че ";
		switch ($mydata["PleasureInPercents"]) {
			case 10: $SecondPartOfSentence = $SecondPartOfSentence."даже не си направих труда да го пиша като хората.";
			break;
			case 20: $SecondPartOfSentence = $SecondPartOfSentence."беше много гадно и даже не го реших цялото.";
			break;
			case 30: $SecondPartOfSentence = $SecondPartOfSentence."просто написах нещо колкото да отбия номера.";
			break;
			case 40: $SecondPartOfSentence = $SecondPartOfSentence."беше малко, но от сърце.";
			break;
			case 50: $SecondPartOfSentence = $SecondPartOfSentence."се старах, но не направих кой знае какво.";
			break;
			case 60: $SecondPartOfSentence = $SecondPartOfSentence."наистина много се старах да го напиша.";
			break;
			case 70: $SecondPartOfSentence = $SecondPartOfSentence."дадох най-доброто от себе си.";
			break;
			case 80: $SecondPartOfSentence = $SecondPartOfSentence."го написах с лекота и ми хареса много.";
			break;
			case 90: $SecondPartOfSentence = $SecondPartOfSentence."толкова ми хареса, че искам такива домашни всеки ден.";
			break;
			case 100: $SecondPartOfSentence = $SecondPartOfSentence."не мога да опиша колко много ми хареса.";
			break;
		}
		$ThirdPartOfSentence = " Написах ";
		switch ($mydata["LengthInPages"]) {
			case 0: $ThirdPartOfSentence = $ThirdPartOfSentence."по-малко от една страница";
			break;
			case 1: $ThirdPartOfSentence = $ThirdPartOfSentence."една страница";
			break;
			case 2: $ThirdPartOfSentence = $ThirdPartOfSentence."две страници";
			break;
			case 4: $ThirdPartOfSentence = $ThirdPartOfSentence."около четири страници";
			break;
			case 10: $ThirdPartOfSentence = $ThirdPartOfSentence."около десет страници";
			break;
			case 20: $ThirdPartOfSentence = $ThirdPartOfSentence."около двайсет страници";
			break;
			case 30: $ThirdPartOfSentence = $ThirdPartOfSentence."около трийсет страници";
			break;
			case 45: $ThirdPartOfSentence = $ThirdPartOfSentence."над трийсет страници";
			break;
			case 70: $ThirdPartOfSentence = $ThirdPartOfSentence."толкова много страници, че не мога да ги изброя, направо се скапах от умора и бяха ";
			break;
		}
		$ThirdPartOfSentence = $ThirdPartOfSentence." голям формат";
		switch ($mydata["LearnedInPercents"]) {
			case 10: $FourthPartOfSentence = ", но нищичко не научих, само си изгубих времето. ";
			break;
			case 20: $FourthPartOfSentence = ", но в главата ми е пълна каша. ";
			break;
			case 35: $FourthPartOfSentence = " и научих разни неща, но не много. ";
			break;
			case 50: $FourthPartOfSentence = " и научих толкова колкото ми трябваше да знам. ";
			break;
			case 95: $FourthPartOfSentence = " и научих всичко. ";
			break;
			case 100: $FourthPartOfSentence = " и научих всичко, даже още повече. ";
			break;
			case 110: $FourthPartOfSentence = " и толкова много научих, че не е истина. ";
			break;
			
		}
		switch ($mydata["Assessment"]) {
			case 1: $FifthPartOfSentence = "Нямаше оценка. ";
			break;
			case 2: $FifthPartOfSentence = "Писаха ми двойка, но другият път ще си я поправя на всяка цена :). ";
			break;
			case 3: $FifthPartOfSentence = "Писаха ми тройка, но това не е проблем, ще я повиша скоро :). ";
			break;
			case 4: $FifthPartOfSentence = "Писаха ми четворка. ";
			break;
			case 5: $FifthPartOfSentence = "Писаха ми петица, което е добре, но може да опитам и за 6 :). ";
			break;
			case 6: $FifthPartOfSentence = "Писаха ми шестица, толкова се радвам, че съм на седмото небе, но все пак знам, че не съм най-добрият ученик на света и не искам да се гордея с това че имам 6. ";
			break;
			
		}
		switch ($mydata["IfCheating"]) {
			case 1: $SixthPartOfSentence = "Все пак искам да си призная, че преписвах толкова много, че направо цялото е преписано.";
			break;
			case 2: $SixthPartOfSentence = "Все пак искам да си призная, че преписвах от части.";
			break;
			case 3: $SixthPartOfSentence = "Все пак искам да си призная, че преписвах малко.";
			break;
			case 4: $SixthPartOfSentence = "Все пак искам да си призная, че преписвах, но с учебна цел и наистина научих доста неща от това.";
			break;
			case 5: $SixthPartOfSentence = "Написах го без никакво преписване от никъде.";
			break;
			
		}
		$array_for_return = array();
		for ($MyCounter = 0; $MyCounter <= 5; $MyCounter++){
			$value = $mydata[$MyCounter]*100;
			switch ($MyCounter){
				case 0: $maxNumber = 12;
				break;
				case 1: $maxNumber = 4; $value-=200;
				break;
				case 2: $maxNumber = 100;
				break;
				case 3: $maxNumber = 10;
				break;
				case 4: $maxNumber = 100;
				break;
				case 5: $maxNumber = 5;
				break;
			}
			//echo "<p>".$value."/".$maxNumber."</p>";
			
			$array_for_return[$MyCounter] = $value/$maxNumber;
		}
		return array($FirstPartOfSentence.$SecondPartOfSentence.$ThirdPartOfSentence.$FourthPartOfSentence.$FifthPartOfSentence.$SixthPartOfSentence, $array_for_return,$mydata["Date"]);
	}
?>