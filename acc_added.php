﻿<html>
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
	if ($db_found) {
		$SQL = "SELECT Count(User.name) FROM USER WHERE User.name = '".$name."'";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		if ($row[0] > 0){
			echo '<h1>Грешка!</h1>';
			echo '<div class="alert alert-danger" role="alert">Вече съществува акаунт с такова име, ';
			echo '<a href="index.php" class="alert-link">опитай с друго</a>';
			echo '!</div>';
			
			
			
		} else {
			$SQL = "INSERT INTO User (Name, Password) VALUES ('".$name."', '".$psw."')";
			$result = mysql_query($SQL);
			
			$SQL = "INSERT INTO TWOWEEKS (EVENWEEKID, ODDWEEKID) VALUES (9, 9)";
			$result = mysql_query($SQL);
			$uid = mysql_query("SELECT MAX(TWOWEEKS.UID) FROM TWOWEEKS");
			$row = mysql_fetch_array($uid);
			
			$SQL = "SELECT USER.UID FROM USER WHERE USER.NAME = '".$name."'";
			$result = mysql_query($SQL);
			$row2 = mysql_fetch_array($result);
			
			$SQL = "INSERT INTO UW (USERID, TWOWEEKSID) VALUES ('".$row2[0]."', ".$row[0].")";
			$result = mysql_query($SQL);
			
			mysql_close($dbLink);
			echo '<h1>Поздравления, '.$name.'!</h1>';
			echo '<p><a class="btn btn-primary btn-lg" href="home.php?class='.$name.'" role="button">Начало</a></p></div>';
			
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