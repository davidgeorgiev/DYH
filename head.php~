<?php
	include "config.php";
	include "some_external_phps/ReturnAllUserInfoByIdOrByName.php";
	include "some_external_phps/CheckIfFriends.php";
	include "some_external_phps/check_and_kick_out.php";
	echo '<head><meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">';
	if (isset($_SESSION['name'])) {
		echo '<title>DYH - '.$_SESSION['name'].'</title>';
	} else {
		echo '<title>DYH</title>';
	}
  echo '<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/my.css">
  <link rel="stylesheet" href="simple-sidebar-1.0.4/css/simple-sidebar.css">
  <script src="jquery.min.js"></script>
  <script src="themes/5/smooth-scroll.js"></script><script src="lightbox/js/jquery-1.11.0.min.js"></script><script src="lightbox/js/lightbox.min.js"></script><link href="lightbox/css/lightbox.css" rel="stylesheet" />
  <script src="js/bootstrap.min.js"></script></head>';
	function ifLogged() {
		$SQL = "SELECT COUNT(user.UID) FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
		$if_logged_result = mysql_query($SQL);
		$if_logged = mysql_fetch_array($if_logged_result);
		return $if_logged[0];
	}
	function Get_Logged_users_name() {
		$SQL = "SELECT user.Name FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
		$logged_user_name_is = mysql_query($SQL);
		$logged_user_name_is = mysql_fetch_array($logged_user_name_is);
		return $logged_user_name_is[0];
	}
	function Get_Logged_users_id() {
		$SQL = "SELECT user.UID FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
		$logged_user_id_is = mysql_query($SQL);
		$logged_user_id_is = mysql_fetch_array($logged_user_id_is);
		return $logged_user_id_is[0];
	}
	$timezone  = +2;

	// $query = $_SERVER['PHP_SELF'];
	// $path = pathinfo( $query );
	// $MyCurrentPhpPage = $path['basename'];
	// if (($MyCurrentPhpPage != "index.php") && ($MyCurrentPhpPage != "acc_added.php")){
		// if (Get_Logged_users_id() == 0){
			// header('Location: index.php') and exit;
		// }
	// }
	// if (isset($_GET["user"])) {
		// $SQL = "SELECT user.UID FROM user WHERE user.Name = '".$_GET["user"]."'";
		// $MyUserUIDResult = mysql_query($SQL);
		// $MyUserUID = mysql_fetch_array($MyUserUIDResult);
		// echo $_GET["user"]." ".Get_Logged_users_name();
		// if ($_GET["user"] != Get_Logged_users_name()){
			// if (CheckIfFriends($MyUserUID[0], Get_Logged_users_id()) == 0){
				// header('Location: you_are_not_friends.php?secured_user='.$_GET["user"]) and exit;
			// }
		// }
	// }
?>