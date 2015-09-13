<?php
	session_start();
	
?>
<html>
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
		$title = $_POST["title"];
		$data = $_POST["data"];
		
		$data = FixURLsData($data);
		
		$SQL = "INSERT INTO otherinfo (Title, Data) VALUES ('".$title."', '".$data."')";
		$result = mysql_query($SQL);
		
		if ($result = mysql_query("SELECT DISTINCT otherinfo.UID, user.UID FROM otherinfo,user WHERE user.Name = '".$username."' AND otherinfo.Title = '".$title."' AND otherinfo.Data = '".$data."'")){
			//echo 'Success';
		} else {
			echo 'FAIL';
		}
		$row = mysql_fetch_array($result);
		//print_r ($row);
		$SQL = "INSERT INTO uoi (OtherInfoID, UserID) VALUES ('".$row[0]."', '".$row[1]."')";
		$result = mysql_query($SQL);

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
		echo '<p>Заглавие: '.$title.'</p>'; 
		echo '<p>Описание: '.$data.'</p>'; 
	?>
  </div>
</div>
</div>


</div>
</body>
</html>