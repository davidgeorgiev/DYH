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


?>
	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
  <h2>Добави нова програма</h2>
  <form role="form" <?php echo 'action='; echo "wp_added.php";?> method="post">
    <div class="form-group">
		<div class="row">
			<div class="col-sm-6">
				<label for="text">Седмица</label>
				<?php
					$ddate = date("Y-m-d");
					$date = new DateTime($ddate);
					$week = $date->format("W");
					if($week&1) {
						echo '<select class="form-control" name="week">
							<option value="1">Нечетна (текущата седмица)</option>
							<option value="2">Четна</option>
							<option value="3">Извънредна</option>
						</select>';
					} else {
						echo '<select class="form-control" name="week">
							<option value="2">Четна (текущата седмица)</option>
							<option value="1">Нечетна</option>
							<option value="3">Извънредна</option>
						</select>';
					}
				?>
			</div>
			<div class="col-sm-6">
				<label for="text">Ден</label>
				<select class="form-control" name="day">
				<?php
					
					$timestamp = strtotime(gmdate("Y-m-d", time() + 3600*($timezone+date("I"))));
					$weekday = date( "w", $timestamp);
					switch($weekday){
						case 1: $convertered_weekday = 'Понеделник';
						break;
						case 2: $convertered_weekday = 'Вторник';
						break;
						case 3: $convertered_weekday = 'Сряда';
						break;
						case 4: $convertered_weekday = 'Четвъртък';
						break;
						case 5: $convertered_weekday = 'Петък';
						break;
						case 6: $convertered_weekday = 'Събота';
						break;
						case 7: $convertered_weekday = 'Неделя';
						break;
					}
					echo '<option value="'.$weekday.'">Днес </option>';
					
				?>
					<option value="1">Понеделник</option>
					<option value="2">Вторник</option>
					<option value="3">Сряда</option>
					<option value="4">Четвъртък</option>
					<option value="5">Петък</option>
					<option value="6">Събота</option>
					<option value="7">Неделя</option>
				</select>
			</div>
			
		</div>
    </div>
	<div class="row">
	<?php
	include "some_external_phps/subject_select_list_menu.php";
	include "some_external_phps/convert_class_number_to_words.php";
	for ($k=1;$k<=9;$k++){
		echo '<div class="col-sm-4">';
		echo '<div class="form-group">';
			echo '<label for="text">';
			echo ConvertClassNumberToWords($k)." час";
			echo '</label>';
			$name = "hours[]";
			//echo $name;
			$name2 = "mins[]";
			//echo $name2;
			include "some_external_phps/time_picker.php";
			//echo '<input type="time" class="form-control" name="time'.$k.'" placeholder="13:00">';
			$name = "subjects[]";
			
			$thereisnosubjects = MakeSubjectMenu($username, $name);
			echo '<input type="text" class="form-control" name="info[]" placeholder="Информация">';
		echo '</div>';
		echo '</div>';
	}
	
	
	
		if (($EditMode == 1) && ($thereisnosubjects == 0)) {
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