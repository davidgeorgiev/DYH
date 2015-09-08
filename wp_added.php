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

		$hours = $_POST["hours"];
		$mins = $_POST["mins"];
		$subjects = $_POST["subjects"];
		$info = $_POST["info"];

		$classesArray = array();
		
		//print_r($hours);
		
		$classesArray["WEEK"] = $week;
		$classesArray["DAY"] = $day;
		for ($counter = 0; $counter < sizeof($hours); $counter++){
			$classesArray["HOURS"][$counter] = $hours[$counter].":".$mins[$counter];
		}
		$classesArray["SUBJECTS"] = $subjects;
		$classesArray["INFO"] = $info;
		include "some_external_phps/add_curriculum.php";
		AddCurriculum(Get_Logged_users_id(), $classesArray);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time1."', '".$subject1."', '".$info1."')";
		// echo $SQL;
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// echo $uid;
		// //echo $row[0];
		// $CLASSUIDS = array($uid);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time2."', '".$subject2."', '".$info2."')";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// //echo $row[0];
		// array_push($CLASSUIDS, $uid);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time3."', '".$subject3."', '".$info3."')";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// //echo $row[0];
		// array_push($CLASSUIDS, $uid);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time4."', '".$subject4."', '".$info4."')";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// //echo $row[0];
		// array_push($CLASSUIDS, $uid);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time5."', '".$subject5."', '".$info5."')";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// //echo $row[0];
		// array_push($CLASSUIDS, $uid);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time6."', '".$subject6."', '".$info6."')";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// //echo $row[0];
		// array_push($CLASSUIDS, $uid);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time7."', '".$subject7."', '".$info7."')";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// //echo $row[0];
		// array_push($CLASSUIDS, $uid);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time8."', '".$subject8."', '".$info8."')";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// //echo $row[0];
		// array_push($CLASSUIDS, $uid);
		
		// $SQL = "INSERT INTO class (time, subject, info) VALUES ('".$time9."', '".$subject9."', '".$info9."')";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		// //echo $row[0];
		// array_push($CLASSUIDS, $uid);
		
		// //print_r ($CLASSUIDS);
		
		// $SQL = "INSERT INTO day (class1ID, class2ID, class3ID, class4ID, class5ID, class6ID, class7ID, class8ID, class9ID) VALUES (".$CLASSUIDS[0].", ".$CLASSUIDS[1].", ".$CLASSUIDS[2].", ".$CLASSUIDS[3].", ".$CLASSUIDS[4].", ".$CLASSUIDS[5].", ".$CLASSUIDS[6].", ".$CLASSUIDS[7].", ".$CLASSUIDS[8].")";
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		
		// //print_r ($row[0]);
		
		// switch ($week) {
			// case "Четна": $SQL = "SELECT EvenWeekID FROM twoweeks, uw, user WHERE twoweeks.UID = uw.TwoWeeksID AND user.UID = uw.UserID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			// break;
			// case "Нечетна": $SQL = "SELECT OddWeekID FROM twoweeks, uw, user WHERE twoweeks.UID = uw.TwoWeeksID AND user.UID = uw.UserID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			// break;
		// }
		// $result = mysql_query($SQL);
		// $row2 = mysql_fetch_array($result);
		
		// $SQL = "SELECT EvenWeekID, OddWeekID FROM twoweeks, uw, user WHERE twoweeks.UID = uw.TwoWeeksID AND user.UID = uw.UserID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
		// echo $SQL;
		// $result3 = mysql_query($SQL);
		// $row3 = mysql_fetch_array($result3);
		
		// $result = mysql_query("SELECT MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID FROM weeks WHERE weeks.UID = ".$row2[0]);
		// echo $SQL;
		// $row2 = mysql_fetch_array($result);
		// //print_r ($row2);
		
		// switch ($day) {
			// case "Понеделник": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$uid.", ".$row2[1].", ".$row2[2].", ".$row2[3].", ".$row2[4].", ".$row2[5].", ".$row2[6].")";
			// break;
			// case "Вторник": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$uid.", ".$row2[2].", ".$row2[3].", ".$row2[4].", ".$row2[5].", ".$row2[6].")";
			// break;
			// case "Сряда": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$uid.", ".$row2[3].", ".$row2[4].", ".$row2[5].", ".$row2[6].")";
			// break;
			// case "Четвъртък": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row2[2].", ".$uid.", ".$row2[4].", ".$row2[5].", ".$row2[6].")";
			// break;
			// case "Петък": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row2[2].", ".$row2[3].", ".$uid.", ".$row2[5].", ".$row2[6].")";
			// break;
			// case "Събота": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row2[2].", ".$row2[3].", ".$row2[4].", ".$uid.", ".$row2[6].")";
			// break;
			// case "Неделя": $SQL = "INSERT INTO weeks (MondayID, TuesdayID, WednesdayID, ThursdayID, FridayID, SaturdayID, SundayID) VALUES (".$row2[0].", ".$row2[1].", ".$row2[2].", ".$row2[3].", ".$row2[4].", ".$row2[5].", ".$uid.")";
			// break;
		// }
		// echo $SQL;
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		
		// switch ($week) {
			// case "Четна": $SQL = "INSERT INTO twoweeks (EvenWeekID, OddWeekID) VALUES (".$uid.", ".$row3[1].")";
			// break;
			// case "Нечетна": $SQL = "INSERT INTO twoweeks (EvenWeekID, OddWeekID) VALUES (".$row3[0].", ".$uid.")";
			// break;
		// }
		// echo $SQL;
		// $result = mysql_query($SQL);
		// $uid = mysql_insert_id();
		
		// $result2 = mysql_query("SELECT user.UID FROM user WHERE user.Name = '".$username."'");
		// $row2 = mysql_fetch_array($result2);
		// $SQL = "INSERT INTO uw (TwoWeeksID,UserID) VALUES (".$uid.", ".$row2[0].")";
		// $result = mysql_query($SQL);
		
		
		
		// echo '<div class="alert alert-success" role="alert"><a href="" class="alert-link"></a>Програмата е добавена успешно</div>';
	}
	?>
  
</div>


</div>
<?php// include "garbage_collector.php";?>
</body>
</html>