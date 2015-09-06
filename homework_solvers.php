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
	$SQL = "SELECT COUNT(solvedhomeworks.UID) FROM user, solvedhomeworks WHERE solvedhomeworks.USERID = user.UID AND solvedhomeworks.HWID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	$solvers_counter = mysql_fetch_array($result);
	$SQL = "SELECT user.Name FROM user, solvedhomeworks WHERE solvedhomeworks.USERID = user.UID AND solvedhomeworks.HWID = ".$_GET["hwid"];
	//echo $SQL;
	//print_r($solvers_counter);
	$result = mysql_query($SQL);
	include "Convert_data_from_solvedhomeworks_to_sentence.php";
	while ($solvers_names = mysql_fetch_array($result)){
		//print_r($solvers_names);
		if ($solvers_counter[0] <= 0){
			echo 'Никой не е решил още това домашно :(';
		} else {
			echo $solvers_names[0];
			$sentence = ConvertDataFromSolvedHomewokrsToSentence($solvers_names[0],$_GET["hwid"])[0];
			$percents = ConvertDataFromSolvedHomewokrsToSentence($solvers_names[0],$_GET["hwid"])[1];
			include "some_external_phps/show_solved_info.php";
		}
	}
?>

</div>
</div>