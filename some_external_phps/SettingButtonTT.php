<?php
include "some_external_phps/checkIfHaveToShowOtherWeek.php";
include "some_external_phps/ReturnUserIDByUserName.php";
if (CheckIfHaveToShowOtherWeek(ReturnUserIdByUserName($_GET["user"])) == 0) {
	$PartOfLabel = '<span class="glyphicon glyphicon-ok"></span> Активирай';
} else {
	$PartOfLabel = '<span class="glyphicon glyphicon-remove"></span> Дективирай';
}
$button_to_render2 = '<div><div class="dropdown" style = "float:left;padding-right:10px;">
	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:60px;height:72px;font-size:20px;">
	<span class="glyphicon glyphicon-wrench"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
	<li><a href="ExchangeWeeks.php?user='.$_GET["user"].'"><span class="glyphicon glyphicon-random"></span> Размени четна с нечетна</a></li>
	<li><a href="DeactivateOrActivateOtherWeek.php?user='.$_GET["user"].'">'.$PartOfLabel.' извънредната</a></li>
	</ul>
	</div>';
?>