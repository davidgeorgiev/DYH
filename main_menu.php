<?php
	$page = $_SESSION['page'];
?>
<!-- <a class="btn btn-primary btn-lg"  style = "margin:10px;" href="add_hw.php" role="button">Добави ново домашно</a><a class="btn btn-primary btn-lg" href="add_info.php" role="button">Добави допълнителна информация</a><a class="btn btn-primary btn-lg" style = "margin-left:10px;" href="add_wp.php" role="button">Нова програма</a>'; -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="home.php"><span class = "glyphicon glyphicon-education"></span> DYH</a>
	</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<?php
	
	if (isset($_SESSION['page'])) {
		$SQL = "SELECT COUNT(user.Name) FROM user WHERE user.Password = '".$password."'";
		$result = mysql_query($SQL);
		$number_of_users = mysql_fetch_array($result);
		
		if ($number_of_users[0] <= 0) {
			echo '<li><a href="index.php">Регистрирай се безплатно <span class="sr-only">(current)</span></a></li>';
		}
		if ($page == "home") {
			echo '<li><a href="history.php?user='.$username.'"><span class = "glyphicon glyphicon-time"></span> Отиди на историята<span class="sr-only">(current)</span></a></li>';
		} else if (($page == "history") || ($page == "other")){
			echo '<li><a href="home.php?user='.$username.'"><span class = "glyphicon glyphicon-home"></span> Върни ме на началото<span class="sr-only">(current)</span></a></li>';
		}
	} else {
			echo '<li><a href="index.php">Регистрирай се безплатно <span class="sr-only">(current)</span></a></li>';
	}
	

?>



<?php
	//include "CheckEditMode.php";
	if ($EditMode == 1){
		echo 	'<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class = "glyphicon glyphicon-align-justify"></span> Опции </a><ul class="dropdown-menu">
				<li><a href="add_hw.php">Добави ново домашно</a></li>
				<li><a href="add_info.php">Добави допълнителна информация</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="add_wp.php">Нова програма</a></li>
				<li><a href="check_width_and_send_to.php?user='.$username.'&page=update_subject_list'.'">Обнови списъка с предмети</a></li>
				<li role="separator" class="divider"></li>
				</ul></li>';
	}
?>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class = "glyphicon glyphicon-search"></span> Търсене</a><ul class="dropdown-menu">
<form class="navbar-form navbar-left" <?php echo 'action='; echo "redirect_to_search_hw.php?user=".$username;?> method="post">
<div class="form-group">
<input type="text" name="what_to_search" class="form-control" placeholder="Търси домашни">
</div>
<button type="submit" class="btn btn-default">Давай</button>
</form>
<form class="navbar-form navbar-left" <?php echo 'action='; echo "redirect_to_search_us.php?user=".$username;?> method="post">
<div class="form-group">
<input type="text" name="what_to_search" class="form-control" placeholder="Търси потребители">
</div>
<button type="submit" class="btn btn-default">Давай</button>
</form>
</ul>
</ul></li>
<ul class="nav navbar-nav navbar-right">
<?php
	if (strlen($username > 0)) {
		$temp_username = $username;
	} else {
		$temp_username = "гост";
	}

echo '<li><a href = "curriculum.php?user='.$username.'"><strong><span class = "glyphicon glyphicon-list-alt"></span> Програма</strong></a></li>';
echo 	'<li class="dropdown">

<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong><span class = "glyphicon glyphicon-calendar"></span> Графики</strong></a><ul class="dropdown-menu">
<li><a href="homeworks_time_chart.php?user='.$username.'&weeknum='.date("W").'&numofweeks=4">Задачи за седмица</a></li>
<li role="separator" class="divider"></li>
<li><a href="#">Всички потребители (предстоящи)</a></li>
<li><a href="#">Всички потребители (история)</a></li>
<li role="separator" class="divider"></li>
</ul></li>';

?>
<li><a href="#">Страницата на <?php echo $username?></a></li>
<li><a href="index.php"><strong><span class = "glyphicon glyphicon-log-out"></span> Изход</strong></a></li>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
<?php include "sideaccounts.php"?>
