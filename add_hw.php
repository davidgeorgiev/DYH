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
?>
<body>

<div class="container">
	<div class="jumbotron">
		<h1>Домашни</h1>
		<p><?php echo $_GET["class"]?></p> 
		<p><a class="btn btn-primary btn-lg" href="home.php?class=<?php echo $_GET["class"];?>" role="button">Home</a></p>
	</div>
  <h2>Добави ново домашно</h2>
  <form role="form" <?php echo 'action='; echo "hw_added.php?class="; echo $_GET["class"];?> method="post">
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

    <button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>
</body>
</html>