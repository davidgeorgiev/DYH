<html>
<?php
	include "head.php";
	include "config.php";
?>

<?php
	if ($db_found) {
		$result1 = mysql_query("SELECT DISTINCT user.UID FROM UH,USER WHERE User.name ='".$_GET["class"]."' AND UH.USERID = USER.UID");
		$row2 = mysql_fetch_array($result1);
		$SQL = "DELETE FROM UH WHERE UH.HWID= '".$_GET["hwid"]."' AND UH.USERID = ".$row2[0];
		//echo "hwid = ".$_GET["hwid"]." and user id = ".$row2[0];
		$result = mysql_query($SQL);
		mysql_close($dbLink);
		
		echo '<div class="container">';
		echo '<div class="jumbotron">';
		echo '<h1>Поздравления, '.$_GET["class"].'!</h1>';

		echo '</div>';
		
		echo '<div class="alert alert-success" role="alert">Домашното беше изтрито успешно. ';
		echo '<a href="home.php?class='.$_GET["class"].'" class="alert-link">Върни ме обратно</a>';
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



