<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	include "graphs/make_chart.php";
	include "graphs/create_date_range.php";
	include "graphs/collect_data.php";
	include "graphs/my_week_dropdown_buttons.php";
	include "graphs/convert_month_to_word.php";
?>


<body>

<?php
	$ViewAllDays = false;
	$EditMode = 0;
	if (isset($_GET['show_all_days'])){
		$ViewAllDays = $_GET['show_all_days'];
	}
	
	if (isset($_GET['user'])) {
		$username = $_GET['user'];
	}
	if (isset ($_SESSION['psw'])) {
		$password = $_SESSION['psw'];
	} else {
		$password = -1;
	}
	
	include "CheckEditMode.php";
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;
	
	if ($_SESSION['page'] != 'check_width'){
		header('Location: check_width_and_send_to.php?user='.$username.'&page=homeworks_time_chart&weeknum='.$_GET["weeknum"].'&numofweeks='.$_GET["numofweeks"]) and exit;
	}
	
	$_SESSION['page'] = "other";
?>
<div class="container">
<?php 
include "main_menu.php"; 
echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';

echo '<div><div class="dropdown" style = "float:left;padding-right:10px;">
	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:60px;height:46px;">
	<span class="glyphicon glyphicon-wrench"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">';
	
	for ($counter = 1; $counter <= 15; $counter++) {
		if ($counter == 1){
			$MyWord = " седмица";
		} else {
			$MyWord = " седмици";
		}
		echo '<li><a href="check_width_and_send_to.php?user='.$username.'&page=homeworks_time_chart&weeknum='.$_GET["weeknum"].'&numofweeks='.$counter.'">Покажи '.$counter.$MyWord.'</a></li>';
	}
	
	echo '</div><div style = "text-align:center;border:1px solid #c8ccc1;border-radius: 5px;padding: 4.5px;color: #243746;background-color: white;font-size:24;font-family:Arial	;font-weight: bold;">Графики на натовареност (показани '.$_GET["numofweeks"].' седмици)</div></div>';
	echo '
	<div class="btn-group btn-group-justified" role="group" style = "width:100%;margin-bottom:30px;">
	<div class="btn-group" role="group">
	<button type="button" class="btn btn-default" style = "background: #86cf4b;border-color: #837d7c;border-width:3px;">Домашни</button>
	</div>
	<div class="btn-group" role="group">
	<button type="button" class="btn btn-default" style = "background: #4ba8cf;border-color: #837d7c;border-width:3px;">Изпити</button>
	</div>
	<div class="btn-group" role="group">
	<button type="button" class="btn btn-default" style = "background: #dd8043;border-color: #837d7c;border-width:3px;">Други</button>
	</div>
	</div>
	';
	
	
	$SQL = "SELECT DISTINCT COUNT(user.Name) FROM user WHERE user.Name = '".$username."'";
	$result4 = mysql_query($SQL);
	$there_is_a_such_user = mysql_fetch_array($result4);
	
	if ($there_is_a_such_user[0] <= 0) {	
		echo '<div class="alert alert-danger">';
		echo '<strong>Грешка! </strong>Няма такъв потребител!';
		echo '</div>';
	} else {	
		if ($ViewAllDays == false) {
			$result = mysql_query("SELECT DISTINCT homeworks.Date FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date >= '".date("Y-m-d")." 00:00:00' ORDER BY homeworks.Date ASC");
		} else {
			$result = mysql_query("SELECT DISTINCT homeworks.Date FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID");
		}
		$there_are_some_homeworks = mysql_fetch_array($result);
		
		if ($there_are_some_homeworks[0] <= 0) {	
			echo '<div class="alert alert-success">';
			echo '<strong>Честито! </strong>Нямате предстоящи домашни или контролни!';
			echo '</div>';
		}
	}
if (isset($_GET["numofweeks"])){
	$numberOfWeeks = $_GET["numofweeks"];
} else {
	$numberOfWeeks = 1;
}
if (($there_is_a_such_user[0] > 0) && ($there_are_some_homeworks[0] > 0)) {
	//echo 'START COLLECTING DATA...';
	$week_number = $_GET["weeknum"];
	$year = date("Y");
	$PrevMonth = 0;
	for ($counter = 1; $counter <= $numberOfWeeks; $counter++){
		$done_array1 = CollectData(1, $username, $week_number, $year);
		$done_array0 = CollectData(0, $username, $week_number, $year);
		$done_array2 = CollectData(2, $username, $week_number, $year);
		$MyFinalArray = array($done_array1,$done_array0, $done_array2);
		$MyChart = MakeMyChart($MyFinalArray, "Напрегнатост", "area", "c".$counter);
		$MyDate = date_create($done_array1[6][0]);
		$MyLastDayOfThisWeekMonth = date_format($MyDate, "m");
		$MyYearToShow = date_format($MyDate, "Y");
		if ($MyLastDayOfThisWeekMonth != $PrevMonth){
			echo '<div class="page-header">';
			echo '<h1 style = "color:#837d7c;">'.ConvertMonthToWord($MyLastDayOfThisWeekMonth)." ".$MyYearToShow.'</h1>';
			echo '</div>';
		}
		$PrevMonth = $MyLastDayOfThisWeekMonth;
		PrintMyWeekDropdownButtons($MyFinalArray[0],$EditMode,$username);
		echo '<div style="width:100%;height:'.($_GET["height"]-200).'px; min-width:100px;">';
			echo $MyChart; 
		echo '</div>';
		
		$week_number++;
		
		$ddate = $year."-12-31";
		$date = new DateTime($ddate);
		$last_week_of_year = $date->format("W");
		
		//echo $week_number." ".$year." ".date('Y-m-d', strtotime($year."W".$week_number.'1'))." ".date('Y-m-d', strtotime($year."W".$week_number.'7'));
		
		if ($week_number > $last_week_of_year){
			//echo " ".$week_number." > ".$last_week_of_year;
			$week_number = 1;
			$year++;
			//echo '<div class="page-header">';
			//echo '<h1 style = "color:#837d7c;">'.$week_number." ".$year.'</h1>';
			//echo '</div>';
		}
	}
	
}
?>
</div>
</body>
</html>