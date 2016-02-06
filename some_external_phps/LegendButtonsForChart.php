<?php
include "PrintLegendButtonsPlease.php";
function PrintChartHeader($username, $weeknum, $EnableMenu, $CustomHeading){
	echo '<div>';
	if ($EnableMenu == 1){
		echo '<div class="dropdown" style = "float:left;padding-right:10px;">
			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:60px;height:46px;">
			<span class="glyphicon glyphicon-wrench"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">';

		for ($counter = 1; $counter <= 15; $counter++) {
			if ($counter == 1){
				$MyWord = " седмица";
			} else {
				$MyWord = " седмици";
			}
			echo '<li><a href="check_width_and_send_to.php?user='.$username.'&page=homeworks_time_chart&weeknum='.$weeknum.'&numofweeks='.$counter.'">Покажи '.$counter.$MyWord.'</a></li>';
		}
		echo "</div>";
		$MyHeading = 'Графики на задачите (показани '.$_GET["numofweeks"].' седмици)';
	} else {
		if (strlen($CustomHeading) > 0){
			$MyHeading = $CustomHeading;
		} else {
			$MyHeading = "Графика";
		}
	}
	echo "</div>";
	$TitlesArray = array(0 => array("Color" => "black","BGColor" => "#86cf4b","TEXT" => "Домашни"),array("Color" => "black","BGColor" => "#4ba8cf","TEXT" => "Изпити"),array("Color" => "black","BGColor" => "#dd8043","TEXT" => "Други"),array("Color" => "white","BGColor" => "#673e7a","TEXT" => "Решени от вас"));
	PrintLegendButtonsPlease($TitlesArray,$MyHeading);
}
?>
