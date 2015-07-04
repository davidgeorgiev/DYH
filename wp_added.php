<?php
	session_start();
	
?>
<html>
<?php 
include "head.php";
include "config.php";

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
	<div class="jumbotron">
		<h1>Домашни</h1>
		<p><?php echo $username?></p> 
	</div>
	<?php
	if ($db_found && $EditMode == 1) {
		$week = $_POST["week"];
		$day = $_POST["day"];
		
		$time1 = date('H:i',strtotime($_POST["time1"]));
		$time2 = date('H:i',strtotime($_POST["time2"]));
		$time3 = date('H:i',strtotime($_POST["time3"]));
		$time4 = date('H:i',strtotime($_POST["time4"]));
		$time5 = date('H:i',strtotime($_POST["time5"]));
		$time6 = date('H:i',strtotime($_POST["time6"]));
		$time7 = date('H:i',strtotime($_POST["time7"]));
		$time8 = date('H:i',strtotime($_POST["time8"]));
		$time9 = date('H:i',strtotime($_POST["time9"]));
	
		$subject1 = $_POST["subject1"];
		$subject2 = $_POST["subject2"];
		$subject3 = $_POST["subject3"];
		$subject4 = $_POST["subject4"];
		$subject5 = $_POST["subject5"];
		$subject6 = $_POST["subject6"];
		$subject7 = $_POST["subject7"];
		$subject8 = $_POST["subject8"];
		$subject9 = $_POST["subject9"];
		
		$info1 = $_POST["info1"];
		$info2 = $_POST["info2"];
		$info3 = $_POST["info3"];
		$info4 = $_POST["info4"];
		$info5 = $_POST["info5"];
		$info6 = $_POST["info6"];
		$info7 = $_POST["info7"];
		$info8 = $_POST["info8"];
		$info9 = $_POST["info9"];
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time1."', '".$subject1."', '".$info1."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		$CLASSUIDS = array($row[0]);
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time2."', '".$subject2."', '".$info2."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		array_push($CLASSUIDS, $row[0]);
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time3."', '".$subject3."', '".$info3."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		array_push($CLASSUIDS, $row[0]);
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time4."', '".$subject4."', '".$info4."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		array_push($CLASSUIDS, $row[0]);
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time5."', '".$subject5."', '".$info5."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		array_push($CLASSUIDS, $row[0]);
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time6."', '".$subject6."', '".$info6."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		array_push($CLASSUIDS, $row[0]);
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time7."', '".$subject7."', '".$info7."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		array_push($CLASSUIDS, $row[0]);
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time8."', '".$subject8."', '".$info8."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		array_push($CLASSUIDS, $row[0]);
		
		$SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time9."', '".$subject9."', '".$info9."')";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(class.UID) FROM class");
		$row = mysql_fetch_array($uid);
		//echo $row[0];
		array_push($CLASSUIDS, $row[0]);
		
		//print_r ($CLASSUIDS);
		
		$SQL = "INSERT INTO day (class1ID, class2ID, class3ID, class4ID, class5ID, class6ID, class7ID, class8ID, class9ID) VALUES (".$CLASSUIDS[0].", ".$CLASSUIDS[1].", ".$CLASSUIDS[2].", ".$CLASSUIDS[3].", ".$CLASSUIDS[4].", ".$CLASSUIDS[5].", ".$CLASSUIDS[6].", ".$CLASSUIDS[7].", ".$CLASSUIDS[8].")";
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(day.UID) FROM day");
		$row = mysql_fetch_array($uid);
		
		//print_r ($row[0]);
		
		switch ($week) {
			case "Четна": $SQL = "SELECT EvenWeekID FROM twoweeks, uw, user WHERE twoweeks.UID = uw.TwoWeeksID AND user.UID = uw.UserID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			break;
			case "Нечетна": $SQL = "SELECT OddWeekID FROM twoweeks, uw, user WHERE twoweeks.UID = uw.TwoWeeksID AND user.UID = uw.UserID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			break;
		}
		$result = mysql_query($SQL);
		$row2 = mysql_fetch_array($result);
		
		$SQL = "SELECT EvenWeekID, OddWeekID FROM twoweeks, uw, user WHERE twoweeks.UID = uw.TwoWeeksID AND user.UID = uw.UserID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
		$result3 = mysql_query($SQL);
		$row3 = mysql_fetch_array($result3);
		
		$result = mysql_query("SELECT MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID FROM weeks WHERE weeks.UID = ".$row2[0]);
		$row2 = mysql_fetch_array($result);
		//print_r ($row2);
		
		switch ($day) {
			case "Понеделник": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row[0].", ".$row2[1].", ".$row2[2].", ".$row2[3].", ".$row2[4].", ".$row2[5].", ".$row2[6].")";
			break;
			case "Вторник": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row[0].", ".$row2[2].", ".$row2[3].", ".$row2[4].", ".$row2[5].", ".$row2[6].")";
			break;
			case "Сряда": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row[0].", ".$row2[3].", ".$row2[4].", ".$row2[5].", ".$row2[6].")";
			break;
			case "Четвъртък": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row2[2].", ".$row[0].", ".$row2[4].", ".$row2[5].", ".$row2[6].")";
			break;
			case "Петък": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row2[2].", ".$row2[3].", ".$row[0].", ".$row2[5].", ".$row2[6].")";
			break;
			case "Събота": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row2[2].", ".$row2[3].", ".$row2[4].", ".$row[0].", ".$row2[6].")";
			break;
			case "Неделя": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row2[2].", ".$row2[3].", ".$row2[4].", ".$row2[5].", ".$row[0].")";
			break;
		}
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(weeks.UID) FROM weeks");
		$row = mysql_fetch_array($uid);
		
		switch ($week) {
			case "Четна": $SQL = "INSERT INTO twoweeks (EvenWeekID, OddWeekID) VALUES (".$row[0].", ".$row3[1].")";
			break;
			case "Нечетна": $SQL = "INSERT INTO twoweeks (EvenWeekID, OddWeekID) VALUES (".$row3[0].", ".$row[0].")";
			break;
		}
		$result = mysql_query($SQL);
		$uid = mysql_query("SELECT MAX(twoweeks.UID) FROM twoweeks");
		$row = mysql_fetch_array($uid);
		
		$result2 = mysql_query("SELECT user.UID FROM user WHERE user.Name = '".$username."'");
		$row2 = mysql_fetch_array($result2);
		$SQL = "INSERT INTO uw (TwoWeeksID,UserID) VALUES (".$row[0].", ".$row2[0].")";
		$result = mysql_query($SQL);
		//$uid = mysql_query("SELECT MAX(WEEKS.UID) FROM WEEKS");
		//$row = mysql_fetch_array($uid);
		
		
		
		echo '<div class="alert alert-success" role="alert"><a href="" class="alert-link"></a>Програмата е добавена успешно</div>';
	}
	?>
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Информация за програмата</h3>
  </div>
  <div class="panel-body">
    <?php
		echo '<div class="row">';
		echo '<div class="col-sm-6">';
		echo 'Седмица: '.$week;
		echo '</div>';
		echo '<div class="col-sm-6">';
		echo 'Ден: '.$day; 
		echo '</div>';
		echo '</div>';
		
		echo '<div class="row">';
		echo '<div class="col-sm-4">';
		echo '<h3>Първи час</h3>';
		echo '<p>Време: '.$time1.'</p>';
		echo '<p>Предмет: '.$subject1;
		echo '<p>Информация: '.$info1;
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Втори час</h3>';
		echo '<p>Време: '.$time2.'</p>';
		echo '<p>Предмет: '.$subject2.'</p>';
		echo '<p>Информация: '.$info2.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Трети час</h3>';
		echo '<p>Време: '.$time3.'</p>';
		echo '<p>Предмет: '.$subject3.'</p>';
		echo '<p>Информация: '.$info3.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Четвърти час</h3>';
		echo '<p>Време: '.$time4.'</p>';
		echo '<p>Предмет: '.$subject4.'</p>';
		echo '<p>Информация: '.$info4.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Пети час</h3>';
		echo '<p>Време: '.$time5.'</p>';
		echo '<p>Предмет: '.$subject5.'</p>';
		echo '<p>Информация: '.$info5.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Шести час</h3>';
		echo '<p>Време: '.$time6.'</p>';
		echo '<p>Предмет: '.$subject6.'</p>';
		echo '<p>Информация: '.$info6.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Седми час</h3>';
		echo '<p>Време: '.$time7.'</p>';
		echo '<p>Предмет: '.$subject7.'</p>';
		echo '<p>Информация: '.$info7.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Осми час</h3>';
		echo '<p>Време: '.$time8.'</p>';
		echo '<p>Предмет: '.$subject8.'</p>';
		echo '<p>Информация: '.$info8.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Девети час</h3>';
		echo '<p>Време: '.$time9.'</p>';
		echo '<p>Предмет: '.$subject9.'</p>';
		echo '<p>Информация: '.$info9.'</p>';
		echo '</div>';
		echo '</div>';
		
	?>
  </div>
</div>
</div>


</div>
<?php include "garbage_collector.php";?>
</body>
</html>