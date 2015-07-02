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
	//if ($db_found) {
		$week = $_POST["week"];
		$day = $_POST["day"];
		
		$time1 = $_POST["time1"];
		$time2 = $_POST["time2"];
		$time3 = $_POST["time3"];
		$time4 = $_POST["time4"];
		$time5 = $_POST["time5"];
		$time6 = $_POST["time6"];
		$time7 = $_POST["time7"];
		$time8 = $_POST["time8"];
		$time9 = $_POST["time9"];
		
		$subject1 = $_POST["subject1"];
		$subject2 = $_POST["subject2"];
		$subject3 = $_POST["subject3"];
		$subject4 = $_POST["subject4"];
		$subject5 = $_POST["subject5"];
		$subject6 = $_POST["subject6"];
		$subject7 = $_POST["subject7"];
		$subject8 = $_POST["subject8"];
		$subject9 = $_POST["subject9"];
		
		$info1 = $_POST["info1"];
		$info2 = $_POST["info2"];
		$info3 = $_POST["info3"];
		$info4 = $_POST["info4"];
		$info5 = $_POST["info5"];
		$info6 = $_POST["info6"];
		$info7 = $_POST["info7"];
		$info8 = $_POST["info8"];
		$info9 = $_POST["info9"];
		
		/*$SQL = "INSERT INTO homeworks (Date, Title, Data, Rank) VALUES ('".$date."', '".$title."', '".$data."', '".$rank."')";
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

		echo '<div class="alert alert-success" role="alert"><a href="" class="alert-link"></a>Програмата е добавена успешно</div>';

	}
	else {

		echo '<div class="alert alert-danger" role="alert"><a href="" class="alert-link"></a>Програмата не можа да се добави</div>';
		mysql_close($dbLink);
	}*/
	?>
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Информация за програмата</h3>
  </div>
  <div class="panel-body">
    <?php
		echo '<div class="row">';
		echo '<div class="col-sm-6">';
		echo 'Седмица: '.$week;
		echo '</div>';
		echo '<div class="col-sm-6">';
		echo 'Ден: '.$day; 
		echo '</div>';
		echo '</div>';
		
		echo '<div class="row">';
		echo '<div class="col-sm-4">';
		echo '<h3>Първи час</h3>';
		echo '<p>Време: '.$time1.'</p>';
		echo '<p>Предмет: '.$subject1;
		echo '<p>Информация: '.$info1;
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Втори час</h3>';
		echo '<p>Време: '.$time2.'</p>';
		echo '<p>Предмет: '.$subject2.'</p>';
		echo '<p>Информация: '.$info2.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Трети час</h3>';
		echo '<p>Време: '.$time3.'</p>';
		echo '<p>Предмет: '.$subject3.'</p>';
		echo '<p>Информация: '.$info3.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Четвърти час</h3>';
		echo '<p>Време: '.$time4.'</p>';
		echo '<p>Предмет: '.$subject4.'</p>';
		echo '<p>Информация: '.$info4.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Пети час</h3>';
		echo '<p>Време: '.$time5.'</p>';
		echo '<p>Предмет: '.$subject5.'</p>';
		echo '<p>Информация: '.$info5.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Шести час</h3>';
		echo '<p>Време: '.$time6.'</p>';
		echo '<p>Предмет: '.$subject6.'</p>';
		echo '<p>Информация: '.$info6.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Седми час</h3>';
		echo '<p>Време: '.$time7.'</p>';
		echo '<p>Предмет: '.$subject7.'</p>';
		echo '<p>Информация: '.$info7.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Осми час</h3>';
		echo '<p>Време: '.$time8.'</p>';
		echo '<p>Предмет: '.$subject8.'</p>';
		echo '<p>Информация: '.$info8.'</p>';
		echo '</div>';
		echo '<div class="col-sm-4">';
		echo '<h3>Девети час</h3>';
		echo '<p>Време: '.$time9.'</p>';
		echo '<p>Предмет: '.$subject9.'</p>';
		echo '<p>Информация: '.$info9.'</p>';
		echo '</div>';
		echo '</div>';
		
	?>
  </div>
</div>
</div>



</body>
</html>