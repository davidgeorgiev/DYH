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
	$_SESSION['page'] = "other";
	
?>

<div class="container">
<?php
include "main_menu.php";
echo '<div id = "my_page">';

$searched_string = $_GET['searching_for'];
$SQL = "SELECT DISTINCT COUNT(user.Name) FROM user WHERE user.Name LIKE '%".$searched_string."%' ORDER BY user.Name DESC";
$result3 = mysql_query($SQL);
$row3 = mysql_fetch_array($result3);

echo '<div class="page-header">';
echo '<h1>Търсене за <spam style = "color: #006600">"'.$searched_string.'"</spam><small id = "smalltag"> (резултати: '.$row3[0].')</small></h1>';
echo '</div>';

if ($row3[0] <= 0) {
	echo 'Няма съвпадения';
} else {
	$SQL = "SELECT DISTINCT user.Name FROM user WHERE user.Name LIKE '%".$searched_string."%' ORDER BY user.Name ASC";
	$result = mysql_query($SQL);
	while ($row = mysql_fetch_array($result)){
		
		
		
		echo '<div class="alert alert-warning alert-dismissible" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo '<div class="panel-body"><a href = "home.php?user='.$row[0].'"><strong>';
			echo $row[0];
			echo '</strong></div></div>';
			//echo '<div class="panel-footer">'.$row[2].'</div>';
			

	
		//echo $row[0];
		//echo $row[1];
		//echo $row[2];
		//echo $row[3];
	}
}
?>
	
</div>

</body>
</html>