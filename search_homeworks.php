<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	include "some_external_phps/return_hw_info_by_id.php";
	include "some_external_phps/CheckIfUserIsSolver.php";
	include "some_external_phps/CheckMyAssessmentForHWWithID.php";
	include "some_external_phps/PrintHWInfoInTableByID.php";
	include "some_external_phps/PrintHomeworksTimeline.php";
	include "some_external_phps/PrintHWInfoInList.php";
	CheckFriendShipByNameAndKickOut($_GET["user"], Get_Logged_users_id());
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="vertical-timeline/css/reset.css">
	<link rel="stylesheet" href="vertical-timeline/css/style.css">
	<script src="vertical-timeline/js/modernizr.js"></script>
</head>
<body>
<?php
	$EditMode = 0;
	$name_is_set = 0;
	if (isset($_GET["user"])) {
		$username = $_GET["user"];
		$name_is_set = 1;
	}
	if (isset($_POST["psw"]) && isset($_POST["name"])) {
		$password = $_POST["psw"];
		if ($name_is_set == 0) {
			$username = $_POST["name"];
		}
	} else {
		$password = $_SESSION['psw'];
		if ($name_is_set == 0) {
			$username = $_SESSION['name'];
		}
	}
	include "CheckEditMode.php";
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;
	
	if ($_SESSION['page'] != 'check_width'){
		header('Location: check_width_and_send_to.php?user='.$username.'&page=search_homeworks&searching_for='.$_GET["searching_for"]) and exit;
	}
	
	$_SESSION['page'] = "other";
	
?>

<div class="container">
<?php
include "main_menu.php";
echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';

$searched_string = $_GET['searching_for'];
$SQL = "SELECT DISTINCT COUNT(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND ((homeworks.Data LIKE '%".$searched_string."%') OR (homeworks.Title LIKE '%".$searched_string."%')) ORDER BY homeworks.Date DESC";
$result3 = mysql_query($SQL);
$row3 = mysql_fetch_array($result3);

echo '<div class="page-header">';
echo '<h1 style = "font-size:40px;color:#635d5c;">Търсене за "'.$searched_string.'"<small id = "smalltag" style = "color:#635d5c;"> (резултати: '.$row3[0].')</small></h1>';
echo '</div>';
if ($row3[0] <= 0) {
	echo 'Няма съвпадения';
} else {
	$SQL = "SELECT DISTINCT homeworks.UID FROM homeworks WHERE ((homeworks.Data LIKE '%".$searched_string."%') OR (homeworks.Title LIKE '%".$searched_string."%')) ORDER BY homeworks.Date DESC";
	$result = mysql_query($SQL);
	$counter = 0;
	while ($row = mysql_fetch_array($result)){
		$counter++;
		//PrintHWInfoInListByID($row[0], $timezone, $EditMode, $username, Get_Logged_users_id(), 1);
		if ($_GET["height"] > $_GET["width"]){
			PrintHWInfoInTableByID($row[0], $timezone, $EditMode, $username, Get_Logged_users_id());
		} else {
			PrintHomeworksTimeline($row[0], $timezone, $EditMode, $username, Get_Logged_users_id());
		}

	
		//echo $row[0];
		//echo $row[1];
		//echo $row[2];
		//echo $row[3];
	}
}
?>
	
</div>

</body>
</html>