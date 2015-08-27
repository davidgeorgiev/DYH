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
$SQL = "SELECT DISTINCT COUNT(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND ((homeworks.Data LIKE '%".$searched_string."%') OR (homeworks.Title LIKE '%".$searched_string."%')) ORDER BY homeworks.Date DESC";
$result3 = mysql_query($SQL);
$row3 = mysql_fetch_array($result3);

echo '<div class="page-header">';
echo '<h1>Търсене за <spam style = "color: #006600">"'.$searched_string.'"</spam><small id = "smalltag"> (резултати: '.$row3[0].')</small></h1>';
echo '</div>';

if ($row3[0] <= 0) {
	echo 'Няма съвпадения';
} else {
	$SQL = "SELECT DISTINCT homeworks.Date, homeworks.Title, homeworks.Data, homeworks.Rank, WEEKDAY(homeworks.Date), imgurl.URL, homeworks.UID FROM homeworks,user,uh,imgurl,hwimg WHERE imgurl.UID = hwimg.IMGURLID AND hwimg.HWID = homeworks.UID AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND ((homeworks.Data LIKE '%".$searched_string."%') OR (homeworks.Title LIKE '%".$searched_string."%')) ORDER BY homeworks.Date DESC";
	$result = mysql_query($SQL);
	while ($row = mysql_fetch_array($result)){
		
		$weekday = $row[4];
		include "convert_weekday.php";
		
		switch($row[3]){
			case 1: $current_rank = '#99D6AD';
			break;
			case 2: $current_rank = '#FFFF66';
			break;
			case 3: $current_rank = '#FFAD33';
			break;
			case 4: $current_rank = '#FFB2B2';
			break;
		}
		
		echo '<div class="alert alert-warning alert-dismissible" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo '<div class="panel-body" style = "background-color: '.$current_rank.'"><strong>';
			echo $row[1]." (за ".$row[0]." - ".$convertered_weekday.")";
			echo '</strong></div>';
			echo '<div class="panel-footer">'.$row[2].'</div>';
			if (strlen($row[5])>0){
				echo ' <p style = "border-width:thin; border-style: solid;background-color:#F3F3F3;border-color: #BEBEBE;border-radius:5px; padding: 9px;"><a href = "'.$row[5].'" rel="lightbox"><img src="'.$row[5].'" alt="HomeWork image" width="20%"></a></p>';
			}
			if ($EditMode == 0) {
				//echo '	<h3 style = "background-color: '.$color.';border-width:thin; border-style: solid;border-color: #d0d0d0;border-radius:5px; padding: 5px;">'.$row2[0].'</h3>';
			} else {
				
				echo '<ul>';
				echo '<li><a href="delete_hw.php?hwid='.$row[6].'&class='.$username.'"><span class="glyphicon glyphicon-trash"></span> Изтрий</a></li>';
				echo '<li><a href="edit_hw.php?hwid='.$row[6].'&class='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Редактирай</a></li>';
				echo '</ul>';
			}
		echo '</div>';

	
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