<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	
	CheckFriendShipByNameAndKickOut($_GET["user"], Get_Logged_users_id());
?>
<?php
	include "start_check.php";
	// if ($_SESSION['page'] != 'check_width'){
		// header('Location: check_width_and_send_to.php?user='.$username.'&page='.$current_page_is) and exit;
	// }
	$_SESSION['page'] = "other";
?>
<body>
<?php include "main_menu.php";include "some_external_phps/checkIfHaveToShowOtherWeek.php";include "some_external_phps/ReturnUserIDByUserName.php";?>

<?php
		$eoweek = 0;
		$ddate = date("Y-m-d");
		$date = new DateTime($ddate);
		$week = $date->format("W");
	?>
		<div class="page-header">
		<h1>Учебната програма <small id = "smalltag" style = "color:#d2c9c6;">
		<?php
			if($week&1) {
				$eoweek = "OddWeekID";
				$Label = 'Седмицата е нечетна';
			} else {
				$eoweek = "EvenWeekID";
				$Label = 'Седмицата е четна';
			}
			//$eoweek = "OtherWeekID";
			
			if (CheckIfHaveToShowOtherWeek(ReturnUserIdByUserName($username)) == 1) {
				$eoweek = "OtherWeekID";
				$Label = 'Седмицата е извънредна';
			}
			echo $Label;
		?>
		</small></h1>
		</div>
			<?php
				include "some_external_phps/print_curriculum.php";
				
				for ($day = 1; $day <= 7; $day++) {
					echo '<div id = "Curriculum">';
					PrintCurriculum($_GET["user"], $eoweek, $day, "");
					echo '</div>';
				}
			?>
	
</body>
</html>