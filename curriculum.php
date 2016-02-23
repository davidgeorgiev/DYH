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
<?php echo '<div style = "margin-top:10px;">'; include "main_menu.php";echo '</div>';include "some_external_phps/checkIfHaveToShowOtherWeek.php";include "some_external_phps/ReturnUserIDByUserName.php";?>

<?php
		function ReturnMyLabelByEOWEEK($eoweek){
			if($eoweek == "OddWeekID"){
				return 'Показана е програмата за нечетна седмица';
			}else if($eoweek == "EvenWeekID"){
				return 'Показана е програмата за четна седмица';
			}else if($eoweek == "OtherWeekID"){
				return 'Показана е програмата за извънредна седмица';
			}else{
				return 'Не съществува такава програма';
			}
		}

		$eoweek = 0;
		$ddate = date("Y-m-d");
		$date = new DateTime($ddate);
		$week = $date->format("W");
		$ifcurrent = 0;
		$button_to_render = '<div><div class="dropdown" style = "float:left;padding-right:0px;margin-right:5px;margin-left:10px;">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:50px;height:40px;font-size:15px;">
      <span class="glyphicon glyphicon-wrench"></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
			<li><a href="curriculum.php?user='.$username.'">Покажи програмата за тази седмица</a></li>
      <li><a href="curriculum.php?user='.$username.'&eoweek=EvenWeekID">Покажи програмата за четна седмица</a></li>
      <li><a href="curriculum.php?user='.$username.'&eoweek=OddWeekID">Покажи програмата за нечетна седмица</a></li>
      <li><a href="curriculum.php?user='.$username.'&eoweek=OtherWeekID">Покажи програмата за извънредна седмица</a></li>
      </ul></div></div>';
	?>
		<div class="page-header">
		<?php echo $button_to_render;?>
		<h1>Учебната програма <small id = "smalltag" style = "color:#d2c9c6;">
		<?php
			if (isset($_GET["eoweek"])){
				$eoweek = $_GET["eoweek"];
			}else{
				if($week&1) {
					$eoweek = "OddWeekID";
					//$Label = 'Седмицата е нечетна';

				} else {
					$eoweek = "EvenWeekID";
					//$Label = 'Седмицата е четна';
				}
				//$eoweek = "OtherWeekID";
				if (CheckIfHaveToShowOtherWeek(ReturnUserIdByUserName($username)) == 1) {
					$eoweek = "OtherWeekID";
					//$Label = 'Седмицата е извънредна';
				}
			}
			echo '<span style = "color:#837d7c;">'.ReturnMyLabelByEOWEEK($eoweek).'</span>';
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
