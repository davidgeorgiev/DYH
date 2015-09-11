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

<div id = "my_page" style = "border-radius:20px;background: rgba(243, 243, 243, 0.4);">

	<div id = "urlForm">
	
	<?php
		if ($EditMode == 1){
			$SQL = "DELETE FROM favsites WHERE favsites.UID = ".$_GET["bookmarkid"];
			if (mysql_query($SQL)){
				header('Location: url_list.php') and exit;
			} else {
				echo '<h1 id = "urlTitleForm">Неуспешно изтриване!</h1>';
			}
		}
	?>
		
	</div>

</div>

</body>