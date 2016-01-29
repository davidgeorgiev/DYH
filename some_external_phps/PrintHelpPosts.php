<?php
	include "FixURLLinks.php";
	function PrintHelpPosts($only_me){

		$SQL = "SELECT Title,UID,USERID,HELPSTR,DATE FROM neededhelp ORDER BY DATE DESC";
		$AllHelpResult = mysql_query($SQL);
		while($RowAllHelpResult = mysql_fetch_array($AllHelpResult)){
			$if_print = 0;
			if ($only_me == 1){
				if (Get_Logged_users_id() == $RowAllHelpResult["USERID"]){
					$if_print = 1;
				}
			}else{
				if (Get_Logged_users_id() != $RowAllHelpResult["USERID"]){
					$if_print = 1;
				}
			}

			if ($if_print == 1){
				echo '<div id = "StandartBox" style = "margin-bottom:50px;">';
					echo '<h1 id = "StandartTitle" style = "margin-left:26px;">'.$RowAllHelpResult["Title"].'</h1>';
					echo'<div class="row" id = "URLBOX" style = "margin-top:20px;">';
							echo "<p id = 'StandartInsideText'>".$RowAllHelpResult["HELPSTR"]."</p><p id = 'StandartInsideText' class = 'StandartInsideTextDate'>Публикувано на: ".$RowAllHelpResult["DATE"]." от ".GetFullUserNamebyID($RowAllHelpResult["USERID"],1).' '.GetFullUserNamebyID($RowAllHelpResult["USERID"],2)."</p>";
					echo'</div>';
					if($only_me == 0){
						echo '<a href = "SolveAProblem.php?problemid='.$RowAllHelpResult["UID"].'"><button style = "width:100%;" class="btn btn-default">Подай ръка на '.GetFullUserNamebyID($RowAllHelpResult["USERID"],1).' '.GetFullUserNamebyID($RowAllHelpResult["USERID"],2).'</button></a>';
					}
					$SQL = "SELECT COUNT(UID) FROM solvedhelp WHERE PROBLEMID = ".$RowAllHelpResult["UID"];
					$NumberOfSolvingsHelpResult = mysql_query($SQL);
					$FetchedNumberOfSolvingsHelpResult = mysql_fetch_array($NumberOfSolvingsHelpResult);
					echo '<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#demo'.$RowAllHelpResult["UID"].'" style = "width:100%;">Отзовали се потребители - '.$FetchedNumberOfSolvingsHelpResult[0].'</button>
					<div id="demo'.$RowAllHelpResult["UID"].'" class="collapse">';
					echo '<div class = "SubjectStatistics">';
						$SQL = "SELECT USERID, STRFORHELP, DATE FROM solvedhelp WHERE PROBLEMID = ".$RowAllHelpResult["UID"];
						$AllSolvingsHelpResult = mysql_query($SQL);
						while($FetchedAllSolvingsHelpResult = mysql_fetch_array($AllSolvingsHelpResult)){
							echo '<div style = "padding:20px;">';
							echo '<h3 style = "margin-top:4px;">Публикувано от '.GetFullUserNamebyID($FetchedAllSolvingsHelpResult["USERID"],1).' '.GetFullUserNamebyID($FetchedAllSolvingsHelpResult["USERID"],2).' на '.$FetchedAllSolvingsHelpResult["DATE"].'</h3>';
							echo "<p>".$FetchedAllSolvingsHelpResult["STRFORHELP"]."</p>";
							echo '</div>';
						}
					echo '</div></div>';

					echo '</div>';

			}
		}
	}
?>
