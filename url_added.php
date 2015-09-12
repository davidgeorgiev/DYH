<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
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
<?php include "main_menu.php";
	$imgurl = $_POST["imgurl"];
	$title = $_POST["title"];
	$data = $_POST["data"];
	$url = $_POST["url"];
	
	
	$SQL = "INSERT INTO favsites (Name, ImgUrl, Data, Url, USERID) VALUES ('".$title."', '".$imgurl."', '".$data."', '".$url."', ".Get_Logged_users_id().")";
	if ($EditMode == 1) {
		$MyInsertion = mysql_query($SQL);
	} else {
		$ErrorMessage = "Грешка";
	}
?>
<div id = "my_page" style = "border-radius:20px;background: rgba(243, 243, 243, 0.4);">
<?php
	echo '<div id = "urlForm">';
			if ($EditMode == 0) {
				echo '<h1 id = "urlTitleForm">Грешка :/</h1>';
			} else {
				echo '<h1 id = "urlTitleForm">Сайтът е добавен успешно</h1>
				<div>';
					if (strpos($url,'http') !== false) {
						$Beginning = "";
					} else {
						$Beginning = "http://";
					}
					echo '<a href = "'.$Beginning.$url.'" target="blank"><div class="row" id = "URLBOX" style = "margin-bottom:20px;">';
					echo '<div class="col-sm-3" style = "margin-top:20px;">';
						echo '<div class="zoom_img_urls" class = "thumb1" style = "margin-top:27px;margin-left:40px;border:solid #d2c9c6;border-radius:50%;width:150px;height:150px;background: url('.$imgurl.') 50% 50% no-repeat;background-size: 150px;z-index:100;">';
						echo '</div>';
					echo '</div>';
						echo '<div class="col-sm-8">';
						echo '<p id = "UrlTitle">'.$title.'</p>';
							
							echo '<p id = "descURL">'.$data.'</p>';
						echo '</div>';
						echo '</div>';
						echo '</a>';
					echo '</div>';
				echo '</div>';
			}
	echo '</div>';
?>
</div>

</body>