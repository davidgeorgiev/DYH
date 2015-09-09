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
<?php
	if ($db_found && $EditMode == 1) {
		echo '<div class="container">';
		$_SESSION['page'] = "other";
		include "main_menu.php";
		
		echo '<div class="alert alert-success" role="alert">Домашното беше изтрито успешно. ';
		if (isset($_GET["page"])){
			if ($_GET["page"] == "homeworks_time_chart"){
				$MyURL = 'homeworks_time_chart.php?user='.$username.'&weeknum='.date("W").'&numofweeks=4';
			} 
		} else {
			$MyURL = 'home.php?user='.$username;
		}
		echo '<a href="'.$MyURL.'" class="alert-link">Върни ме обратно</a>';
		echo '!</div>';
		echo '</div>';
		
		$result1 = mysql_query("SELECT DISTINCT user.UID FROM uh,user WHERE user.Name ='".$username."' AND uh.USERID = user.UID");
		$row2 = mysql_fetch_array($result1);
		$SQL = "DELETE FROM uh WHERE uh.HWID= '".$_GET["hwid"]."' AND uh.USERID = ".$row2[0];
		//echo "hwid = ".$_GET["hwid"]." and user id = ".$row2[0];
		$result = mysql_query($SQL);
		mysql_close($dbLink);
		
		
	}
	else {
		mysql_close($dbLink);
	}
	?>
	</div>
	<?php include "garbage_collector.php";?>
</body>
</html>



