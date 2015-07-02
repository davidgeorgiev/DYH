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
	<div id = "my_page">
  <h2>Добави нова програма</h2>
  <form role="form" <?php echo 'action='; echo "wp_added.php?class="; echo $_GET["class"];?> method="post">
    <div class="form-group">
		<div class="row">
			<div class="col-sm-6">
				<label for="text">Седмица</label>
				<input type="text" class="form-control" name="week" placeholder="Четна">
			</div>
			<div class="col-sm-6">
				<label for="text">Ден</label>
				<input type="text" class="form-control" name="day" placeholder="Понеделник">
			</div>
			
		</div>
    </div>
	<div class="row">
	<div class="col-sm-4">
    <div class="form-group">
      <label for="text">Първи час</label>
      <input type="text" class="form-control" name="time1" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject1" placeholder="Математика"><input type="text" class="form-control" name="info1" placeholder="Информация">
    </div>
	</div>
	<div class="col-sm-4">
	<div class="form-group">
      <label for="text">Втори час</label>
      <input type="text" class="form-control" name="time2" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject2" placeholder="Математика"><input type="text" class="form-control" name="info2" placeholder="Информация">
    </div>
	</div>
	<div class="col-sm-4">
	<div class="form-group">
      <label for="text">Трети час</label>
      <input type="text" class="form-control" name="time3" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject3" placeholder="Математика"><input type="text" class="form-control" name="info3" placeholder="Информация">
    </div>
	</div>
	<div class="col-sm-4">
	<div class="form-group">
      <label for="text">Четвърти час</label>
      <input type="text" class="form-control" name="time4" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject4" placeholder="Математика"><input type="text" class="form-control" name="info4" placeholder="Информация">
    </div>
	</div>
	<div class="col-sm-4">
	<div class="form-group">
      <label for="text">Пети час</label>
      <input type="text" class="form-control" name="time5" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject5" placeholder="Математика"><input type="text" class="form-control" name="info5" placeholder="Информация">
    </div>
	</div>
	<div class="col-sm-4">
	<div class="form-group">
      <label for="text">Шести час</label>
      <input type="text" class="form-control" name="time6" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject6" placeholder="Математика"><input type="text" class="form-control" name="info6" placeholder="Информация">
    </div>
	</div>
	<div class="col-sm-4">
	<div class="form-group">
      <label for="text">Седми час</label>
      <input type="text" class="form-control" name="time7" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject7" placeholder="Математика"><input type="text" class="form-control" name="info7" placeholder="Информация">
    </div>
	</div>
	<div class="col-sm-4">
	<div class="form-group">
      <label for="text">Осми час</label>
      <input type="text" class="form-control" name="time8" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject8" placeholder="Математика"><input type="text" class="form-control" name="info8" placeholder="Информация">
    </div>
	</div>
	<div class="col-sm-4">
	<div class="form-group">
      <label for="text">Девети час</label>
      <input type="text" class="form-control" name="time9" placeholder="13:00 - 13:30"><input type="text" class="form-control" name="subject9" placeholder="Математика"><input type="text" class="form-control" name="info9" placeholder="Информация">
    </div>
	</div>
    <button type="submit" class="btn btn-default" style = "margin-left: 15px;">Submit</button>
	</form>
	</div>
</div>
</div>
</body>
</html>