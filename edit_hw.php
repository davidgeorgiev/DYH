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
	
	$SQL = "SELECT imgurl.UID FROM imgurl, hwimg WHERE hwimg.IMGURLID = imgurl.UID AND hwimg.HWID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	$_SESSION['imgurlid'] = $row[0];
	$_SESSION['hwid'] = $_GET["hwid"];
	//echo $EditMode;
?>
<body>

<div class="container">
<?php
$_SESSION['page'] = "other";
include "main_menu.php"; ?>
<?php
	$SQL = "SELECT homeworks.Date, homeworks.Title, homeworks.Data, homeworks.Rank FROM homeworks WHERE homeworks.UID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	$SQL = "SELECT imgurl.URL FROM imgurl, hwimg WHERE hwimg.IMGURLID = imgurl.UID AND hwimg.HWID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	$row2 = mysql_fetch_array($result)
?>
	<div class="jumbotron">
		<h1>Домашни</h1>
		<p><?php echo $username?></p> 
	</div>
	<div id = "my_page">
  <h2>Редактирай домашно</h2>
  <form role="form" <?php echo 'action='; echo "hw_edited.php"?> method="post">
    <div class="form-group">
      <label for="date">Дата</label>
      <?php echo '<input type="date" class="form-control" name="date" value = "'.$row[0].'" placeholder="2015-06-30">'; ?>
    </div>
    <div class="form-group">
      <label for="text">Заглавие</label>
      <?php echo '<input type="text" class="form-control" name="title" value = "'.$row[1].'" placeholder="Домашно - Математика">'; ?>
    </div>
	<div class="form-group">
      <label for="text">Описание</label>
      <?php echo '<textarea type="text" cols="50" rows="7" class="form-control" name="data" placeholder="Решете целия учебник">'.$row[2].'</textarea>'; ?>
    </div>
	<div class="form-group">
      <label for="text">URL към изображение</label>
      <?php echo '<input type="text" class="form-control" name="imgurl" value = "'.$row2[0].'" placeholder="http://somesite/img.png">'; ?>
    </div>
	<div class="form-group">
      <label for="text">Важност (от 1 до 4)</label>
		<select class="form-control" name="rank">
			<?php echo '<option value="'.$row[3].'">'.$row[3].'</option>'; 
			
			for ($i = 1; $i <= 4; $i++) {
				if ($i != $row[3]) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			}
			
			?>
		</select>
    </div>
	<?php 
		if ($EditMode == 1) {
			echo '<button type="submit" class="btn btn-default">Submit</button>';
		}
	?>
	</form>
</div>
</div>
</div>
</body>
</html>