<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	include "some_external_phps/PrintAccountInfo.php";
	
?>
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
	$_SESSION['page'] = "other";
	
?>

<div class="container">
<?php
include "main_menu.php";
echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';

$searched_string = $_GET['searching_for'];
$SQL = "SELECT DISTINCT COUNT(user.Name) FROM user WHERE ((user.Name LIKE '%".$searched_string."%') || (user.FirstName LIKE '%".$searched_string."%') || (user.LastName LIKE '%".$searched_string."%') || (user.Text LIKE '%".$searched_string."%')) ORDER BY user.Name DESC";
$result3 = mysql_query($SQL);
$row3 = mysql_fetch_array($result3);

echo '<div class="page-header">';
echo '<h1>Търсене за <spam style = "color: #006600">"'.$searched_string.'"</spam><small id = "smalltag"> (резултати: '.$row3[0].')</small></h1>';
echo '</div>';

if ($row3[0] <= 0) {
	echo 'Няма съвпадения';
} else {
	$SQL = "SELECT DISTINCT user.Name FROM user WHERE ((user.Name LIKE '%".$searched_string."%') || (user.FirstName LIKE '%".$searched_string."%') || (user.LastName LIKE '%".$searched_string."%') || (user.Text LIKE '%".$searched_string."%')) ORDER BY user.Name ASC";
	//echo $SQL;
	$result = mysql_query($SQL);
	while ($row = mysql_fetch_array($result)){
		echo '<div style = "margin-top:30px;">';
		$MyCurrentUserInfo = ReturnALLUserInfoByIdOrByName($row[0]);
		$MyUserIDResult = mysql_query("SELECT user.UID FROM user WHERE user.Name = '".$row[0]."'");
		$currentuserid = mysql_fetch_array($MyUserIDResult);
		if ($currentuserid[0] != Get_Logged_users_id()){
			if (CheckIfFriends($currentuserid[0], Get_Logged_users_id()) == 0){
				if ((CheckIfRequestSent(Get_Logged_users_id(), $currentuserid[0])) == 0){
					echo '<a href = "send_friend_request_to.php?user='.$row[0].'"><button class="btn btn-default" style = "min-width:100%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-user"></span><span class = "glyphicon glyphicon-user"></span> Изпрати покана на '.$MyCurrentUserInfo["FirstName"]." ".$MyCurrentUserInfo["LastName"].'</button></a>';
				} else {
					echo '<a href = "#"><button class="btn btn-default" style = "min-width:100%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-user"></span><span class = "glyphicon glyphicon-user"></span> Поканата е изпратена</button></a>';
				}
			} else {
				echo '<a href = "#"><button class="btn btn-default" style = "min-width:100%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-user"></span><span class = "glyphicon glyphicon-user"></span> Приятели</button></a>';
			}
		}
		PrintAccountInfoByUSERNAME($row[0], 1);
			//echo '<div class="panel-footer">'.$row[2].'</div>';
			

	
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