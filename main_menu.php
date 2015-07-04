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
			<a class="navbar-brand" href="home.php">DYH</a>
	</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<?php
	if (isset($_SESSION['page'])) {
		if ($page == "home") {
			echo '<li class="active"><a href="history.php">История <span class="sr-only">(current)</span></a></li>';
		} else {
			echo '<li class="active"><a href="home.php">Начало <span class="sr-only">(current)</span></a></li>';
		}
	} else {
		echo '<li class="active"><a href="home.php">Начало <span class="sr-only">(current)</span></a></li>';
	}
	

?>



<?php
	//include "CheckEditMode.php";
	if ($EditMode == 1){
		echo 	'<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Опции <span class="caret"></span></a><ul class="dropdown-menu">
				<li><a href="add_hw.php">Добави ново домашно</a></li>
				<li><a href="add_info.php">Добави допълнителна информация</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="add_wp.php">Нова програма</a></li>
				<li role="separator" class="divider"></li>
				</ul></li>';
	}
?>

</ul>
<form class="navbar-form navbar-left" role="search">
<div class="form-group">
<input type="text" class="form-control" placeholder="Search">
</div>
<button type="submit" class="btn btn-default">Submit</button>
</form>
<ul class="nav navbar-nav navbar-right">
<li><a href="index.php">Изход</a></li>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
<?php include "sideaccounts.php"?>
