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
	$result = mysql_query("SELECT user.UID FROM user WHERE user.Name = '".$username."'");
	$currentuserid = mysql_fetch_array($result);
	$SQL = "INSERT INTO friends (FirstPersonID, SecondPersonID, FirstConfirm) VALUES (".Get_Logged_users_id().", ".$currentuserid[0].", 1)";
	$MySendingFriendRequestResult = mysql_query($SQL);
	
?>

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">

	<h1 id = "urlTitleForm">Поканата ви чака одобрение.</h1>

</div>

</body>