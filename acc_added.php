<?php
	session_start();
?>
<html>
<?php 
include "head.php";
include "config.php";


?>
<body>

<div class="container">
	<div class="jumbotron">
		<?php 
			$name = $_POST["name"];
			$psw = $_POST["psw"];
			$_SESSION['psw'] = $psw;
			//$_SESSION['name'] = $username;
	$EmptyLine = 1;
	if ((strlen($_POST["name"]) > 0) && ((strlen($_POST["psw"]) > 0))) {
		$EmptyLine = 0;
	}
	if (($db_found) && ($EmptyLine == 0)) {
		$SQL = "SELECT Count(user.Name) FROM user WHERE user.Name = '".$name."'";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		if ($row[0] > 0){
			echo '<h1>Грешка!</h1>';
			echo '<div class="alert alert-danger" role="alert">Вече съществува акаунт с такова име, ';
			echo '<a href="index.php" class="alert-link">опитай с друго</a>';
			echo '!</div>';
			
			
			
		} else {
			$SQL = "INSERT INTO user (Name, Password) VALUES ('".$name."', '".$psw."')";
			$result = mysql_query($SQL);
			
			$SQL = "INSERT INTO twoweeks (EvenWeekID, OddWeekID, OtherWeekID) VALUES (9, 9, 9)";
			$result = mysql_query($SQL);
			$uid = mysql_insert_id();
			
			$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$name."'";
			$result = mysql_query($SQL);
			$row2 = mysql_fetch_array($result);
			
			$SQL = "INSERT INTO uw (UserID, TwoWeeksID) VALUES ('".$row2[0]."', ".$uid.")";
			$result = mysql_query($SQL);
			
			mysql_close($dbLink);
			echo '<h1>Поздравления, '.$name.'!</h1>';
			echo '<p><a class="btn btn-primary btn-lg" href="index.php" role="button">Начало</a></p></div>';
			
			echo '<div class="alert alert-success" role="alert">Вашият акаунт беше създаден успешно!</div>';
			echo '<div class="panel panel-default">';
			echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">Информация за акаунта</h3>';
			echo '</div>';
			echo '<div class="panel-body">';
			
		echo '<p>Име: '.$name.'</p>';
		echo '<p>Парола: '.$psw.'</p>';
		echo '</div>';
		}
		
	}
	else {
		echo '<div class="alert alert-danger" role="alert">';
		echo '<a href = "index.php" class="alert-link">Върнете се</a> и попълнете всички полета!</div>';
		//echo '<p><a class="btn btn-primary btn-lg" href="index.php" role="button">Начало</a></p></div>';
		mysql_close($dbLink);
	}
	?>
 
</div>
</div>
</body>
</html>