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
		if((($TimesOfClicking-$_SESSION["deleteProfileConfirm"])+2) > 1){
			$mystrvalhere = "пъти";
		}else{
			$mystrvalhere = "път";
		}
    if($_SESSION["deleteProfileConfirm"]==($TimesOfClicking+2)){
			if (!isset($_POST['deleteProfileConfirmPSW'])){
				echo '<p>Благодарим, че кликнахте '.$TimesOfClicking.' пъти!</p>';
				echo '<p>Сега, за да сме сигурни, че сте вие въведете вашата парола долу!</p>';
				echo '<form role="form" action="DeleteProfile.php" method="post">
				<div class="form-group">
				<input style = "font-size:2px;width:120px;height:20px;" type="text" value = "" name="deleteProfileConfirmPSW" placeholder="Парола" autocomplete="off">
				</div>
				<div class="form-group">
				<button type="submit" >Потвърди</button>
				</div>
				</form>';
				echo '<p><a href="home.php">Върни ме обратно</a>!</p>';
			}else{
				if(!isset($_SESSION["DeleteItNow"])){$_SESSION["DeleteItNow"] = 0;}
				if($password == $_POST['deleteProfileConfirmPSW'].$MyUserUID[0]){
					$_SESSION["DeleteItNow"] = 1;
					header('Location: DeleteProfile.php') and exit;
				}else{
					$_SESSION["deleteProfileConfirm"]=0;
					$_SESSION["DeleteItNow"]=0;
					echo '<p>Грешна парола, кликнете <a href="DeleteProfile.php">тук</a> и опитайте отново!</p>';
				}

			}
    }else{
			if($_SESSION["deleteProfileConfirm"]==0){
				echo '<p>Ако наистина желаете да изтриете профила си кликнете <a href="DeleteProfile.php">тук</a>! още 1000 пъти!</p>';
	      echo '<p><a href="home.php">Върни ме обратно</a>!</p>';
			}
			if($_SESSION["deleteProfileConfirm"]==1){
				echo '<p>Шегичка! XD '.($TimesOfClicking).' са! Кликни <a href = "DeleteProfile.php">тук</a>!</p>';
			}
			if($_SESSION["deleteProfileConfirm"]>1){
	      echo '<p>Ако наистина желаете да изтриете профила си кликнете <a href="DeleteProfile.php">тук</a>! още '.(($TimesOfClicking-$_SESSION["deleteProfileConfirm"])+2).' '.$mystrvalhere.'!</p>';
	      echo '<p><a href="home.php">Върни ме обратно</a>!</p>';
			}
      $_SESSION["deleteProfileConfirm"]+=1;
    }
		if($_SESSION["DeleteItNow"]==1){
			mysql_query($SQL);
      $_SESSION["deleteProfileConfirm"]=0;
			$_SESSION["DeleteItNow"]=0;
      header('Location: index.php') and exit;
		}

    //header('Location: index.php') and exit;
	}
	?>
