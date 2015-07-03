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
		$date = mysql_real_escape_string($_POST['date']);
		$new_date = date('Y-m-d',strtotime($date));
		//echo $new_date;
		$title = $_POST["title"];
		$data = $_POST["data"];
		$rank = $_POST["rank"];
		
		
		$SQL = "INSERT INTO homeworks (Date, Title, Data, Rank) VALUES ('".$new_date."', '".$title."', '".$data."', '".$rank."')";
		$result = mysql_query($SQL);
		
		if ($result = mysql_query("SELECT DISTINCT homeworks.UID, user.UID FROM homeworks,user WHERE user.Name = '".$username."' AND homeworks.Date = '".$new_date."' AND homeworks.Title = '".$title."' AND homeworks.Data = '".$data."' AND homeworks.Rank = '".$rank."'")){
			//echo 'Success';
		} else {
			echo 'FAIL';
		}
		$row = mysql_fetch_array($result);
		//print_r ($row);
		$SQL = "INSERT INTO uh (HWID, USERID) VALUES ('".$row[0]."', '".$row[1]."')";
		$result = mysql_query($SQL);
		
		if (isset($_POST["imgurl"])) {
			$imgurl = $_POST["imgurl"];
			$SQL = "INSERT INTO imgurl (URL) VALUES ('".$imgurl."')";
			$result = mysql_query($SQL);
			$uid = mysql_query("SELECT MAX(imgurl.UID) FROM imgurl");
			$row2 = mysql_fetch_array($uid);
			
			
			$SQL = "INSERT INTO hwimg (HWID, IMGURLID) VALUES ('".$row[0]."', '".$row2[0]."')";
			$result = mysql_query($SQL);
		}

		mysql_close($dbLink);

		echo '<div class="alert alert-success" role="alert"><a href="" class="alert-link"></a>Домашното е добавено успешно</div>';

	}
	else {

		echo '<div class="alert alert-danger" role="alert"><a href="" class="alert-link"></a>Домашното не можа да се добави</div>';
		mysql_close($dbLink);
	}
	?>
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Информация за домашното</h3>
  </div>
  <div class="panel-body">
    <?php
		echo '<p>Дата: '.$new_date.'</p>'; 
		echo '<p>Заглавие: '.$title.'</p>'; 
		echo '<p>Описание: '.$data.'</p>'; 
		echo '<p>Трудност: '.$rank.'</p>'; 
		echo ' <img src="'.$imgurl.'" alt="HomeWork image" width="100px">';
	?>
  </div>
</div>
</div>


</div>
</body>
</html>