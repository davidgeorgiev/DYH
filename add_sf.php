<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/MakeSimpleDatePicker.php";include "graphs/convert_month_to_word.php";
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

		<div id = "StandartBox">
<?php
		$SimpleDatePickerWidth = 35;
		$SimpleDatePickerYearParameter1 = -1;
		$SimpleDatePickerYearParameter2 = 10;
		echo '<h3 id = "StandartTitle"><span style = "padding-left:20px;">Добавете начало и край на първи и втори срок</span></h3>';
		echo '<form role="form" action=StartAndFinalAdded.php method="post" style = "padding-top:15px;">';
		echo '<div style = "margin-left:20%;">';
		MakeSimpleDatePicker("Начало на първи срок",0,1,$SimpleDatePickerYearParameter1,$SimpleDatePickerYearParameter2,"width:".($SimpleDatePickerWidth*2)."%;","width:".$SimpleDatePickerWidth."%;float:left;","width:".$SimpleDatePickerWidth."%;",1);
		MakeSimpleDatePicker("Край на първи срок",0,2,$SimpleDatePickerYearParameter1,$SimpleDatePickerYearParameter2,"width:".($SimpleDatePickerWidth*2)."%;","width:".$SimpleDatePickerWidth."%;float:left;","width:".$SimpleDatePickerWidth."%;",1);
		MakeSimpleDatePicker("Начало на втори срок",0,3,$SimpleDatePickerYearParameter1,$SimpleDatePickerYearParameter2,"width:".($SimpleDatePickerWidth*2)."%;","width:".$SimpleDatePickerWidth."%;float:left;","width:".$SimpleDatePickerWidth."%;",1);
		MakeSimpleDatePicker("Край на втори срок",0,4,$SimpleDatePickerYearParameter1,$SimpleDatePickerYearParameter2,"width:".($SimpleDatePickerWidth*2)."%;","width:".$SimpleDatePickerWidth."%;float:left;","width:".$SimpleDatePickerWidth."%;",1);
		echo '</div>';
		#echo '<label class = ".InfoTitleLabel" style = "margin-left:10%;">Начало и край на първи срок</label>';
		#echo '<div class="form-group" style="width:80%;margin:auto;"><input id = "StandartInputBox" placeholder = "Начало" type="date" class="form-control" id="pickdate2" name="date3" size="20" /><input id = "StandartInputBox" placeholder = "Край" type="date" class="form-control" id="pickdate3" name="date4" size="20" /></div>';
		#echo '<label class = ".InfoTitleLabel" style = "margin-left:10%;">Начало и край на втори срок</label>';
		#echo '<div class="form-group" style="width:80%;margin:auto;"><input id = "StandartInputBox" placeholder = "Начало" type="date" class="form-control" id="pickdate4" name="date5" size="20" /><input id = "StandartInputBox" placeholder = "Край" type="date" class="form-control" id="pickdate5" name="date6" size="20" /></div>';


		if ($EditMode == 1){
			echo '<div style = "margin-left:30%;margin-bottom:20px;">';
			echo '<button type="submit" style = "width:50%;height:40px;background:#d2cdcc;" class="btn btn-default">Запази</button>';
			echo '</div>';
		}

		echo '</div>';



		echo '</form>';
?>
		</div>

	</div>

</div>
</body>
