<?php
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
		$SQL = "INSERT INTO solvedhomeworks (USERID, HWID, TimeForSolve, Assessment, PleasureInPercents, LengthInPages, LearnedInPercents, IfCheating) VALUES (".$num_of_found_users_with_this_psw[1].", ".$_SESSION["hwid"].", ".$time_for_solving.", ".$assessment.", ".$pleasure.", ".$length.", ".$learned.", ".$cheat.")";
		//echo $SQL;
		$result = mysql_query($SQL);
		include "Convert_data_from_solvedhomeworks_to_sentence.php";
		$sentence = ConvertDataFromSolvedHomewokrsToSentence(Get_Logged_users_name(),$_SESSION["hwid"])[0];
		$percents = ConvertDataFromSolvedHomewokrsToSentence(Get_Logged_users_name(),$_SESSION["hwid"])[1];
		include "some_external_phps/show_solved_info.php";
	}
?>

</div>
</div>