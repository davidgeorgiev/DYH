<?php
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
	echo '<div style = "text-align:center;border:1px solid #c8ccc1;border-radius: 5px;padding: 4.5px;color: #243746;background-color: white;font-size:24;font-family:Arial	;font-weight: bold;">'.$MyHeading.'</div></div>';
	echo '
	<div class="btn-group btn-group-justified" role="group" style = "width:100%;margin-bottom:30px;">
	<div class="btn-group" role="group">
	<button type="button" class="btn btn-default" style = "background: #86cf4b;border-color: #837d7c;border-width:3px;">Домашни</button>
	</div>
	<div class="btn-group" role="group">
	<button type="button" class="btn btn-default" style = "background: #4ba8cf;border-color: #837d7c;border-width:3px;">Изпити</button>
	</div>
	<div class="btn-group" role="group">
	<button type="button" class="btn btn-default" style = "background: #dd8043;border-color: #837d7c;border-width:3px;">Други</button>
	</div>
	<div class="btn-group" role="group">
	<button type="button" class="btn btn-default" style = "color:white;background: #673e7a;border-color: #837d7c;border-width:3px;">Решени от вас</button>
	</div>
	</div>
	';
}
?>