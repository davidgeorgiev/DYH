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
			echo '<h1>Поздравления, '.$name.'!</h1>';
			
		?>
		<p><a class="btn btn-primary btn-lg" href="index.php" role="button">Влез</a></p>
	</div>
	<?php
	if ($db_found) {
		$SQL = "INSERT INTO User (Name) VALUES ('".$name."')";
		$result = mysql_query($SQL);
		mysql_close($dbLink);
		echo '<div class="alert alert-success" role="alert">Вашият акаунт беше създаден успешно, за да влезете натиснете ';
		echo '<a href="index.php" class="alert-link">тук</a>';
		echo '!</div>';
	}
	else {

		echo '<div class="alert alert-danger" role="alert">Вашият акаунт не е създаден.';
		echo '<a href="index.php" class="alert-link">Опитай с друго име</a>';
		echo '.</div>';
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
	?>
  </div>
</div>
</div>



</body>
</html>