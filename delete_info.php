<html>
<?php
	include "head.php";
	include "config.php";
?>

<?php
	if ($db_found) {
		$result1 = mysql_query("SELECT DISTINCT user.UID FROM UOI,USER WHERE User.name ='".$_GET["class"]."' AND UOI.USERID = USER.UID");
		$row2 = mysql_fetch_array($result1);
		$SQL = "DELETE FROM UOI WHERE UOI.OtherInfoID= '".$_GET["infoid"]."' AND UOI.USERID = ".$row2[0];
		echo "infoid = ".$_GET["infoid"]." and user id = ".$row2[0];
		$result = mysql_query($SQL);
		mysql_close($dbLink);
		
		echo '<div class="container">';
		echo '<div class="jumbotron">';
		echo '<h1>Поздравления, '.$_GET["class"].'!</h1>';

		echo '</div>';
		
		echo '<div class="alert alert-success" role="alert">Информацията беше изтрито успешно. ';
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



