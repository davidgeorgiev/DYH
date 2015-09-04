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
	// NOW LET'S USE $dates_array and $daily_rank_sum_arr for the graph :D
	
	
}



	
?>


<div id="chart"></div>

<script>

var chart = c3.generate({
    bindto: '#chart',
    data: {
        x: 'x',
//        xFormat: '%Y%m%d', // 'xFormat' can be used as custom format of 'x'
        columns: [
            ['x'
<?php

foreach ($dates_array as &$value) {
		echo ", '".$value."'";
}
unset($value);

?>
],
//            ['x', '20130101', '20130102', '20130103', '20130104', '20130105', '20130106'],
            ['Домашни'
<?php
	
	foreach ($daily_rank_sum_arr as &$value) {
		echo ", ".$value;
}
unset($value);

?>
],['Изпити'
<?php
	$type_for_search = 0;
	include "graphs/collect_data.php";
	foreach ($daily_rank_sum_arr as &$value) {
		echo ", ".$value;
}
unset($value);
?>

			]
			//,['data2', 130, 340, 200, 500, 250, 350]
        ]
    },
    axis: {
        x: {
            type: 'timeseries',
            tick: {
                format: '%Y-%m-%d'
            }
        }
    }
});

// setTimeout(function () {
    // chart.load({
        // columns: [
            // ['data3', 400, 500, 450, 700, 600, 500]
        // ]
    // });
// }, 1000);
    

</script>




</div>
</div>
</body>
</html>