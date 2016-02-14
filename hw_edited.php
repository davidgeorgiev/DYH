<?php
	session_start();
?>
<html>
<?php
include "head.php";
include "config.php";
include "some_external_phps/return_hw_info_by_id.php";


$password = $_SESSION['psw'];
$username = $_SESSION['name'];
$imgurlid = $_SESSION['imgurlid'];
$hwid = $_SESSION['hwid'];

$MyCurrentHomeworkInfo = returnHomeworkInfoByID($hwid);

include "CheckEditMode.php";
$_SESSION['psw'] = $password;
$_SESSION['name'] = $username;

?>
<body>

<div class="container">
<?php
$_SESSION['page'] = "other";
include "main_menu.php"; ?>
	<?php
	if ($db_found && $EditMode == 1) {
		$date = mysql_real_escape_string($_POST['date']);
		$new_date = date('Y-m-d',strtotime($date));
		$title = $_POST["title"];
		$data = $_POST["data"];
		$rank = $_POST["rank"];
		$type = $_POST["type"];

		$data = FixURLsData($data);
		include "some_external_phps/upload.php";
		$SQL = "UPDATE homeworks SET Date = '".$new_date."', Title = '".$title."', Data = '".$data."', Rank = ".$rank.", Type = ".$type." WHERE homeworks.UID = ".$hwid;
		$result = mysql_query($SQL);
		if ($ImageUploaded == 1) {
			if ((strpos($MyCurrentHomeworkInfo["MainInfo"]["IMGURL"], 'dyh_uploads') !== false)&&($ImageUploaded==1)) {
				unlink($MyCurrentHomeworkInfo["MainInfo"]["IMGURL"]);
				$ImageUploaded = 0;
			}
			$imgurl = $target_file;
			$SQL = "SELECT COUNT(UID) FROM hwimg WHERE HWID = ".$hwid;
			$result = mysql_query($SQL);
			$ThereIsUploadedImage = mysql_fetch_array($result);
			if ($ThereIsUploadedImage[0] > 0){
			$SQL = "UPDATE imgurl SET URL = '".$imgurl."' WHERE imgurl.UID = ".$imgurlid;
			$result = mysql_query($SQL);
			}else{
			$SQL = "INSERT INTO imgurl (URL) VALUES ('".$imgurl."')";
			$result = mysql_query($SQL);
			$uid = mysql_insert_id();
			$SQL = "INSERT INTO hwimg (HWID, IMGURLID) VALUES ('".$hwid."', '".$uid."')";
			$result = mysql_query($SQL);
			}
		}

		mysql_close($dbLink);

		echo '<div class="alert alert-success" role="alert"><a href="" class="alert-link"></a>Домашното е редактирано успешно.</div>';

	}
	else {

		echo '<div class="alert alert-danger" role="alert"><a href="" class="alert-link"></a>Няма достъп до базата данни.</div>';
		mysql_close($dbLink);
	}
	?>
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Информация за домашното</h3>
  </div>
  <div class="panel-body">
    <?php
		//echo '<p>IMGURLID: '.$imgurlid.'</p>';
		//echo '<p>HWID: '.$hwid.'</p>';
		echo '<p>Дата: '.$new_date.'</p>';
		if ($type == 0){
			$type = "Домашно";
		} else {
			$type = "Изпит";
		}
		echo '<p>Тип: '.$type.'</p>';
		echo '<p>Предмет: '.$title.'</p>';
		echo '<p>Описание: '.$data.'</p>';
		echo '<p>Важност: '.$rank.'</p>';
		if(isset($imgurl)){
			if (strlen($imgurl) > 0) {
				echo ' <img src="'.$imgurl.'" alt="HomeWork image" width="100px">';
			}
		}
	?>
  </div>
</div>
</div>


</div>
</body>
</html>
