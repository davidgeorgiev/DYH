<?php
	session_start();
	include "config.php";
	include "some_external_phps/write_log.php";
	include "some_external_phps/ReturnUserIDByUserName.php";

	$username = $_POST["name"];

	$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$username."'";
	$MyUserUIDResult = mysql_query($SQL);
	$MyUserUID = mysql_fetch_array($MyUserUIDResult);

	$password = $_POST["psw"].$MyUserUID[0];




	$SQL = "SELECT COUNT(user.Name) FROM user WHERE user.Name = '".$username."' AND user.Password = '".$password."'";
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);

	if ($row[0] > 0) {
		$_SESSION['psw'] = $password;
		$_SESSION['name'] = $username;
		AddOrUpdateLog($username);
		$SQL = "SELECT COUNT(*) FROM schoolyear WHERE USERID = ".ReturnUserIdByUserName($username);
		$IfThereIsSFResult = mysql_query($SQL);
		$IfThereIsSF = mysql_fetch_array($IfThereIsSFResult);
		$IfThereIsSF = $IfThereIsSF[0];
		if($IfThereIsSF){
			header('Location: home.php?user='.$username) and exit;
		}else{
			header('Location: add_sf.php') and exit;
		}
	} else {
		header('Location: notreg.php') and exit;
	}
	?>
