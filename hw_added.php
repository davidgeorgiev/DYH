<html>
<?php 
include "head.php";
include "config.php";
?>
<body>

<div class="container">
	<div class="jumbotron">
		<h1>Домашни</h1>
		<p><?php echo $_GET["class"]?></p> 
		<p><a class="btn btn-primary btn-lg" href="home.php?class=<?php echo $_GET["class"];?>" role="button">Home</a></p>
	</div>
	<?php
	if ($db_found) {
		$date = $_POST["date"];
		$title = $_POST["title"];
		$data = $_POST["data"];
		$rank = $_POST["rank"];
		$SQL = "INSERT INTO homeworks (Date, Title, Data, Rank) VALUES ('".$date."', '".$title."', '".$data."', '".$rank."')";
		$result = mysql_query($SQL);
		
		if ($result = mysql_query("SELECT DISTINCT homeworks.UID, User.UID FROM Homeworks,User WHERE USER.NAME = '".$_GET["class"]."' AND homeworks.date = '".$date."' AND homeworks.title = '".$title."' AND homeworks.data = '".$data."' AND homeworks.rank = '".$rank."'")){
			//echo 'Success';
		} else {
			echo 'FAIL';
		}
		$row = mysql_fetch_array($result);
		//print_r ($row);
		$SQL = "INSERT INTO UH (HWID, USERID) VALUES ('".$row[0]."', '".$row[1]."')";
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
		echo '<p>Дата: '.$date.'</p>'; 
		echo '<p>Заглавие: '.$title.'</p>'; 
		echo '<p>Описание: '.$data.'</p>'; 
		echo '<p>Трудност: '.$rank.'</p>'; 
	?>
  </div>
</div>
</div>



</body>
</html>