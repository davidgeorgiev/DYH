<?php
	session_start();
	
?>
<html>
<?php
	include "config.php";
	include "head.php";
	/*if ($db_found) {
		$SQL = "INSERT INTO homeworks (Date, Title, Data, Rank) VALUES ('2015-06-30 00:00:00', 'Hello', 'How are you?','2')";
		$result = mysql_query($SQL);
		
		mysql_close($dbLink);

		print "Records added to the database";

		}
		else {

		print "Database NOT Found ";
		mysql_close($dbLink);
	}*/
	$password = $_SESSION['psw'];
	$username = $_SESSION['name'];
	include "CheckEditMode.php";
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;
	//echo $EditMode;
?>
<body>

<div class="container">
	<div class="jumbotron">
		<h1>Домашни</h1>
		<p><?php echo $username?></p> 
		<p><a class="btn btn-primary btn-lg" href="home.php" role="button">Home</a></p>
	</div>
	<div id = "my_page">
  <h2>Добави ново домашно</h2>
  <form role="form" <?php echo 'action='; echo "hw_added.php"?> method="post">
    <div class="form-group">
      <label for="text">Дата</label>
      <input type="text" class="form-control" name="date" placeholder="2015-06-30">
    </div>
    <div class="form-group">
      <label for="text">Заглавие</label>
      <input type="text" class="form-control" name="title" placeholder="Домашно - Математика">
    </div>
	<div class="form-group">
      <label for="text">Описание</label>
      <input type="text" class="form-control" name="data" placeholder="Решете целия учебник">
    </div>
	<div class="form-group">
      <label for="text">Сложност (от 1 до 4)</label>
      <input type="text" class="form-control" name="rank" placeholder="4">
    </div>
	<?php 
		if ($EditMode == 1) {
			echo '<button type="submit" class="btn btn-default">Submit</button>';
		}
	?>
	</form>
</div>
</div>
</body>
</html>