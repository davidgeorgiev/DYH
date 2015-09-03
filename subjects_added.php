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
include "main_menu.php";
echo '<div id = "my_page">';
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
	$SQL = "INSERT INTO usersubjectlist (USERID,SUBJECTLISTID) VALUES (".$row2[0].", '".$string_of_ids."')";
	$result = mysql_query($SQL);
	echo "<p>".$SQL."</p>";
} else {
	$SQL = "SELECT usersubjectlist.SUBJECTLISTID FROM usersubjectlist, user WHERE user.UID = usersubjectlist.USERID AND user.Name = '".$username."'";
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	echo "<p>".$SQL."</p>";
	
	
	$SQL = "UPDATE usersubjectlist SET SUBJECTLISTID = '".$row[0].$string_of_ids."' WHERE usersubjectlist.USERID = ".$row2[0];
	$result = mysql_query($SQL);
	echo "<p>".$SQL."</p>";
}




?>


</div>
</body>
</html>