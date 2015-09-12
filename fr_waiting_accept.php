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

	$WaitingResult = WaitingRequests(Get_Logged_users_id());
	while ($WaitingUserID = mysql_fetch_array($WaitingResult)){
		
		$SQL = "SELECT user.Name FROM user WHERE user.UID = ".$WaitingUserID[0];
		$Result = mysql_query($SQL);
		$WaitingUsername = mysql_fetch_array($Result);
		echo '<div style = "margin-top:-22px;position: absolute;min-width:40%;">';
		echo '<a href = "accept_friend_request.php?userid='.$WaitingUserID[0].'"><button class="btn btn-default" style = "width:50%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-user"></span><span class = "glyphicon glyphicon-user"></span> Приемам</button></a>';
		echo '<a href = "refuse_friend_request.php?userid='.$WaitingUserID[0].'"><button class="btn btn-default" style = "width:50%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-remove"></span> Отхвърлям</button></a>';
		echo '</div>';
		PrintAccountInfoByUSERNAME($WaitingUsername[0], 1);
			//echo '<div class="panel-footer">'.$row[2].'</div>';
			

	
		//echo $row[0];
		//echo $row[1];
		//echo $row[2];
		//echo $row[3];
	}
?>
	
</div>

</body>
</html>