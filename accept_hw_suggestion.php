<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/AcceptOrRefuseHWSuggestion.php";
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

	<?php
		if (AcceptHWSuggestion($_GET["hwid"], Get_Logged_users_id()) == 1){
			echo '<h1 id = "urlTitleForm">Домашното е добавено успешно на вашата страница!</h1>';
		} else {
			echo '<h1 id = "urlTitleForm">Неопределена грешка.</h1>';
		}
	?>
</div>

</body>