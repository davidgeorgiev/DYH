﻿<?php
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
?>
<body>

<div class="container">
<?php
$_SESSION['page'] = "other";
include "main_menu.php"; ?>
	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
  <h2>Добави допълнителна информация</h2>
  <form role="form" <?php echo 'action='; echo "info_added.php";?> method="post">
    <div class="form-group">
      <label class = "InfoTitleLabel" for="text">Заглавие</label>
      <input type="text" class="form-control" name="title" placeholder="">
    </div>
	<div class="form-group">
      <label class = "InfoTitleLabel" for="text">Описание</label>
      <textarea type="text" cols="50" rows="7" class="form-control" name="data" placeholder=""></textarea>
    </div>
	<?php
		if ($EditMode == 1) {
			echo '<button type="submit" class="btn btn-default">Submit</button>';
		}else{
			echo '<p>Не сте влезли в акаунта си или се опитвате да добавите задача на друг профил!</p>';
		}
	?>
  </form>
</div>
</div>
</div>
</body>
</html>
