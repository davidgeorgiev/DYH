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
echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';

$searched_string = $_GET['searching_for'];
$SQL = "SELECT DISTINCT COUNT(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND ((homeworks.Data LIKE '%".$searched_string."%') OR (homeworks.Title LIKE '%".$searched_string."%')) ORDER BY homeworks.Date DESC";
$result3 = mysql_query($SQL);
$row3 = mysql_fetch_array($result3);

echo '<div class="page-header">';
echo '<h1>Търсене за <spam style = "color: #006600">"'.$searched_string.'"</spam><small id = "smalltag"> (резултати: '.$row3[0].')</small></h1>';
echo '</div>';
include "some_external_phps/return_hw_info_by_id.php";
if ($row3[0] <= 0) {
	echo 'Няма съвпадения';
} else {
	$SQL = "SELECT DISTINCT homeworks.UID FROM homeworks WHERE ((homeworks.Data LIKE '%".$searched_string."%') OR (homeworks.Title LIKE '%".$searched_string."%')) ORDER BY homeworks.Date DESC";
	$result = mysql_query($SQL);
	$counter = 0;
	while ($row = mysql_fetch_array($result)){
		$counter++;
		$MyHomeworkInfoArray = returnHomeworkInfoByID($row[0]);
		$weekday = $MyHomeworkInfoArray["MainInfo"]["WEEKDAY"];
		include "convert_weekday.php";
		
		switch($MyHomeworkInfoArray["MainInfo"]["Rank"]){
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
			echo '<div class="panel-body" style = "background-color: '.$current_rank.';font-size:16px;padding-bottom:3px;"><strong>';
			if ($MyHomeworkInfoArray["MainInfo"]["Type"] == 1){
				$MyType = "Изпит";
			} else {
				$MyType = "Домашно";
			}
			echo $counter.". ".$MyType." по ".$MyHomeworkInfoArray["MainInfo"]["Title"]." (".$MyHomeworkInfoArray["MainInfo"]["Date"]." - ".$convertered_weekday.")";
			echo '</strong>';
			
			echo '<div class="dropdown" style = "float:right;">';
			echo '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:100%;">';
			echo '<span class="glyphicon glyphicon-comment"></span> Коментари ('.$MyHomeworkInfoArray["MainInfo"]["NumOfComments"].')';
			//echo '<span class="caret"></span>';
			echo '</button>';
			echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">';
			//echo '<li><a href=""><span class="glyphicon glyphicon-trash"></span> Изтрий</a></li>';
			foreach($MyHomeworkInfoArray["Comments"] as $value){
				echo '<li><a><strong>Публикувано от '.$value["Name"].'</strong></li></a>';
				echo '<li><a><span style = "font-size:10px;"> '.$value["Date"].'</li></a>';
				echo '<li><a>'.$value["Data"].'</li></a>';
			}
			echo '</ul>';
			echo '</div>';
			
			echo '</div>';
			
			
			//echo '<div class="panel-footer">'.$row[2].'</div>';
			echo '<div class="row">';
			if (strlen($MyHomeworkInfoArray["MainInfo"]["IMGURL"])>0){
				$preview_image = $MyHomeworkInfoArray["MainInfo"]["IMGURL"];
			} else {
				$preview_image = "themes/no-image.jpg";
			}
				echo ' <div class="col-sm-3" style = "margin:10px;border-radius:7px;">';
				echo ' <div style = "border-width:thin; border-style: solid;background-color:#F3F3F3;border-color: #BEBEBE;border-radius:5px; padding: 9px;"><a href = "'.$preview_image.'" rel="lightbox"><img src="'.$preview_image.'" alt="HomeWork image" width="100%"></a></div>';
				echo '</div>';
			
			echo ' <div class="col-sm-8" style = "margin-top:10px;border-width:thin; border-style: solid;background-color:#F3F3F3;border-color: #BEBEBE;border-radius:5px; padding: 9px;">';
			echo '<div>'.$MyHomeworkInfoArray["MainInfo"]["Data"].'</div>';
			echo '</div>';
			echo '</div>';
			if ($EditMode == 0) {
				//echo '	<h3 style = "background-color: '.$color.';border-width:thin; border-style: solid;border-color: #d0d0d0;border-radius:5px; padding: 5px;">'.$row2[0].'</h3>';
			} else {
				
				echo '<div style = "margin-top:10px;border-width:thin; border-style: solid;background-color:#F3F3F3;border-color: #BEBEBE;border-radius:5px; padding: 9px;">';
				echo '<li><a href="delete_hw.php?hwid='.$row[0].'&class='.$username.'"><span class="glyphicon glyphicon-trash"></span> Изтрий</a></li>';
				echo '<li><a href="edit_hw.php?hwid='.$row[0].'&class='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Редактирай</a></li>';
				//echo '<li><a href="comments.php?hwid='.$row[0].'&class='.$username.'"><span class="glyphicon glyphicon-comment"></span> Коментари ('.$MyHomeworkInfoArray["MainInfo"]["NumOfComments"].')</a></li>';
				
				echo '</div>';
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