<?php
	session_start();
	include "config.php";
	include "some_external_phps/ReturnUserIDByUserName.php";
  echo '<meta charset="utf-8">';
  $TimesOfClicking = 20;
  $username = $_SESSION["name"];
	$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$username."'";
	$MyUserUIDResult = mysql_query($SQL);
	$MyUserUID = mysql_fetch_array($MyUserUIDResult);

	$password = $_SESSION["psw"];




	$SQL = "SELECT COUNT(user.Name) FROM user WHERE user.Name = '".$username."' AND user.Password = '".$password."'";
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	if ($row[0] > 0) {
		$SQL = "DELETE FROM user WHERE user.UID = ".$MyUserUID[0];
    //mysql_query($SQL);
    //echo $_SESSION["deleteProfileConfirm"];
    if(!isset($_SESSION["deleteProfileConfirm"])){$_SESSION["deleteProfileConfirm"] = 0;}
    if($_SESSION["deleteProfileConfirm"]==$TimesOfClicking){
      mysql_query($SQL);
      $_SESSION["deleteProfileConfirm"]=0;
      header('Location: index.php') and exit;
    }else{
      if($_SESSION > 1){
        $mystrvalhere = "пъти";
      }else{
        $mystrvalhere = "път";
      }
      echo '<p>Ако наистина желаете да изтриете профила си кликнете <a href="DeleteProfile.php">тук</a>! още '.($TimesOfClicking-$_SESSION["deleteProfileConfirm"]).' '.$mystrvalhere.'!</p>';
      echo '<p><a href="home.php">Върни ме обратно</a>!</p>';
      $_SESSION["deleteProfileConfirm"]+=1;
    }

    //header('Location: index.php') and exit;
	}
	?>
