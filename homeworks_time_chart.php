<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
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
echo '<div id = "my_page">';
?>



<!-- Load c3.css -->
<link href="graphs/c3.css" rel="stylesheet" type="text/css">

<!-- Load d3.js and c3.js -->
<script src="graphs/d3.min.js" charset="utf-8"></script>
<script src="graphs/c3.min.js"></script>

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
	$type_for_search = 1;
	include "graphs/create_date_range.php";
	include "graphs/collect_data.php";
	$dates_array1 = $dates_array;
	$daily_rank_sum_arr1 = $daily_rank_sum_arr;
	$type_for_search = 0;
	include "graphs/collect_data.php";
	// NOW LET'S USE $dates_array and $daily_rank_sum_arr for the graph :D
	//include "index2.php";
	$dates_array0 = $dates_array;
	$daily_rank_sum_arr0 = $daily_rank_sum_arr;
	
}
include("graphs/lib/inc/chartphp_dist.php");
 $p = new chartphp();
 

//$dates_array and $daily_rank_sum_arr
//$dates_array = array("1","2","3");
//$daily_rank_sum_arr = array("1","2","3");

$done_array1 = array();
$done_array0 = array();


for ($i = 0;$i < sizeof($dates_array1);$i++){
	array_push($done_array1,(array($dates_array1[$i],$daily_rank_sum_arr1[$i]*10)));
}
for ($i = 0;$i < sizeof($dates_array0);$i++){
	array_push($done_array0,(array($dates_array0[$i],$daily_rank_sum_arr0[$i]*10)));
}
$p->data = array($done_array1,$done_array0);

$p->chart_type = "line";

// Common Options
$p->title = "";
$p->ylabel = "Напрегнатост";

$p->options["axes"]["yaxis"]["tickOptions"]["prefix"] = '';

$out = $p->render('c1');



	
?>
<script src="graphs/lib/js/jquery.min.js"></script>
<script src="graphs/lib/js/chartphp.js"></script>
<link rel="stylesheet" href="graphs/lib/js/chartphp.css">

<style>
.btn-group {
	 width: <?php echo 93/(sizeof($dates_array1));?>%;
}
.btn btn-default dropdown-toggle {
	width: 100%;
}
</style>
<div style = "margin-left: 5%;">
<?php
	foreach ($dates_array1 as $value){
		echo '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
		$timestamp = strtotime($value);
		$weekday = date( "w", $timestamp);
		include "convert_weekday_from_php.php";
		
		echo $convertered_weekday;
		echo '<span class="caret"></span>';
        echo '</button>';
		echo '<ul class="dropdown-menu" style = "background-color: #d0c8c8;">';
		$SQL = "SELECT homeworks.Data, homeworks.Title, homeworks.Rank, homeworks.Type FROM homeworks WHERE homeworks.Date = '".$value."'";
		$result4 = mysql_query($SQL);
		$SQL = "SELECT COUNT(homeworks.UID) FROM homeworks WHERE homeworks.Date = '".$value."'";
		$result5 = mysql_query($SQL);
		$number_of_hws = mysql_fetch_array($result5);
		if ($number_of_hws[0] <= 0){
			echo '<li><a href="#">Няма нищо</a></li>';
		} else {
			while ($homework_info = mysql_fetch_array($result4)){
				
				if ($homework_info[3] == 0) {
					echo '<li style = "width:90%;margin-left:9px;background-color:#ade77f;text-align:center;">Домашно</li>';
				} else {
					echo '<li style = "width:90%;margin-left:9px;background-color:#7fc5e7;text-align:center;">Изпит</li>';
				}
				echo '<li><a href="#">'.$homework_info[1].'</a></li>';
				if (strlen($homeworks_info[0]) >= 0) {
					echo '<li><a href="#">'.$homework_info[0].'</a></li>';
				}
				//echo '<li><a href="#">'.$homework_info[2].'</a></li>';
				echo '<div style = "width:90%;padding-left:10px;padding-top:20px;">';
				if ($homework_info[2] == 1) {
					echo '<div class="progress">
						<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
							<span class="sr-only">25%</span>
						</div>
					</div>';
				} else if ($homework_info[2] == 2) {
					echo '<div class="progress">
						<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
							<span class="sr-only">50%</span>
						</div>
					</div>';
				} else if ($homework_info[2] == 3) {
					echo '<div class="progress">
						<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
							<span class="sr-only">75%</span>
						</div>
					</div>';
				} else if ($homework_info[2] == 4) {
					echo '<div class="progress">
						<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							<span class="sr-only">100%</span>
						</div>
					</div>';
				}
				echo '</div>';
			}
		}
		echo '</ul>';
		echo '</div>';
	}
	unset($value);
?>
</div>

<div style="width:100%;height:<?php echo $_GET["height"]-200;?>px; min-width:100px;">
            <?php echo $out; ?>
        </div>


<nav style = "position: absolute;margin-left: 27%;margin-top:-5%;">
	<ul class="pagination">
		<li>
			<a href="homeworks_time_chart.php?user=david&weeknum=<?php echo $weeknum-1;?>" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
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
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>
	</ul>
</nav>




</div>
</body>
</html>