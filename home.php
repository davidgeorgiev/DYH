<?php
	echo '<html>';
	include "head.php";
	include "config.php";
?>
<body>

<?php
	if (isset($_GET["class"])){
		//echo "THE CLASS IS ".$_GET["class"];
	}else{
		header('Location: index.php');
	}
?>

<div class="container">
  <div class="jumbotron">
    <h1>Домашни</h1>
    <p><?php echo $_GET["class"]?></p> 
	<p><a class="btn btn-primary btn-lg" style = "margin:10px;" href="history.php?class=<?php echo $_GET["class"];?>" role="button">История</a><a class="btn btn-primary btn-lg" href="add_hw.php?class=<?php echo $_GET["class"];?>" role="button">Добави ново домашно</a><a class="btn btn-primary btn-lg" style = "margin:10px;" href="add_info.php?class=<?php echo $_GET["class"];?>" role="button">Добави допълнителна информация</a><a class="btn btn-primary btn-lg" href="add_wp.php?class=<?php echo $_GET["class"];?>" role="button">Нова програма</a></p>
  </div>
  <?php
	if ($result = mysql_query("SELECT DISTINCT homeworks.date, WEEKDAY(homeworks.date) FROM Homeworks,User,UH WHERE USER.NAME = '".$_GET["class"]."' AND UH.HWID = HomeWorks.UID AND UH.USERID = USER.UID AND Homeworks.date >= '".date("Y-m-d")." 00:00:00' ORDER BY homeworks.date ASC")){
		//echo 'Success';
	} else {
		echo 'FAIL';
	}
	
	$SQL = "SELECT DISTINCT COUNT(homeworks.date), WEEKDAY(homeworks.date) FROM Homeworks,User,UH WHERE USER.NAME = '".$_GET["class"]."' AND UH.HWID = HomeWorks.UID AND UH.USERID = USER.UID AND Homeworks.date >= '".date("Y-m-d")." 00:00:00' ORDER BY homeworks.date ASC";
	$result3 = mysql_query($SQL);
	$row3 = mysql_fetch_array($result3);
	$SQL = "SELECT DISTINCT COUNT(otherinfo.title) FROM otherinfo,User,UOI WHERE USER.NAME = '".$_GET["class"]."' AND UOI.UserID = User.UID AND UOI.OtherInfoID = OtherInfo.UID  ORDER BY otherinfo.UID DESC";
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
		echo '<h1>'.$weekday.' <small id = "smalltag">'.$row[0].'</small></h1>';
		echo '</div>';
		echo '<div class="row">';
		$result2 = mysql_query("SELECT homeworks.title, homeworks.data, homeworks.rank, homeworks.UID FROM Homeworks,User,UH WHERE USER.NAME = '".$_GET["class"]."' AND UH.HWID = HomeWorks.UID AND UH.USERID = USER.UID AND homeworks.date = '".$row[0]." 00:00:00' ORDER BY homeworks.UID DESC");
		while ($row2 = mysql_fetch_array($result2)){
			echo '	<div class="col-sm-4">';
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
			echo '	<h3 style = "background-color: '.$color.';border-width:thin; border-style: solid;border-color: #d0d0d0;border-radius:5px; padding: 5px;">'.$row2[0].'</h3>';
			echo '	<p style = "border-width:thin; border-style: solid;background-color:#F3F3F3;border-color: #BEBEBE;border-radius:5px; padding: 9px;">'.$row2[1].'</p>';
			echo '<form id="tab" role="form"'; echo "action="; echo '"delete_hw.php?hwid='.$row2[3].'&class='.$_GET["class"].'"'; echo ' method="post">
				<button class="btn btn-default" style = "background-color:white;width:40%;;height:27px;padding:3px;" type="submit" >Изтрий</button>
			</form>';
			echo '</div>';
		}
		echo '	</div>';
	}
	
	if ($result = mysql_query("SELECT DISTINCT COUNT(otherinfo.title) FROM otherinfo,User,UOI WHERE USER.NAME = '".$_GET["class"]."' AND UOI.UserID = User.UID AND UOI.OtherInfoID = OtherInfo.UID  ORDER BY otherinfo.UID DESC")){
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
		if ($result = mysql_query("SELECT DISTINCT otherinfo.title,otherinfo.data,otherinfo.UID FROM otherinfo,User,UOI WHERE USER.NAME = '".$_GET["class"]."' AND UOI.UserID = User.UID AND UOI.OtherInfoID = OtherInfo.UID  ORDER BY otherinfo.UID DESC")){
			//echo 'Success';
		} else {
			echo 'FAIL';
		}
		while ($row = mysql_fetch_array($result)){
			echo '<div class="col-sm-4">';
			echo '<h3>'.$row[0].'</h3>';
			echo '<p>'.$row[1].'</p>';
			echo '<form id="tab" role="form"'; echo "action="; echo '"delete_info.php?infoid='.$row[2].'&class='.$_GET["class"].'"'; echo ' method="post">
				<button class="btn btn-default" style = "background-color:white;width:40%;;height:27px;padding:3px;" type="submit" >Изтрий</button>
			</form>';
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
	<div class="jumbotron" >
	<h2>Учебната програма</h2>
	<?php
		$eoweek = 0;
		$ddate = date("Y-m-d");
		$date = new DateTime($ddate);
		$week = $date->format("W");
		//echo "Weeknummer: $week";
		if($week&1) {
			$eoweek = "ODDWEEKID";
			echo '<p>Седмицата е нечетна</p>';
		} else {
			$eoweek = "EVENWEEKID";
			echo '<p>Седмицата е четна</p>';
		}
	?>
	
	</div>
  <table class="table table-bordered" style = "float:left;width:49%;">
    <thead>
      <tr>
		<th colspan="4">Понеделник</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT CLASS.TIME, CLASS.SUBJECT, CLASS.INFO FROM CLASS, DAY, WEEKS, TWOWEEKS, UW, USER WHERE USER.UID = UW.USERID AND TWOWEEKS.UID = UW.TWOWEEKSID AND TWOWEEKS.".$eoweek." = WEEKS.UID AND DAY.UID = WEEKS.MONDAYID AND CLASS.UID = DAY.CLASS".$i."ID AND USER.NAME = '".$_GET["class"]."' ORDER BY TWOWEEKS.UID DESC";
			
				
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
  <table class="table table-bordered" style = "float:right;width:49%;">
    <thead>
      <tr>
		<th colspan="4">Вторник</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT CLASS.TIME, CLASS.SUBJECT, CLASS.INFO FROM CLASS, DAY, WEEKS, TWOWEEKS, UW, USER WHERE USER.UID = UW.USERID AND TWOWEEKS.UID = UW.TWOWEEKSID AND TWOWEEKS.".$eoweek." = WEEKS.UID AND DAY.UID = WEEKS.TUESDAYID AND CLASS.UID = DAY.CLASS".$i."ID AND USER.NAME = '".$_GET["class"]."' ORDER BY TWOWEEKS.UID DESC";
			
				
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
  <table class="table table-bordered" style = "float:left;width:49%;">
    <thead>
      <tr>
		<th colspan="4">Сряда</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT CLASS.TIME, CLASS.SUBJECT, CLASS.INFO FROM CLASS, DAY, WEEKS, TWOWEEKS, UW, USER WHERE USER.UID = UW.USERID AND TWOWEEKS.UID = UW.TWOWEEKSID AND TWOWEEKS.".$eoweek." = WEEKS.UID AND DAY.UID = WEEKS.WEDNESDAYID AND CLASS.UID = DAY.CLASS".$i."ID AND USER.NAME = '".$_GET["class"]."' ORDER BY TWOWEEKS.UID DESC";
			
				
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
  <table class="table table-bordered" style = "float:right;width:49%;">
    <thead>
      <tr>
		<th colspan="4">Четвъртък</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT CLASS.TIME, CLASS.SUBJECT, CLASS.INFO FROM CLASS, DAY, WEEKS, TWOWEEKS, UW, USER WHERE USER.UID = UW.USERID AND TWOWEEKS.UID = UW.TWOWEEKSID AND TWOWEEKS.".$eoweek." = WEEKS.UID AND DAY.UID = WEEKS.THURSDAYID AND CLASS.UID = DAY.CLASS".$i."ID AND USER.NAME = '".$_GET["class"]."' ORDER BY TWOWEEKS.UID DESC";
			
				
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
  <table class="table table-bordered" style = "float:left;width:49%;">
    <thead>
      <tr>
		<th colspan="4">Петък</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT CLASS.TIME, CLASS.SUBJECT, CLASS.INFO FROM CLASS, DAY, WEEKS, TWOWEEKS, UW, USER WHERE USER.UID = UW.USERID AND TWOWEEKS.UID = UW.TWOWEEKSID AND TWOWEEKS.".$eoweek." = WEEKS.UID AND DAY.UID = WEEKS.FRIDAYID AND CLASS.UID = DAY.CLASS".$i."ID AND USER.NAME = '".$_GET["class"]."' ORDER BY TWOWEEKS.UID DESC";
			
				
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
  <table class="table table-bordered" style = "float:right;width:49%;">
    <thead>
      <tr>
		<th colspan="4">Събота</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT CLASS.TIME, CLASS.SUBJECT, CLASS.INFO FROM CLASS, DAY, WEEKS, TWOWEEKS, UW, USER WHERE USER.UID = UW.USERID AND TWOWEEKS.UID = UW.TWOWEEKSID AND TWOWEEKS.".$eoweek." = WEEKS.UID AND DAY.UID = WEEKS.SATURDAYID AND CLASS.UID = DAY.CLASS".$i."ID AND USER.NAME = '".$_GET["class"]."' ORDER BY TWOWEEKS.UID DESC";
			
				
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
   </table>
  <table class="table table-bordered" style = "float:left;width:49%;">
    <thead>
      <tr>
		<th colspan="4">Неделя</th>
      </tr>
    </thead>
	<?php
		for ($i=1; $i<=9; $i++){
			
			$SQL = "SELECT CLASS.TIME, CLASS.SUBJECT, CLASS.INFO FROM CLASS, DAY, WEEKS, TWOWEEKS, UW, USER WHERE USER.UID = UW.USERID AND TWOWEEKS.UID = UW.TWOWEEKSID AND TWOWEEKS.".$eoweek." = WEEKS.UID AND DAY.UID = WEEKS.SUNDAYID AND CLASS.UID = DAY.CLASS".$i."ID AND USER.NAME = '".$_GET["class"]."' ORDER BY TWOWEEKS.UID DESC";
			
				
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
</body>
</html>