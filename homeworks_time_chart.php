

<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	include (dirname("../")."/css/progressbar.php");
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

	function MakeStartAndFinalDates($week_number, $year){
		$week_start = new DateTime();
		$week_start->setISODate($year,$week_number);
		$strDateFrom = $week_start->format('Y-m-d');
		$strDateTo = date('Y-m-d', strtotime($strDateFrom. ' + 6 days'));
		
		return array($strDateFrom,$strDateTo);
	}
	include "graphs/convert_weekday_from_php.php";
	include (dirname("../")."/some_external_phps/return_hw_info_by_id.php");
	include (dirname("../")."/some_external_phps/CheckIfUserIsSolver.php");
	include "graphs/make_chart.php";
	include "graphs/collect_data.php";
	include "graphs/my_week_dropdown_buttons.php";
	include "graphs/convert_month_to_word.php";
	function PrintAChart($IdOfChart, $username, $strDateFrom, $strDateTo, $PrevMonth, $EditMode, $timezone){
		
		$done_array1 = CollectData(1, $username, $strDateFrom, $strDateTo);
		$done_array0 = CollectData(0, $username, $strDateFrom, $strDateTo);
		$done_array2 = CollectData(2, $username, $strDateFrom, $strDateTo);
		$done_array_1 = CollectData(-100, $username, $strDateFrom, $strDateTo);//Empty data to skip cyan color in chart
		$done_array3 = CollectData(-1, $username, $strDateFrom, $strDateTo);
		
		
		$MyFinalArray = array($done_array1,$done_array0, $done_array2, $done_array_1, $done_array3);
		$MyChart = MakeMyChart($MyFinalArray, "Напрегнатост", "area", "c".$IdOfChart);
		
		$MyDate = date_create($done_array1[6][0]);
		$MyLastDayOfThisWeekMonth = date_format($MyDate, "m");
		$MyYearToShow = date_format($MyDate, "Y");
		if ($MyLastDayOfThisWeekMonth != $PrevMonth){
			echo '<div class="page-header">';
			echo '<h1 style = "color:#837d7c;">'.ConvertMonthToWord($MyLastDayOfThisWeekMonth)." ".$MyYearToShow.'</h1>';
			echo '</div>';
		}
		
		if (($_GET["width"] < 385) && ($_GET["height"] > $_GET["width"])){
			$MyWidth = 160;
			$MyLeftMargin = -30;
		} else if (($_GET["width"] >= 385) && (($_GET["width"] < 530) && ($_GET["height"] > $_GET["width"]))){
			$MyWidth = 140;
			$MyLeftMargin = -18;
		}
		else if (($_GET["width"] >= 530) && ($_GET["height"] > $_GET["width"])){
			$MyWidth = 132;
			$MyLeftMargin = -13;
		} else {
			$MyWidth = 100;
			$MyLeftMargin = 0;
		}
		
		if ($_GET["height"] > $_GET["width"]){
			$MyButtonWidth = 100;
			$MyButtonLeftMargin = 0;
		} else {
			$MyButtonWidth = $MyWidth;
			$MyButtonLeftMargin = 8;
		}
		$MyHeight = 75;
		PrintMyWeekDropdownButtons($MyFinalArray[0],$EditMode,$username,$MyButtonWidth,$MyButtonLeftMargin, 0, $timezone);
		
		echo '<div style="margin-left:'.$MyLeftMargin.'%;width:'.$MyWidth.'%;height:'.$MyHeight.'%; min-width:100px;">';
			echo $MyChart; 
		echo '</div>';
		
		return $MyLastDayOfThisWeekMonth;
	}
	
	function PrintMyCharts($numberOfWeeks, $week_number, $year, $username, $EditMode, $timezone){
		$PrevMonth = 0;
		for ($counter = 1; $counter <= $numberOfWeeks; $counter++){
			
			$StartAndFinelDates = MakeStartAndFinalDates($week_number, $year);
			$strDateFrom = $StartAndFinelDates[0];
			$strDateTo = $StartAndFinelDates[1];
			
			$PrevMonth = PrintAChart($counter, $username, $strDateFrom, $strDateTo, $PrevMonth, $EditMode, $timezone);
			
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
<div class="container">
<?php 
include "main_menu.php"; 
echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';

	
	include "some_external_phps/LegendButtonsForChart.php";
	PrintChartHeader($username, $_GET["weeknum"], 1, "");
	
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
	
	
	PrintMyCharts($numberOfWeeks, $week_number, $year, $username, $EditMode, $timezone);
}
?>
</div>
</body>
</html>