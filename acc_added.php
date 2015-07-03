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
<?php include "main_menu.php"; ?>
	<div class="jumbotron">
		<?php 
			$name = $_POST["name"];
			$psw = $_POST["psw"];
			$_SESSION['psw'] = $psw;
			$_SESSION['name'] = $username;
	if ($db_found) {
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
			
			$SQL = "INSERT INTO twoweeks (EvenWeekID, OddWeekID) VALUES (9, 9)";
			$result = mysql_query($SQL);
			$uid = mysql_query("SELECT MAX(twoweeks.UID) FROM twoweeks");
			$row = mysql_fetch_array($uid);
			
			$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$name."'";
			$result = mysql_query($SQL);
			$row2 = mysql_fetch_array($result);
			
			$SQL = "INSERT INTO uw (UserID, TwoWeeksID) VALUES ('".$row2[0]."', ".$row[0].")";
			$result = mysql_query($SQL);
			
			mysql_close($dbLink);
			echo '<h1>Поздравления, '.$name.'!</h1>';
			echo '<p><a class="btn btn-primary btn-lg" href="home.php" role="button">Начало</a></p></div>';
			
			echo '<div class="alert alert-success" role="alert">Вашият акаунт беше създаден успешно!</div>';
		}
		
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Датабазата не съществува!';
		echo '</div>';
		mysql_close($dbLink);
	}
	?>
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Информация за акаунта</h3>
  </div>
  <div class="panel-body">
    <?php 
		echo '<p>Име: '.$name.'</p>';
		echo '<p>Парола: '.$psw.'</p>';
	?>
  </div>
</div>
</div>



</body>
</html>