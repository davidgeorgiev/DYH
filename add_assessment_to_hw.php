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

	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">

		<div style = "background-color:#d2c9c6;margin-left:auto;margin-right:auto;margin-top:30px;margin-bottom:20px;width:100%;height:60%;border:solid #6d6765;border-width:thin;">
<?php
		echo '<h3 style = "margin-top:0px;border:solid #6d6765;text-align:center;background-color: #837d7c;border-width:thin;border-top-left-radius: 0px;border-top-right-radius: 0px; padding: 10px;color:#d2c9c6;font-size:35px;"><span style = "padding-left:13px;">Добавяне на оценка</span></h3>';
		echo '<form role="form" action=AssessmentAdded.php?userid='.Get_Logged_users_id().'&hwid='.$_GET["hwid"].' method="post">';
			  echo '<select class="form-control" name="assessment" style = "background-color:#ddd5d3;border:solid #6d6765;border-width:thin;margin:auto;margin-top:8%;height:50px;font-size:20px;width:60%;">
					<option value="1">Никаква</option>
					<option value="2">Слаб 2</option>
					<option value="3">Среден 3</option>
					<option value="4">Добър 4</option>
					<option value="5">Много добър 5</option>
					<option value="6">Отличен 6</option>
				</select>
			';
	//	if ($EditMode == 1){
			echo '<div style = "margin-left:30%;">';
			echo '<button type="submit" style = "margin-top:9%;width:50%;background:#837d7c;color:#d2c9c6;height:50px;font-family:MyDays;font-size:25px;" class="btn btn-default">Запази</button>';
			echo '</div>';
	//	}

		echo '</div>';



		echo '</form>';
?>
		</div>

	</div>



</body>
