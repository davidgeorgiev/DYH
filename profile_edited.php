﻿<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/PrintAccountInfo.php";
	include  "some_external_phps/crop_img.php";
?>
<?php
	include "start_check.php";
	// if ($_SESSION['page'] != 'check_width'){
		// header('Location: check_width_and_send_to.php?user='.$username.'&page='.$current_page_is) and exit;
	// }
	$_SESSION['page'] = "other";
?>
<body>

<div class="container">
<?php include "main_menu.php";?>

<div id = "my_page" style = "border-radius:20px;background: rgba(243, 243, 243, 0.4);">

	<div id = "urlForm">

	<?php
		$FirstName = $_POST["FirstName"];
		$LastName = $_POST["LastName"];
		include "some_external_phps/upload.php";
		if ($ImageUploaded == 1){
			$IMGURL = CropMyImage($target_file,600);
			unlink($target_file);
		}else{
			$SQL = "SELECT IMGURL FROM user WHERE user.UID = ".Get_Logged_users_id();
			$MyIMGURLResult = mysql_query($SQL);
			$MyIMGURLARR = mysql_fetch_array($MyIMGURLResult);
			$IMGURL = $MyIMGURLARR[0];
		}

		$Text = $_POST["Text"];
		echo '<div id = "urlForm">';
			if ($EditMode == 0) {
				echo '<h1 id = "urlTitleForm">Грешка :/</h1>';
			} else {
				$UserInfo = ReturnALLUserInfoByIdOrByName(Get_Logged_users_name());
				if ((strpos($UserInfo["IMGURL"], 'dyh_uploads') !== false)&&($ImageUploaded==1)) {
    			unlink($UserInfo["IMGURL"]);
					$ImageUploaded = 0;
				}
				$SQL = "UPDATE user SET user.FirstName = '".$FirstName."', user.LastName = '".$LastName."', user.IMGURL = '".$IMGURL."', user.Text = '".$Text."' WHERE user.UID = ".Get_Logged_users_id();
				if (mysql_query($SQL)){
					echo '<h1 id = "urlTitleForm">Профилът е променен успешно</h1>';
				} else {
					echo '<h1 id = "urlTitleForm">Грешка при опит за промяна</h1>';
				}

				echo '<div>';
					PrintAccountInfoByUSERNAME(Get_Logged_users_name(), 1);
					echo '</div>';
				echo '</div>';
			}
		echo '</div>';

	?>
	</div>

</div>

</body>
