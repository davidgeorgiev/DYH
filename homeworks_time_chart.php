<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	include "graphs/make_chart.php";
	include "graphs/create_date_range.php";
	include "graphs/collect_data.php";
	include "graphs/my_week_dropdown_butons.php";
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
		header('Location: check_width_and_send_to.php?user='.$username.'&page=homeworks_time_chart&weeknum='.$_GET["weeknum"]) and exit;
	}
	
	$_SESSION['page'] = "other";
?>
<div class="container">
<?php 
include "main_menu.php"; 
echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';
?>
<?php
	
	
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

if (($there_is_a_such_user[0] > 0) && ($there_are_some_homeworks[0] > 0)) {
	//echo 'START COLLECTING DATA...';
	$week_number = $_GET["weeknum"];
	$year = date("Y");
	$done_array1 = CollectData(1, $username, $week_number, $year);
	$done_array0 = CollectData(0, $username, $week_number, $year);
	$MyFinalArray1 = array($done_array1,$done_array0);
	$MyChart = MakeMyChart($MyFinalArray1, "Напрегнатост", "area", "c1");
	
	$week_number++;
	$year = date("Y");
	$done_array1 = CollectData(1, $username, $week_number, $year);
	$done_array0 = CollectData(0, $username, $week_number, $year);
	$MyFinalArray2 = array($done_array1,$done_array0);
	
	$MyChart2 = MakeMyChart($MyFinalArray2, "Напрегнатост", "area", "c2");
}
?>

<?php PrintMyWeekDropdownButtons($MyFinalArray1[0]);?>
<div style="width:100%;height:<?php echo $_GET["height"]-200;?>px; min-width:100px;">
	<?php echo $MyChart; ?>
</div>

<?php PrintMyWeekDropdownButtons($MyFinalArray2[0]);?>
<div style="width:100%;height:<?php echo $_GET["height"]-200;?>px; min-width:100px;">
	<?php echo $MyChart2; ?>
</div>



<nav style = " margin: auto;width: 98%;border-radius:10px;border:3px solid #d2c9c6;background-color:#837d7c;">
	<ul class="pager">
		<li>
			<a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum-1;?>" aria-label="Previous">
				<span aria-hidden="true">Предишна</span>
			</a>
		</li>
		<?php
			$weeknum = $_GET["weeknum"];
		?>
		<li><a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum-3;?>"><?php echo $weeknum-3;?></a></li>
		<li><a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum-2;?>"><?php echo $weeknum-2;?></a></li>
		<li><a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum-1;?>"><?php echo $weeknum-1;?></a></li>
		<li class="active"><a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum;?>"><?php echo $weeknum;?></a></li>
		<li><a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum+1;?>"><?php echo $weeknum+1;?></a></li>
		<li><a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum+2;?>"><?php echo $weeknum+2;?></a></li>
		<li><a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum+3;?>"><?php echo $weeknum+3;?></a></li>
		<li>
			<a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum+1;?>" aria-label="Next">
				<span aria-hidden="true">Следваща</span>
			</a>
		</li>
	</ul>
</nav>




</div>
</body>
</html>