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
	<div id = "my_page">
  <h2>Добави нова програма</h2>
  <form role="form" <?php echo 'action='; echo "wp_added.php";?> method="post">
    <div class="form-group">
		<div class="row">
			<div class="col-sm-6">
				<label for="text">Седмица</label>
				<select class="form-control" name="week">
					<option value="Четна">Четна</option>
					<option value="Нечетна">Нечетна</option>
				</select>
			</div>
			<div class="col-sm-6">
				<label for="text">Ден</label>
				<select class="form-control" name="day">
					<option value="Понеделник">Понеделник</option>
					<option value="Вторник">Вторник</option>
					<option value="Сряда">Сряда</option>
					<option value="Четвъртък">Четвъртък</option>
					<option value="Петък">Петък</option>
					<option value="Събота">Събота</option>
					<option value="Неделя">Неделя</option>
				</select>
			</div>
			
		</div>
    </div>
	<div class="row">
	<?php
	for ($k=1;$k<=9;$k++){
		echo '<div class="col-sm-4">';
		echo '<div class="form-group">';
			echo '<label for="text">';
			$class_number = $k;
			include "some_external_phps/convert_class_number_to_words.php";
			echo $class_number." час";
			echo '</label>';
			$name = "hours".$k;
			$name2 = "mins".$k;
			include "some_external_phps/time_picker.php";
			//echo '<input type="time" class="form-control" name="time'.$k.'" placeholder="13:00">';
			$name = "subject".$k;
			include "some_external_phps/subject_select_list_menu.php";
			echo '<input type="text" class="form-control" name="info'.$k.'" placeholder="Информация">';
		echo '</div>';
		echo '</div>';
	}
	
	
	
		if ($EditMode == 1) {
			echo '<button type="submit" class="btn btn-default" style = "margin-left: 15px;">Запиши</button>';
		}
	?>
	</form>
	</div>
</div>
</div>
</div>
</body>
</html>