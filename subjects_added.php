<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	
?>
<body>

<?php

	include "start_check.php";
	
	$_SESSION['page'] = "other";

?>

<div class="container">
<?php
//include "main_menu.php";
echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';
$subject_ids = array();

for ($i = 0 ;$i < sizeof($_POST['myInputs']); $i++){
	echo '<p>Предмет '.($i+1).' - '.$_POST['myInputs'][$i].'</br>Любимост - '.$_POST['myRanks'][$i].'</p>';
	if (strlen($_POST['myInputs'][$i]) > 0){
		$SQL = "INSERT INTO subjects (Name, Rank) VALUES ('".$_POST['myInputs'][$i]."', ".$_POST['myRanks'][$i].")";
		$result = mysql_query($SQL);
		$id = mysql_insert_id();
		array_push($subject_ids, $id);
	}
}

$string_of_ids = "";
foreach ($subject_ids as $value) {
	$string_of_ids = $string_of_ids.$value.",";
}
unset($value);

echo $string_of_ids;

$SQL = "SELECT COUNT(usersubjectlist.UID) FROM usersubjectlist, user WHERE user.UID = usersubjectlist.USERID AND user.Name = '".$username."'";
$result = mysql_query($SQL);
$row = mysql_fetch_array($result);

echo 'Found '.$row[0].' coincidences';

$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$username."'";
$result = mysql_query($SQL);
$row2 = mysql_fetch_array($result);



if ($row[0] <= 0){
	include "some_external_phps/sort_string_of_subject_ids_by_rank.php";
	$SQL = "INSERT INTO usersubjectlist (USERID,SUBJECTLISTID) VALUES (".$row2[0].", '".$string_of_ids."')";
	$result = mysql_query($SQL);
	echo "<p>".$SQL."</p>";
} else {
	$SQL = "SELECT usersubjectlist.SUBJECTLISTID FROM usersubjectlist, user WHERE user.UID = usersubjectlist.USERID AND user.Name = '".$username."'";
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	echo "<p>".$SQL."</p>";
	
	
	$string_of_ids = $row[0].$string_of_ids;
	include "some_external_phps/sort_string_of_subject_ids_by_rank.php";
	$SQL = "UPDATE usersubjectlist SET SUBJECTLISTID = '".$string_of_ids."' WHERE usersubjectlist.USERID = ".$row2[0];
	$result = mysql_query($SQL);
	echo "<p>".$SQL."</p>";
}


if (isset($_GET["hwid"])){
	header('Location: solve_homework.php?user='.$username.'&hwid='.$_GET["hwid"]) and exit;
} else {
	header('Location: check_width_and_send_to.php?user='.$username.'&page=update_subject_list') and exit;
}
?>


</div>
</body>
</html>