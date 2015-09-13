<?php
	session_start();
	
?>

<?php 
include "head.php";
include "config.php";
include "some_external_phps/FixURLLinks.php";

$password = $_SESSION['psw'];
$username = $_SESSION['name'];
include "CheckEditMode.php";
$_SESSION['psw'] = $password;
$_SESSION['name'] = $username;
?>

<?php
$_SESSION['page'] = "other";

$hwid = $_SESSION['hwid'];
$username = $_SESSION['class'];


	if ($db_found) {
		$comment = $_POST["comment"];
		
		$comment = FixURLsData($comment);
		
		$SQL = "SELECT user.UID FROM user WHERE user.Password = '".$password."'";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		
		 //(GMT -5:00) EST (U.S. & Canada) 
		$current_date_time = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I"))); 
		$SQL = "INSERT INTO comments (Data, Date) VALUES ('".$comment."', '".$current_date_time."')";
		$result = mysql_query($SQL);
		$uid = mysql_insert_id();
		
		
		$SQL = "INSERT INTO usercommenthomework (HWID,USERID,COMMENTID) VALUES ('".$hwid."', '".$row[0]."', '".$uid."')";
		$result = mysql_query($SQL);
		
		mysql_close($dbLink);

		echo '<div class="alert alert-success" role="alert"><a href="" class="alert-link"></a>Коментарът е добавен успешно</div>';

	}
	else {

		echo '<div class="alert alert-danger" role="alert"><a href="" class="alert-link"></a>Коментарът не можа да се добави</div>';
		mysql_close($dbLink);
	}
	?>
    <?php 
		//echo '<p>User Name: '.$username.'</p>';
		//echo '<p>Comment ID:'.$row2[0].'</p>';
		//echo '<p>User ID: '.$row[0].'</p>';
		//echo '<p>HW ID: '.$hwid.'</p>';
		//echo '<p>Описание: '.$comment.'</p>'; 
		
		
		header('Location: comments.php?hwid='.$hwid) and exit;
	?>