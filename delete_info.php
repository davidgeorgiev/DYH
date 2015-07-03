<?php
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
<body>
<?php
	if ($db_found && $EditMode == 1) {
		echo '<div class="container">';
		$_SESSION['page'] = "other";
		include "main_menu.php";
		echo '<div class="jumbotron">';
		echo '<h1>Поздравления, '.$username.'!</h1>';

		echo '</div>';
		
		echo '<div class="alert alert-success" role="alert">Информацията беше изтрито успешно. ';
		echo '<a href="home.php" class="alert-link">Върни ме обратно</a>';
		echo '!</div>';
		echo '</div>';
		$SQL = "SELECT DISTINCT user.UID FROM uoi,user WHERE user.Name ='".$username."' AND uoi.UserID = user.UID";
		//echo $SQL.'</br>';
		$result1 = mysql_query($SQL);
		$row2 = mysql_fetch_array($result1);
		$SQL = "DELETE FROM uoi WHERE uoi.OtherInfoID = ".$_GET["infoid"]." AND uoi.UserID = ".$row2[0];
		//echo $SQL;
		$result = mysql_query($SQL);
		mysql_close($dbLink);
		
		
	}
	else {

		echo '<div class="alert alert-danger" role="alert">Вашият акаунт не е създаден.';
		echo '<a href="index.php" class="alert-link">Опитай с друго име</a>';
		echo '.</div>';
		mysql_close($dbLink);
	}
	?>
	</div>
</body>
</html>



