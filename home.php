<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	
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
	$_SESSION['page'] = "home";
?>

<div class="container">
<?php include "main_menu.php"; ?>	
<?php
	if ($result = mysql_query("SELECT DISTINCT homeworks.Date, WEEKDAY(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date >= '".date("Y-m-d")." 00:00:00' ORDER BY homeworks.Date ASC" )){
		//echo 'Success';
	} else {
		echo 'FAIL';
	}
	$SQL = "SELECT DISTINCT COUNT(homeworks.Date), WEEKDAY(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date >= '".date("Y-m-d")." 00:00:00' ORDER BY homeworks.Date ASC";
	$result3 = mysql_query($SQL);
	$row3 = mysql_fetch_array($result3);
	$SQL = "SELECT DISTINCT COUNT(otherinfo.Title) FROM otherinfo,user,uoi WHERE user.Name = '".$username."' AND uoi.UserID = user.UID AND uoi.OtherInfoID = otherinfo.UID  ORDER BY otherinfo.UID DESC";
	$result4 = mysql_query($SQL);
	$row4 = mysql_fetch_array($result4);
	if (($row3[0] > 0) || ($row4[0] > 0)) {
		$there_is_some_info = 1;
	} else {
		$there_is_some_info = 0;
	}
	
	if ($there_is_some_info) {
		echo '<div id = "my_page">';
	}
	
	while ($row = mysql_fetch_array($result)){
		//print_r($row);
		echo '<div class="page-header">';
		
		switch($row[1]){
			case 0: $weekday = 'ЗА ПОНЕДЕЛНИК';
			break;
			case 1: $weekday = 'ЗА ВТОРНИК';
			break;
			case 2: $weekday = 'ЗА СРЯДА';
			break;
			case 3: $weekday = 'ЗА ЧЕТВЪРТЪК';
			break;
			case 4: $weekday = 'ЗА ПЕТЪК';
			break;
			case 5: $weekday = 'ЗА СЪБОТА';
			break;
			case 6: $weekday = 'ЗА НЕДЕЛЯ';
			break;
		}
		if ($row[0] == date("Y-m-d")) {
			$weekday2 = '(днес) ';
		} else {
			$weekday2 = '';
		}
		echo '<h1>'.$weekday.' <small id = "smalltag">'.$weekday2.$row[0].'</small></h1>';
		echo '</div>';
		echo '<div class="row">';
		$result2 = mysql_query("SELECT homeworks.Title, homeworks.Data, homeworks.Rank, homeworks.UID, imgurl.URL, homeworks.UID, homeworks.Type FROM homeworks,user,uh,imgurl,hwimg WHERE imgurl.UID = hwimg.IMGURLID AND hwimg.HWID = homeworks.UID AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$row[0]." 00:00:00' ORDER BY homeworks.UID DESC");
		while ($row2 = mysql_fetch_array($result2)){
			echo '	<div class="col-sm-3" style = "margin:10px;background-color: white;border-radius:7px;">';
			switch($row2[2]){
				case 1: $color = "white";
				break;
				case 2: $color = "#a8f293";
				break;
				case 3: $color = "#ffb495";
				break;
				case 4: $color = "#fa7194";
				break;
			}
			switch($row2[6]){
				case 0: $type_color = "#fbc777";
				break;
				case 1: $type_color = "#779afb";
				break;
			}			
			if ($EditMode == 0) {
				echo '	<h3 style = "background-color: '.$color.';border-width:thin; border-style: solid;border-color: #d0d0d0;border-radius:5px; padding: 5px;">'.$row2[0].'</h3>';
			} else {
				echo '<div class="dropdown" style = "margin-bottom:10px;margin-top:15px;">';
				echo '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:100%;background-color: '.$color.';border-width:thin; border-style: solid;border-color: #d0d0d0;border-radius:5px; padding: 5px;">';
				echo $row2[0];
				echo '<span class="caret"></span>';
				echo '</button>';
				echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">';
				echo '<li><a href="delete_hw.php?hwid='.$row2[3].'&class='.$username.'"><span class="glyphicon glyphicon-trash"></span> Изтрий</a></li>';
				echo '<li><a href="edit_hw.php?hwid='.$row2[3].'&class='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Редактирай</a></li>';
				echo '</ul>';
				echo '</div>';
			}
			if (strlen($row2[4]) > 0) {
				echo ' <p style = "border-width:thin; border-style: solid;background-color:'.$type_color.';border-color: #BEBEBE;border-radius:5px; padding: 9px;"><a href = "'.$row2[4].'" rel="lightbox"><img src="'.$row2[4].'" alt="HomeWork image" width="100%"></a></p>';
			}
			echo '	<p style = "border-width:thin; border-style: solid;background-color:'.$type_color.';border-color: #BEBEBE;border-radius:5px; padding: 9px;">'.$row2[1].'</p>';
			
			if ($EditMode == 1) {
				// echo '<div style = "margin-bottom: 13px;"><div>';
				// echo '<form id="tab" role="form"'; echo "action="; echo '"delete_hw.php?hwid='.$row2[3].'&class='.$username.'"'; echo ' method="post">
					// <div><button class="btn btn-default" style = "width: 100%;background-color:white;height:27px;padding:3px;" type="submit" >Изтрий</button></div>
				// </form>';
				// echo '<form id="tab" role="form"'; echo "action="; echo '"edit_hw.php?hwid='.$row2[3].'&class='.$username.'"'; echo ' method="post">
					// <div><button class="btn btn-default" style = "width: 100%;background-color:white;height:27px;padding:3px;" type="submit" >Редактирай</button></div>
				// </form>';
				// echo '</div></div>';
			}
			$SQL = "SELECT COUNT(usercommenthomework.UID) FROM usercommenthomework WHERE usercommenthomework.HWID = ".$row2[5];
			$result4 = mysql_query($SQL);
			$row4 = mysql_fetch_array($result4);
			echo '<p>';
			echo '<a href="comments.php?hwid='.$row2[3].'" style = "text-decoration: none;">';
			echo '<span class="glyphicon glyphicon-comment"></span>';
			echo ' Коментари '.$row4[0].'</a>';
			echo '</p>';
			// echo '<form id="tab" role="form"'; echo "action="; echo 'comments.php?hwid='.$row2[3]; echo ' method="post">
					// <button class="btn btn-default" style = "width: 100%;background-color:white;" type="submit" >Коментари - '.$row4[0].'</button>
				// </form>';
			
			echo '</div>';
		}
		echo '	</div>';
	}
	
	if ($result = mysql_query("SELECT DISTINCT COUNT(otherinfo.Title) FROM otherinfo,user,uoi WHERE user.Name = '".$username."' AND uoi.UserID = user.UID AND uoi.OtherInfoID = otherinfo.UID  ORDER BY otherinfo.UID DESC")){
	//echo 'Success';
	} else {
		echo 'FAIL';
	}
	$row = mysql_fetch_array($result);
	if ($row[0] > 0){
		echo '<div class="page-header">';
		echo '<h1>ДОПЪЛНИТЕЛНО</h1>';
		echo '</div>';
	}
  ?>
  
  <div class="row">
    
	<?php
		if ($result = mysql_query("SELECT DISTINCT otherinfo.Title,otherinfo.Data,otherinfo.UID FROM otherinfo,user,uoi WHERE user.Name = '".$username."' AND uoi.UserID = user.UID AND uoi.OtherInfoID = otherinfo.UID  ORDER BY otherinfo.UID DESC")){
			//echo 'Success';
		} else {
			echo 'FAIL';
		}
		while ($row = mysql_fetch_array($result)){
			echo '<div class="col-sm-3" style = "margin:10px;background-color: white;border-radius:7px;">';
			echo '<h3>'.$row[0].'</h3>';
			echo '<p>'.$row[1].'</p>';
			if ($EditMode == 1) {
				echo '<table style = "margin-bottom: 15px;"><tr>';
				echo '<form id="tab" role="form"'; echo "action="; echo '"delete_info.php?infoid='.$row[2].'&class='.$username.'"'; echo ' method="post">
					<td style = "width: 50%;"><button class="btn btn-default" style = "width: 100%;background-color:white;height:27px;padding:3px;" type="submit" >Изтрий</button></td>
				</form>';
				echo '<form id="tab" role="form"'; echo "action="; echo '"edit_info.php?infoid='.$row[2].'&class='.$username.'"'; echo ' method="post">
					<td style = "width: 50%;"><button class="btn btn-default" style = "margin-left:10px;width: 100%;background-color:white;height:27px;padding:3px;" type="submit" >Редактирай</button></td>
				</form>';
				echo '</tr></table>';
			}
			echo '</div>';
		}
	?>
  </div>
  <?php
	//echo '<div class="alert alert-success" role="alert">...</div><div class="alert alert-info" role="alert">...</div><div class="alert alert-warning" role="alert">...</div><div class="alert alert-danger" role="alert">Много важно събитие</div>';
	if ($there_is_some_info) {
		echo '</div>';
	}
	?>
<div>
	<?php
		$eoweek = 0;
		$ddate = date("Y-m-d");
		$date = new DateTime($ddate);
		$week = $date->format("W");
	?>
	<div id = "my_page">
	<div class="page-header">
	<h1>Учебната програма <small id = "smalltag">
	<?php
		if($week&1) {
			$eoweek = "OddWeekID";
			echo 'Седмицата е нечетна';
		} else {
			$eoweek = "EvenWeekID";
			echo 'Седмицата е четна';
		}
	?>
	</small></h1>
	</div>
	<div class="row">
	<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">
   <table class="table table-bordered" style = "float:left;font-size:13px;margin-top:15px;">
    <thead>
      <tr>
		<th colspan="4">Понеделник</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT class.time, class.subject, class.info FROM class, day, weeks, twoweeks, uw, user WHERE user.UID = uw.UserID AND twoweeks.UID = uw.TwoWeeksID AND twoweeks.".$eoweek." = weeks.UID AND day.UID = weeks.MondayID AND class.UID = day.class".$i."ID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			
				
			$result3 = mysql_query($SQL);
			$row3 = mysql_fetch_array($result3);
		
		
			echo '<tbody>';
			echo '<td>'.$i.'</td>
				<td>'.$row3[0].'</td>
				<td>'.$row3[1].'</td>
				<td>'.$row3[2].'</td>';
			echo '</tbody>';
		}
	?>
  </table>
	</div>
	<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">
  <table class="table table-bordered" style = "float:left;margin-top:15px;font-size:13px;">
    <thead>
      <tr>
		<th colspan="4">Вторник</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT class.time, class.subject, class.info FROM class, day, weeks, twoweeks, uw, user WHERE user.UID = uw.UserID AND twoweeks.UID = uw.TwoWeeksID AND twoweeks.".$eoweek." = weeks.UID AND day.UID = weeks.TuesdayID AND class.UID = day.class".$i."ID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			
				
			$result3 = mysql_query($SQL);
			$row3 = mysql_fetch_array($result3);
		
		
			echo '<tbody>';
			echo '<td>'.$i.'</td>
				<td>'.$row3[0].'</td>
				<td>'.$row3[1].'</td>
				<td>'.$row3[2].'</td>';
			echo '</tbody>';
		}
	?>
  </table>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">
  <table class="table table-bordered" style = "float:left;font-size:13px;margin-top:15px;">
    <thead>
      <tr>
		<th colspan="4">Сряда</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT class.time, class.subject, class.info FROM class, day, weeks, twoweeks, uw, user WHERE user.UID = uw.UserID AND twoweeks.UID = uw.TwoWeeksID AND twoweeks.".$eoweek." = weeks.UID AND day.UID = weeks.WednesdayID AND class.UID = day.class".$i."ID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			
				
			$result3 = mysql_query($SQL);
			$row3 = mysql_fetch_array($result3);
		
		
			echo '<tbody>';
			echo '<td>'.$i.'</td>
				<td>'.$row3[0].'</td>
				<td>'.$row3[1].'</td>
				<td>'.$row3[2].'</td>';
			echo '</tbody>';
		}
	?>
  </table>
  </div>
	<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">
  <table class="table table-bordered" style = "float:left;font-size:13px;margin-top:15px;">
    <thead>
      <tr>
		<th colspan="4">Четвъртък</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT class.time, class.subject, class.info FROM class, day, weeks, twoweeks, uw, user WHERE user.UID = uw.UserID AND twoweeks.UID = uw.TwoWeeksID AND twoweeks.".$eoweek." = weeks.UID AND day.UID = weeks.ThursdayID AND class.UID = day.class".$i."ID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			
				
			$result3 = mysql_query($SQL);
			$row3 = mysql_fetch_array($result3);
		
		
			echo '<tbody>';
			echo '<td>'.$i.'</td>
				<td>'.$row3[0].'</td>
				<td>'.$row3[1].'</td>
				<td>'.$row3[2].'</td>';
			echo '</tbody>';
		}
	?>
  </table>
  </div>
  </div>
	<div class="row">
	<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">
  <table class="table table-bordered" style = "float:left;font-size:13px;margin-top:15px;">
    <thead>
      <tr>
		<th colspan="4">Петък</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT class.time, class.subject, class.info FROM class, day, weeks, twoweeks, uw, user WHERE user.UID = uw.UserID AND twoweeks.UID = uw.TwoWeeksID AND twoweeks.".$eoweek." = weeks.UID AND day.UID = weeks.FridayID AND class.UID = day.class".$i."ID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			
				
			$result3 = mysql_query($SQL);
			$row3 = mysql_fetch_array($result3);
		
		
			echo '<tbody>';
			echo '<td>'.$i.'</td>
				<td>'.$row3[0].'</td>
				<td>'.$row3[1].'</td>
				<td>'.$row3[2].'</td>';
			echo '</tbody>';
		}
	?>
  </table>
  </div>
	<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">
  <table class="table table-bordered" style = "float:left;font-size:13px;margin-top:15px;">
    <thead>
      <tr>
		<th colspan="4">Събота</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT class.time, class.subject, class.info FROM class, day, weeks, twoweeks, uw, user WHERE user.UID = uw.UserID AND twoweeks.UID = uw.TwoWeeksID AND twoweeks.".$eoweek." = weeks.UID AND day.UID = weeks.SaturdayID AND class.UID = day.class".$i."ID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			
				
			$result3 = mysql_query($SQL);
			$row3 = mysql_fetch_array($result3);
		
		
			echo '<tbody>';
			echo '<td>'.$i.'</td>
				<td>'.$row3[0].'</td>
				<td>'.$row3[1].'</td>
				<td>'.$row3[2].'</td>';
			echo '</tbody>';
		}
	?>
  </table>
   </div>
   </div>
	<div class="row">
	<div class="col-sm-5" style = "margin:10px;background-color: white;border-radius:7px;">
  <table class="table table-bordered" style = "float:left;font-size:13px;margin-top:15px;">
    <thead>
      <tr>
		<th colspan="4">Неделя</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT class.time, class.subject, class.info FROM class, day, weeks, twoweeks, uw, user WHERE user.UID = uw.UserID AND twoweeks.UID = uw.TwoWeeksID AND twoweeks.".$eoweek." = weeks.UID AND day.UID = weeks.SundayID AND class.UID = day.class".$i."ID AND user.Name = '".$username."' ORDER BY twoweeks.UID DESC";
			
				
			$result3 = mysql_query($SQL);
			$row3 = mysql_fetch_array($result3);
		
		
			echo '<tbody>';
			echo '<td>'.$i.'</td>
				<td>'.$row3[0].'</td>
				<td>'.$row3[1].'</td>
				<td>'.$row3[2].'</td>';
			echo '</tbody>';
		}
	?>
  </table>
  </div></div></div>
</div>
</div>
<?php
if (isset($_SESSION['garbage'])) {
	if ($_SESSION['garbage'] > 0) {
		echo '<script>alert("Thank you! You deleted '.$_SESSION['garbage'].' useless data.")</script>';
	} else {
		echo '<script>alert("There is not garbage for deletion!")</script>';
	}
	unset($_SESSION['garbage']);
}
?>
</body>
</html>