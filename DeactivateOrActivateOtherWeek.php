<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
?>
<?php
	include "start_check.php";
	include "some_external_phps/DeactivateActivateAndExchangeFunc.php";
	include "some_external_phps/ReturnUserIDByUserName.php";
	include "some_external_phps/checkIfHaveToShowOtherWeek.php";
	// if ($_SESSION['page'] != 'check_width'){
		// header('Location: check_width_and_send_to.php?user='.$username.'&page='.$current_page_is) and exit;
	// }
	$_SESSION['page'] = "other";
?>
<body>
<div class="container">
<?php include "main_menu.php";?>

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.6)">

<?php
	echo '<p style = "font-size:30px;font-family:Arial;background-color:white;padding:10px;border-radius:10px;text-align:center;">';
	if ($EditMode == 1) {
		if (CheckIfHaveToShowOtherWeek(ReturnUserIdByUserName($username))){
			echo DeactivateOtherWeek(ReturnUserIdByUserName($username));
		} else {
			echo ActivateOtherWeek(ReturnUserIdByUserName($username));
		}
	} else {
		echo "Нямате право да извършите това действиe!!! :/";
	}
	echo '</p>';

?>

</div>
</div>
</body>