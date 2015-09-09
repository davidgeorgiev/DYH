<?php
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
		$logged_user_name_is = mysql_query($SQL);
		$logged_user_name_is = mysql_fetch_array($logged_user_name_is);
		return $logged_user_name_is[0];
	}
	$timezone  = +2;
?>