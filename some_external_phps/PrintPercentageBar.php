<?php

function PrintPercentagebar($MyHomeworkInfoArray, $myCurrentArray, $count, $index, $text) {
	echo '<div id="progressbar" style = "margin-left:-20px;border-radius:0px;padding:5px;width:100%;">';
	if ($myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]][$index] > 100){
		$MyWidthPercentage = 100;
	} else if ($myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]][$index] < 0){
		$MyWidthPercentage = 0;
	} else {
		$MyWidthPercentage = $myCurrentArray[$MyHomeworkInfoArray["SolversIDs"][$count]][$index];
	}
	echo '<div style = "width: '.$MyWidthPercentage.'%;color:#514d4c;font-weight:bold;white-space: nowrap;">';
	echo '<p style = "text-align:center;">'.$text.'</p>';
	echo '</div>';
	echo '</div>';
}
function PrintPercentagebarSimple($Value, $Title, $InPercentageBar) {
	echo '<div id="progressbar" style = "background:none;margin:0px;border-radius:5px;padding:5px;width:100%;">';
	if ($Value > 100){
		$MyWidthPercentage = 100;
	} else if ($Value < 0){
		$MyWidthPercentage = 0;
	} else {
		$MyWidthPercentage = $Value;
	}
	echo '<p style = "color:#5e5a59;font-size:18px;font-family:Exo-Regular;">'.$Title.'</p>';
	echo '<div style = "margin:-5px;width: '.$MyWidthPercentage.'%;color:#5e5a59;font-weight:bold;white-space: nowrap;">';
	echo '<p style = "text-align:center;">'.$InPercentageBar.'</p>';
	echo '</div>';
	echo '</div>';
}

?>
