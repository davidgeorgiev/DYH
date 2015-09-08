<?php
	function ConvertDataFromSolvedHomewokrsToSentence($ArraySolvings){
		$dateTimeArray = explode(" ", $ArraySolvings["Date"]);
		$mydatesolved = $dateTimeArray[0];
		$mytimesolved = $dateTimeArray[1];
		switch ($ArraySolvings["TimeForSolve"]) {
			case 0.083: $FirstPartOfSentence = "Реших го за пет минути на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 0.16: $FirstPartOfSentence = "Реших го за десет минути на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 0.33: $FirstPartOfSentence = "Реших го за двайсет минути на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 0.5: $FirstPartOfSentence = "Реших го за половин час на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 0.66: $FirstPartOfSentence = "Реших го за четиресет минути на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 0.83: $FirstPartOfSentence = "Реших го за петдесет минути на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 1: $FirstPartOfSentence = "Реших го за един час на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 1.25: $FirstPartOfSentence = "Реших го за час и четвърт на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 1.5: $FirstPartOfSentence = "Реших го за час и половина на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 1.75: $FirstPartOfSentence = "Реших го за почти два часа на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 2: $FirstPartOfSentence = "Реших го за около два часа на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 3: $FirstPartOfSentence = "Реших го за около три часа на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 4: $FirstPartOfSentence = "Реших го за около четири часа на ".$mydatesolved." в ".$mytimesolved." часа, ";
			break;
			case 5: $FirstPartOfSentence = "Трудих се неуморно около пет часа на ".$mydatesolved." и в крайна сметка успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 8: $FirstPartOfSentence = "Мъчих се цял ден да го решавам, направо се скапах от умора, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 9: $FirstPartOfSentence = "Мъчих се цяла нощ да го решавам, направо се скапах от умора, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 16: $FirstPartOfSentence = "Решавах го в продължение на два дни, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 24: $FirstPartOfSentence = "Решавах го в продължение на три дни, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 32: $FirstPartOfSentence = "Решавах го в продължение на четири дни, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 40: $FirstPartOfSentence = "Решавах го в продължение на пет дни, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 48: $FirstPartOfSentence = "Решавах го в продължение на почти една седмица, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 56: $FirstPartOfSentence = "Решавах го цяла седмица, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 112: $FirstPartOfSentence = "Решавах го цели две седмици, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 168: $FirstPartOfSentence = "Решавах го цели три седмици, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 224: $FirstPartOfSentence = "Мъчих се цял месец да го решавам, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 448: $FirstPartOfSentence = "Мъчих се два месеца да го решавам, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
			case 600: $FirstPartOfSentence = "Мъчих се няколко месеца да го решавам, направо се скапах, но все пак успях да го завърша в ".$mytimesolved." часа, ";
			break;
		}
		$SecondPartOfSentence = "като трябва да се има предвид, че ";
		switch ($ArraySolvings["PleasureInPercents"]) {
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
		switch ($ArraySolvings["LengthInPages"]) {
			case 0: $ThirdPartOfSentence = $ThirdPartOfSentence."по-малко от една страница";
			break;
			case 1: $ThirdPartOfSentence = $ThirdPartOfSentence."една страница";
			break;
			case 1.5: $ThirdPartOfSentence = $ThirdPartOfSentence."една страница и половина";
			break;
			case 2: $ThirdPartOfSentence = $ThirdPartOfSentence."две страници";
			break;
			case 2.5: $ThirdPartOfSentence = $ThirdPartOfSentence."две страници и половина";
			break;
			case 3: $ThirdPartOfSentence = $ThirdPartOfSentence."три страници";
			break;
			case 4: $ThirdPartOfSentence = $ThirdPartOfSentence."около четири страници";
			break;
			case 7: $ThirdPartOfSentence = $ThirdPartOfSentence."около седем страници";
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
		switch ($ArraySolvings["LearnedInPercents"]) {
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
		switch ($ArraySolvings["Assessment"]) {
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
		switch ($ArraySolvings["IfCheating"]) {
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
		return $FirstPartOfSentence.$SecondPartOfSentence.$ThirdPartOfSentence.$FourthPartOfSentence.$FifthPartOfSentence.$SixthPartOfSentence;
	}

	function returnHomeworkInfoByID($homeworkId) {
		$PosterUserNameSQL = "SELECT user.Name FROM user, uh WHERE uh.HWID = ".$homeworkId;
		$PosterUserNameResult = mysql_query($PosterUserNameSQL);
		$MyPosterUserName = mysql_fetch_array($PosterUserNameResult);
		
		$HWSQL = "SELECT homeworks.Title, homeworks.Data, homeworks.Type, homeworks.Date, homeworks.Rank, WEEKDAY(homeworks.Date) FROM homeworks WHERE homeworks.UID = ".$homeworkId;
		$hwresult = mysql_query($HWSQL);
		$myhwdata = mysql_fetch_array($hwresult);
		
		$URLSQL = "SELECT imgurl.URL FROM imgurl, hwimg WHERE hwimg.HWID = ".$homeworkId." AND hwimg.IMGURLID = imgurl.UID";
		$imgurlresult = mysql_query($URLSQL);
		$myhwimgurl = mysql_fetch_array($imgurlresult);
		
		$NumOfCommentsSQL = "SELECT COUNT(usercommenthomework.UID) FROM usercommenthomework WHERE usercommenthomework.HWID = ".$homeworkId;
		$NumOfCommentsResult = mysql_query($NumOfCommentsSQL);
		$MyNumOfComments = mysql_fetch_array($NumOfCommentsResult);
		
		$COMMENTSQL = "SELECT user.Name, comments.Date, comments.Data FROM user, comments, usercommenthomework WHERE usercommenthomework.HWID = ".$homeworkId." AND user.UID = usercommenthomework.USERID AND usercommenthomework.COMMENTID = comments.UID";
		$commentresult = mysql_query($COMMENTSQL);
		//$MyComments = mysql_fetch_array($commentresult);
		
		$COUNTSOLVERSSQL = "SELECT COUNT(solvedhomeworks.UID) FROM solvedhomeworks WHERE solvedhomeworks.HWID = ".$homeworkId;
		$NumOfSolversResult = mysql_query($COUNTSOLVERSSQL);
		$MyNumOfSolvers = mysql_fetch_array($NumOfSolversResult);
		
		$SOLVINGSSQL = "SELECT user.Name, solvedhomeworks.TimeForSolve, solvedhomeworks.Assessment, solvedhomeworks.PleasureInPercents, solvedhomeworks.LengthInPages, solvedhomeworks.LearnedInPercents, solvedhomeworks.IfCheating, solvedhomeworks.Date, solvedhomeworks.SomePersonalText, user.UID FROM solvedhomeworks, user WHERE solvedhomeworks.HWID = ".$homeworkId." AND user.UID = solvedhomeworks.USERID";
		//echo $SOLVINGSSQL;
		$SolvingsResult = mysql_query($SOLVINGSSQL);
		//$MySolvings = mysql_fetch_array($SolvingsResult);
		
		$ArrayToReturn = array();
		
		$HomeworkInfoArray = array();
		
		$SolvingArray = array();
		$SolvingsArray = array();
		$SolvingPercentsArray = array();
		$SolvingsPercentsArray = array();
		$SolversIDsArray = array();
		
		$CommentArray = array();
		$CommentsArray = array();
		
		$counter = 0;
		while ($MyComments = mysql_fetch_array($commentresult)) {
			$CommentArray["Name"] = $MyComments[0];
			$CommentArray["Date"] = $MyComments[1];
			$CommentArray["Data"] = $MyComments[2];
			
			$CommentsArray[$counter] = $CommentArray;
			$counter++;
		}
		
		while ($MySolvings = mysql_fetch_array($SolvingsResult)) {
			$MyUserUID = 							$MySolvings[9];
			array_push($SolversIDsArray, $MyUserUID);
			$SolvingArray["Name"] = 				$MySolvings[0];
			$SolvingArray["TimeForSolve"] = 		$MySolvings[1];
			$SolvingArray["Assessment"] = 			$MySolvings[2];
			$SolvingArray["PleasureInPercents"] = 	$MySolvings[3];
			$SolvingArray["LengthInPages"] = 		$MySolvings[4];
			$SolvingArray["LearnedInPercents"] = 	$MySolvings[5];
			$SolvingArray["IfCheating"] = 			$MySolvings[6];
			$SolvingArray["Date"] = 				$MySolvings[7];
			$SolvingArray["SomePersonalText"] = 	$MySolvings[8];
			
			$SolvingPercentsArray["TimeForSolve"] = (($SolvingArray["TimeForSolve"]*100)/3.75);
			$SolvingPercentsArray["Assessment"] = ((($SolvingArray["Assessment"]-2)*100)/4);
			$SolvingPercentsArray["PleasureInPercents"] = $SolvingArray["PleasureInPercents"];
			$SolvingPercentsArray["LengthInPages"] = (($SolvingArray["LengthInPages"]*100)/4.5);
			$SolvingPercentsArray["LearnedInPercents"] = $SolvingArray["LearnedInPercents"];
			$SolvingPercentsArray["IfCheating"] = (($SolvingArray["IfCheating"]*100)/5);
			
			$SolvingsPercentsArray[$MyUserUID] = $SolvingPercentsArray;
			$SolvingsArray[$MyUserUID] = $SolvingArray;
		}
		
		$HomeworkInfoArray["Name"] = $MyPosterUserName["Name"];
		$HomeworkInfoArray["Title"] = $myhwdata["Title"];
		$HomeworkInfoArray["Data"] = $myhwdata["Data"];
		$HomeworkInfoArray["Date"] = $myhwdata["Date"];
		$HomeworkInfoArray["Type"] = $myhwdata["Type"];
		$HomeworkInfoArray["Rank"] = $myhwdata["Rank"];
		$HomeworkInfoArray["WEEKDAY"] = $myhwdata[5];
		$HomeworkInfoArray["IMGURL"] = $myhwimgurl[0];
		$HomeworkInfoArray["NumOfComments"] = $MyNumOfComments[0];
		$HomeworkInfoArray["NumOfSolvers"] = $MyNumOfSolvers[0];
		
		$ArrayToReturn["MainInfo"] = $HomeworkInfoArray;
		$ArrayToReturn["Comments"] = $CommentsArray;
		$ArrayToReturn["Solvings"] = $SolvingsArray;
		$ArrayToReturn["SolversIDs"] = $SolversIDsArray;
		$ArrayToReturn["SolvingsPercents"] = $SolvingsPercentsArray;
		
		for ($counter = 0; $counter < sizeof($ArrayToReturn["Solvings"]); $counter++){
			$ArrayToReturn["SolveSentences"][$ArrayToReturn["SolversIDs"][$counter]] = ConvertDataFromSolvedHomewokrsToSentence($ArrayToReturn["Solvings"][$ArrayToReturn["SolversIDs"][$counter]]);
		}
		return $ArrayToReturn;
	}

?>