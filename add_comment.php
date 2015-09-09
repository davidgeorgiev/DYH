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
	
	$_SESSION['hwid'] = $_GET['hwid'];
	$_SESSION['class'] = $_GET['class'];
?>
<body>

<div class="container">
<?php
$_SESSION['page'] = "other";
include "main_menu.php"; ?>
	<div class="jumbotron">
		<h1>Домашни</h1>
		<p><?php echo $username?></p> 
	</div>
	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
  <h2>Добави коментар</h2>
  <form role="form" <?php echo 'action='; echo "comment_added.php";?> method="post">
	<div class="form-group">
      <label for="text">Описание</label>
      <textarea type="text" cols="50" rows="7" class="form-control" name="comment" placeholder=""></textarea>
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