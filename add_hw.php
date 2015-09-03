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
<?php
$_SESSION['page'] = "other";
include "main_menu.php"; 

$SQL = "SELECT COUNT(usersubjectlist.UID) FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
$result = mysql_query($SQL);
$row = mysql_fetch_array($result);

$theresnosubjects = 0;
if ($row[0] <= 0) {
	$theresnosubjects = 1;
} else {
	$SQL = "SELECT usersubjectlist.SUBJECTLISTID FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
	//echo $SQL;
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	//echo "<p>".$row[0]."</p>";
	$subject_ids_arr = explode(",", $row[0]);
}
?>
	<div class="jumbotron">
		<h1>Домашни</h1>
		<p><?php echo $username?></p> 
	</div>
	<div id = "my_page">
  <h2>Добави ново домашно</h2>
  <form role="form" <?php echo 'action='; echo "hw_added.php"?> method="post">
    <div class="form-group">
      <label for="date">Дата</label>
      <input type="date" class="form-control" name="date" placeholder="2015-06-30">
    </div>
	<div class="form-group">
      <label for="text">Тип</label>
		<select class="form-control" name="type">
			<option value="0">Домашно</option>
			<option value="1">Изпит</option>
		</select>
    </div>
	  <?php
		echo '<div class="form-group">';
		if ($theresnosubjects == 1) {
			echo '<label for="text">Нямате предмети създайте от опциите горе в менюто!</label>';
		} else {
			echo '<label for="text">Изберете от вашия списък с предмети!</label>';
			echo '<select class="form-control" name="title">';
			for ($i = 0;$i < sizeof($subject_ids_arr) - 1; $i++) {
				$SQL = "SELECT subjects.Name, subjects.Rank FROM subjects WHERE subjects.UID = ".$subject_ids_arr[$i];
				$result = mysql_query($SQL);
				$row = mysql_fetch_array($result);
				echo '<option value="'.$row[0].'">'.$row[0].'</option>';
			}
			echo '</select>';
		}
		echo '</div>';
	  ?>
	<div class="form-group">
      <label for="text">Описание</label>
      <textarea type="text" cols="50" rows="7" class="form-control" name="data" placeholder="Решете целия учебник"></textarea>
    </div>
	<div class="form-group">
      <label for="text">URL към изображение</label>
      <input type="text" class="form-control" name="imgurl" placeholder="http://somesite/img.png">
    </div>
	<div class="form-group">
      <label for="text">Важност (от 1 до 4)</label>
		<select class="form-control" name="rank">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
    </div>
	<?php 
		if (($EditMode == 1) && ($theresnosubjects == 0)) {
			echo '<button type="submit" class="btn btn-default">Запази</button>';
		} else {
			if ($EditMode == 0) {
				echo '<p>Не сте влезли в акаунта си!</p>';
			} else {
				echo '<p>Първо създайте предмети във вашия списък от опциите горе!</p>';
			}
		}
	?>
	</form>
</div>
</div>
</div>
</body>
</html>