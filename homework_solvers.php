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
	$SQL = "SELECT user.Name, COUNT(solvedhomeworks.UID) FROM user, solvedhomeworks WHERE solvedhomeworks.USERID = user.UID AND solvedhomeworks.HWID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	while ($solvers_names = mysql_fetch_array($result)){
		if ($solvers_names[1] <= 0){
			echo 'Никой не е решил още това домашно :(';
		} else {
			echo $solvers_names[0];
		}
	}
?>

</div>
</div>