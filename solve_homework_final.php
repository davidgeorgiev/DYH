﻿<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
?>
<?php
	include "start_check.php";
	// if ($_SESSION['page'] != 'check_width'){
		// header('Location: check_width_and_send_to.php?user='.$username.'&page='.$current_page_is) and exit;
	// }
	$_SESSION['page'] = "other";
?>

<div class="container">
<?php include "main_menu.php"; ?>

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.6)">


<?php
	$loged = 0;
	$SQL = "SELECT COUNT(user.UID), user.UID FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
	//echo $SQL;
	$result = mysql_query($SQL);
	$num_of_found_users_with_this_psw = mysql_fetch_array($result);
	if ($num_of_found_users_with_this_psw > 0){
		$loged = 1;
	}
	
	
	$SQL = "SELECT user.UID FROM user WHERE user.Name = '".Get_Logged_users_name()."'";
	//echo $SQL;
	$result = mysql_query($SQL);
	$solvers_id = mysql_fetch_array($result);
	
	if ($loged == 1){
		//echo "logged";
		$time_for_solving = $_POST["time_for_solving"];
		$assessment = $_POST["assessment"];
		$pleasure = $_POST["pleasure"];
		$length = $_POST["length"];
		$learned = $_POST["learned"];
		$cheat = $_POST["cheat"];
		$timezone  = +2; //(GMT -5:00) EST (U.S. & Canada) 
		$current_date_time = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));
		$SQL = "INSERT INTO solvedhomeworks (USERID, HWID, TimeForSolve, Assessment, PleasureInPercents, LengthInPages, LearnedInPercents, IfCheating, Date) VALUES (".$num_of_found_users_with_this_psw[1].", ".$_SESSION["hwid"].", ".$time_for_solving.", ".$assessment.", ".$pleasure.", ".$length.", ".$learned.", ".$cheat.", '".$current_date_time."')";
		//echo $SQL;
		$result = mysql_query($SQL);
		include "Convert_data_from_solvedhomeworks_to_sentence.php";
		$returned_array = ConvertDataFromSolvedHomewokrsToSentence(Get_Logged_users_name(),$_SESSION["hwid"]);
		$sentence = $returned_array[0];
		$percents = $returned_array[1];
		$date = " ";
		echo '<div class="list-group">';
		echo '<a href="#" class="list-group-item active">';
			echo '<h4 class="list-group-item-heading">Благодарим ви за информацията :)!</h4>';
			echo '<p class="list-group-item-text">'.$current_date_time.'</p>';
		echo '</a>';
		echo '<a href="#" class="list-group-item unactive">';
		include "some_external_phps/show_solved_info.php";
		echo '</a>';
		echo '</div>';
	}
?>

</div>
</div>