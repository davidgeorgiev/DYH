﻿<?php
	session_start();
	
?>
<html>
<?php
	include "head.php";
	include "config.php";
	
	$password = $_SESSION['psw'];
	$username = $_SESSION['name'];
	include "CheckEditMode.php";
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;
?>

<?php
	if ($db_found && $EditMode == 1) {
		$result1 = mysql_query("SELECT DISTINCT user.UID FROM uh,user WHERE user.Name ='".$username."' AND uh.USERID = user.UID");
		$row2 = mysql_fetch_array($result1);
		$SQL = "DELETE FROM uh WHERE uh.HWID= '".$_GET["hwid"]."' AND uh.USERID = ".$row2[0];
		//echo "hwid = ".$_GET["hwid"]." and user id = ".$row2[0];
		$result = mysql_query($SQL);
		mysql_close($dbLink);
		
		echo '<div class="container">';
		echo '<div class="jumbotron">';
		echo '<h1>Поздравления, '.$username.'!</h1>';

		echo '</div>';
		
		echo '<div class="alert alert-success" role="alert">Домашното беше изтрито успешно. ';
		echo '<a href="home.php" class="alert-link">Върни ме обратно</a>';
		echo '!</div>';
		echo '</div>';
	}
	else {

		echo '<div class="alert alert-danger" role="alert">Вашият акаунт не е създаден.';
		echo '<a href="index.php" class="alert-link">Опитай с друго име</a>';
		echo '.</div>';
		mysql_close($dbLink);
	}
	?>

</html>



