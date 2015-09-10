<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/head_for_datepickers.php";
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
	
		<div style = "background-color:#d2c9c6;margin-left:auto;margin-right:auto;margin-top:30px;margin-bottom:20px;width:50%;border:solid #6d6765;border-width:thin;">
<?php
		echo '<h3 style = "margin-top:0px;border:solid #6d6765;text-align:center;background-color: #837d7c;border-width:thin;border-top-left-radius: 0px;border-top-right-radius: 0px; padding: 10px;color:#d2c9c6;"><span style = "padding-left:13px;">Добавяне на начало и край на учебната година</span></h3>';
		echo '<form role="form" action=StartAndFinalAdded.php method="post">';
		echo '<div class="form-group" style="width:80%;margin:auto;"><label for="date">Начало</label><input style = "background-color:#ddd5d3;border:solid #6d6765;border-width:thin;" type="date" class="form-control" id="pickdate" name="date1" size="20" /><label for="date">Край</label><input style = "background-color:#ddd5d3;border:solid #6d6765;border-width:thin;" type="date" class="form-control" id="pickdate1" name="date2" size="20" />';
		
		if ($EditMode == 1){
			echo '<div style = "margin-left:30%;">';
			echo '<button type="submit" style = "margin-top:20px;width:50%;background:#837d7c;color:#d2c9c6" class="btn btn-default">Запази</button>';
			echo '</div>';
		}
		
		echo '</div>';
		
		
		
		echo '</form>';
?>
		</div>
		
	</div>

</div>