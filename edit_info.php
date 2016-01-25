<?php
	session_start();

?>
<html>
<?php
	include "config.php";
	include "head.php";
	include "some_external_phps/FixURLLinks.php";
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
	$_SESSION['infoid'] = $_GET["infoid"];
	include "CheckEditMode.php";
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;
?>
<body>

<div class="container">
<?php

$SQL = "SELECT otherinfo.Title, otherinfo.Data FROM otherinfo WHERE otherinfo.UID = ".$_GET["infoid"];
$result = mysql_query($SQL);
$row = mysql_fetch_array($result);


$_SESSION['page'] = "other";
include "main_menu.php"; ?>
	<div class="jumbotron">
		<h1>Домашни</h1>
		<p><?php echo $username?></p>
	</div>
	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
  <h2>Редактирай</h2>
  <form role="form" <?php echo 'action='; echo "info_edited.php";?> method="post">
    <div class="form-group">
      <label class = "InfoTitleLabel" for="text">Заглавие</label>
      <?php echo '<input type="text" class="form-control" value = "'.$row[0].'" name="title" placeholder="">'; ?>
    </div>
	<div class="form-group">
      <label class = "InfoTitleLabel" for="text">Описание</label>
      <?php

		$DoneText = $row[1];
		echo '<textarea type="text" cols="50" rows="7" class="form-control" name="data" placeholder="">'.$DoneText.'</textarea>';


	  ?>
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
