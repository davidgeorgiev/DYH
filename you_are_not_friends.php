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
<?php include "main_menu.php";

?>

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">

	<h1 id = "urlTitleForm">Не можете да видите това съдържание понеже не сте приятели с <?php $SecuredUserInfo = ReturnALLUserInfoByIdOrByName($_GET["secured_user"]); echo $SecuredUserInfo["FirstName"]." ".$SecuredUserInfo["LastName"];?></h1>

</div>

</body>