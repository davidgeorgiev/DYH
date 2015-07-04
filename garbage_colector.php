<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	
?>

<body>
<div id = "container">
<div id = "my_page">
<?php

//SEARCHING GARBAGE

	$SQL = "SELECT homeworks.UID FROM homeworks WHERE homeworks.UID NOT IN (SELECT uh.HWID FROM uh)";
	$result = mysql_query($SQL);
	$hwuidfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		//echo $row[0].'</br>';
		array_push($hwuidfordeletion, $row[0]);
	}


	$SQL = "SELECT imgurl.UID FROM imgurl WHERE imgurl.UID NOT IN (SELECT hwimg.IMGURLID FROM hwimg, homeworks WHERE hwimg.HWID NOT IN (SELECT homeworks.UID FROM homeworks WHERE homeworks.UID NOT IN (SELECT uh.HWID FROM uh)))";
	$result = mysql_query($SQL);
	$imgurluidfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		//echo $row[0].'</br>';
		array_push($imgurluidfordeletion, $row[0]);
	}


	$SQL = "SELECT otherinfo.UID FROM otherinfo WHERE otherinfo.UID NOT IN (SELECT uoi.OtherInfoID FROM uoi)";
	$result = mysql_query($SQL);
	$otherinfouidfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		//echo $row[0].'</br>';
		array_push($otherinfouidfordeletion, $row[0]);
	}


	$SQL = "SELECT MAX(uw.UID), uw.UserID, MAX(uw.TwoWeeksID) FROM uw GROUP BY uw.UserID";
	$result = mysql_query($SQL);
	$importantTWID = array();
	$allTWID = array();
	$uwfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		array_push($importantTWID, $row[0]);
	}
	$SQL = "SELECT uw.UID FROM uw";
	$result = mysql_query($SQL);
	while ($row = mysql_fetch_array($result)){
		array_push($allTWID, $row[0]);
	}
	
	//print_r ($importantTWID);
	//print_r ($allTWID);
	
	foreach ($allTWID as $value) {
		if (in_array($value, $importantTWID)) {
			//print $value;
		} else {
			array_push($uwfordeletion, $value);
			//print "pushing";
			//print ($value);
		}
	}
	


	$SQL = "SELECT uw.UID, uw.UserID, MAX(uw.TwoWeeksID) FROM uw GROUP BY uw.UserID";
	$result = mysql_query($SQL);
	$importantTWID = array();
	$allTWID = array();
	$twoweeksfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		array_push($importantTWID, $row[2]);
	}
	$SQL = "SELECT uw.TwoWeeksID FROM uw";
	$result = mysql_query($SQL);
	while ($row = mysql_fetch_array($result)){
		array_push($allTWID, $row[0]);
	}
	
	//print_r ($importantTWID);
	//print_r ($allTWID);
	
	foreach ($allTWID as $value) {
		if (in_array($value, $importantTWID)) {
			
		} else {
			array_push($twoweeksfordeletion, $value);
		}
	}
	
$num_of_deleted_garbage = 0;
//DELETING GARBAGE
	
	echo '<div class="page-header"><h1>homeworks.UID for deletion...</h1></div>';
	foreach ($hwuidfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM homeworks WHERE homeworks.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}
	
	echo '<div class="page-header"><h1>imgurl.UID for deletion...</h1></div>';
	foreach ($imgurluidfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM imgurl WHERE imgurl.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}
	
	echo '<div class="page-header"><h1>otherinfo.UID for deletion...</h1></div>';
	foreach ($otherinfouidfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM otherinfo WHERE otherinfo.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}
	
	echo '<div class="page-header"><h1>uw.UID for deletion...</h1></div>';
	foreach ($uwfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM uw WHERE uw.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}
	
	echo '<div class="page-header"><h1>twoweeks.UID for deletion...</h1></div>';
	foreach ($twoweeksfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM twoweeks WHERE twoweeks.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}
	
//CONTINUE SEARCHING GARBAGE

	$SQL = "SELECT DISTINCT weeks.UID FROM weeks, twoweeks WHERE weeks.UID NOT IN (SELECT EvenWeekID FROM twoweeks) AND weeks.UID NOT IN (SELECT OddWeekID FROM twoweeks) AND weeks.UID != 9";
	$result = mysql_query($SQL);
	$weeksfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		//echo $row[0].'</br>';
		array_push($weeksfordeletion, $row[0]);
	}
	
	$SQL = "SELECT hwimg.UID FROM hwimg WHERE hwimg.IMGURLID NOT IN (SELECT imgurl.UID FROM imgurl)";
	$result = mysql_query($SQL);
	$hwimguidfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		//echo $row[0].'</br>';
		array_push($hwimguidfordeletion, $row[0]);
	}
	
//DELETING GARBAGE
	
	echo '<div class="page-header"><h1>weeks.UID for deletion...</h1></div>';
	foreach ($weeksfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM weeks WHERE weeks.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}
	
	echo '<div class="page-header"><h1>hwimg.UID for deletion...</h1></div>';
	foreach ($hwimguidfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM hwimg WHERE hwimg.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}

//CONTINUE SEARCHING GARBAGE

	$SQL = "SELECT DISTINCT day.UID FROM day, weeks WHERE day.UID NOT IN (SELECT weeks.MondayID FROM weeks) AND day.UID NOT IN (SELECT weeks.TuesdayID FROM weeks) AND day.UID NOT IN (SELECT weeks.WednesdayID FROM weeks) AND day.UID NOT IN (SELECT weeks.ThursdayID FROM weeks) AND day.UID NOT IN (SELECT weeks.FridayID FROM weeks) AND day.UID NOT IN (SELECT weeks.SaturdayID FROM weeks) AND day.UID NOT IN (SELECT weeks.SundayID FROM weeks) AND day.UID != 13";
	$result = mysql_query($SQL);
	$dayfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		array_push($dayfordeletion, $row[0]);
	}
	
//DELETING GARBAGE

	echo '<div class="page-header"><h1>day.UID for deletion...</h1></div>';
	foreach ($dayfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM day WHERE day.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}
	
//CONTINUE SEARCHING GARBAGE

	$SQL = "SELECT DISTINCT class.UID FROM class, day WHERE class.UID NOT IN (SELECT day.class1ID FROM day) AND class.UID NOT IN (SELECT day.class2ID FROM day) AND class.UID NOT IN (SELECT day.class3ID FROM day) AND class.UID NOT IN (SELECT day.class4ID FROM day) AND class.UID NOT IN (SELECT day.class5ID FROM day) AND class.UID NOT IN (SELECT day.class6ID FROM day) AND class.UID NOT IN (SELECT day.class7ID FROM day) AND class.UID NOT IN (SELECT day.class8ID FROM day) AND class.UID NOT IN (SELECT day.class9ID FROM day) AND ((class.UID < 201) OR (class.UID > 209))";
	$result = mysql_query($SQL);
	$classfordeletion = array();
	while ($row = mysql_fetch_array($result)){
		array_push($classfordeletion, $row[0]);
	}
	
//DELETING GARBAGE

	echo '<div class="page-header"><h1>class.UID for deletion...</h1></div>';
	foreach ($classfordeletion as $value) {
		echo $value.'</br>';
		$SQL = "DELETE FROM class WHERE class.UID = ".$value;
		$result = mysql_query($SQL);
		$num_of_deleted_garbage = $num_of_deleted_garbage+1;
	}
	$_SESSION['garbage'] = $num_of_deleted_garbage;
	//header('Location: home.php') and exit;
?>



</div>
</body>

</html>