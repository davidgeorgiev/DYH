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
<body>
<div class="container">
<?php include "main_menu.php";?>

<?php
		$eoweek = 0;
		$ddate = date("Y-m-d");
		$date = new DateTime($ddate);
		$week = $date->format("W");
	?>
	<div id = "my_page">
		<div class="page-header">
		<h1>Учебната програма <small id = "smalltag">
		<?php
			if($week&1) {
				$eoweek = "OddWeekID";
				echo 'Седмицата е нечетна';
			} else {
				$eoweek = "EvenWeekID";
				echo 'Седмицата е четна';
			}
		?>
		</small></h1>
		</div>
		<div class="row" style = "margin-left: 9%;margin-bottom: 10%;>
			<?php
				include "some_external_phps/print_curriculum.php";
				echo '<div class="col-sm-10" style = "margin:10px;background-color: white;border-radius:7px;">';
				for ($day = 1; $day <= 7; $day++) {
					echo '<div class="col-sm-10" style = "margin:10px;background-color: white;border-radius:7px;">';
					PrintCurriculum($_GET["user"], $eoweek, $day, "");
					echo "</div>";
				}
				echo "</div>";
			?>
		</div>
	
	</div>
</div>
</body>
</html>