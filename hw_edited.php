﻿<?php
	session_start();
?>
<html>
<?php 
include "head.php";
include "config.php";

$password = $_SESSION['psw'];
$username = $_SESSION['name'];
$imgurlid = $_SESSION['imgurlid'];
$hwid = $_SESSION['hwid'];
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
		$date = mysql_real_escape_string($_POST['date']);
		$new_date = date('Y-m-d',strtotime($date));
		$title = $_POST["title"];
		$data = $_POST["data"];
		$rank = $_POST["rank"];
		
		
		if (isset($_POST["imgurl"])) {
			$imgurl = $_POST["imgurl"];
		}
		$SQL = "UPDATE homeworks SET Date = '".$new_date."', Title = '".$title."', Data = '".$data."', Rank = ".$rank." WHERE homeworks.UID = ".$hwid;
		$result = mysql_query($SQL);
		$SQL = "UPDATE imgurl SET URL = '".$imgurl."' WHERE imgurl.UID = ".$imgurlid;
		$result = mysql_query($SQL);
		
		mysql_close($dbLink);

		echo '<div class="alert alert-success" role="alert"><a href="" class="alert-link"></a>Домашното е редактирано успешно.</div>';

	}
	else {

		echo '<div class="alert alert-danger" role="alert"><a href="" class="alert-link"></a>Няма достъп до базата данни.</div>';
		mysql_close($dbLink);
	}
	?>
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Информация за домашното</h3>
  </div>
  <div class="panel-body">
    <?php
		//echo '<p>IMGURLID: '.$imgurlid.'</p>'; 
		//echo '<p>HWID: '.$hwid.'</p>'; 
		echo '<p>Дата: '.$new_date.'</p>'; 
		echo '<p>Заглавие: '.$title.'</p>'; 
		echo '<p>Описание: '.$data.'</p>'; 
		echo '<p>Трудност: '.$rank.'</p>';
		if (strlen($imgurl) > 0) {
			echo ' <img src="'.$imgurl.'" alt="HomeWork image" width="100px">';
		}
	?>
  </div>
</div>
</div>


</div>
</body>
</html>