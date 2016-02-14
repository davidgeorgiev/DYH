<?php
	include "config.php";
	//error_reporting(E_ERROR | E_PARSE);
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
  <script src="js/bootstrap.min.js"></script>';
	echo '<link href="bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="bootstrap-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="bootstrap-fileinput/js/fileinput.min.js"></script>
<!-- bootstrap.js below is only needed if you wish to the feature of viewing details
     of text file preview via modal dialog -->
<!-- optionally if you need translation for your language then include
    locale file as mentioned below -->
<script src="bootstrap-fileinput/js/fileinput_locale_bg.js"></script></head>';

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
	function GetUserIDbyName($username){
		$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$username."'";
		$user_id_is = mysql_query($SQL);
		$user_id_is = mysql_fetch_array($user_id_is);
		return $user_id_is[0];
	}
	function GetUserNamebyID($userid){
		$SQL = "SELECT user.Name FROM user WHERE user.UID = '".$userid."'";
		$user_name_is = mysql_query($SQL);
		$user_name_is = mysql_fetch_array($user_name_is);
		return $user_name_is[0];
	}
	function GetFullUserNamebyID($userid,$namenum){
		if ($namenum == 1){
			$select = 'FirstName';
		}else if($namenum == 2){
			$select = 'LastName';
		}
		if (($namenum == 1)||($namenum == 2)){
			$SQL = "SELECT user.".$select.", user.LastName FROM user WHERE user.UID = '".$userid."'";
			$user_name_is = mysql_query($SQL);
			$user_name_is = mysql_fetch_array($user_name_is);
			return $user_name_is[0];
		}else{
			return 1;
		}
	}
	$timezone  = +2;


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
