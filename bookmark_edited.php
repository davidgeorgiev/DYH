﻿<?php
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
<?php include "main_menu.php";?>

<div id = "my_page" style = "border-radius:20px;background: rgba(243, 243, 243, 0.4);">

	<div id = "urlForm">
	
	<?php
		$imgurl = $_POST["imgurl"];
		$title = $_POST["title"];
		$data = $_POST["data"];
		$url = $_POST["url"];
		echo '<div id = "urlForm">';
			if ($EditMode == 0) {
				echo '<h1 id = "urlTitleForm">Грешка :/</h1>';
			} else {
			
				$SQL = "UPDATE favsites SET favsites.Name = '".$title."', favsites.ImgUrl = '".$imgurl."', favsites.Url = '".$url."', favsites.Data = '".$data."' WHERE favsites.UID = ".$_GET["bookmarkid"];
				if (mysql_query($SQL)){
					echo '<h1 id = "urlTitleForm">Сайтът е променен успешно</h1>';
				} else {
					echo '<h1 id = "urlTitleForm">Грешка при опит за промяна</h1>';
				}
				
				echo '<div>';
					if (strpos($url,'http') !== false) {
						$Beginning = "";
					} else {
						$Beginning = "http://";
					}
					echo '<a href = "'.$Beginning.$url.'" target="blank"><div class="row" id = "URLBOX">';
					echo '<div class="col-sm-3" style = "margin-top:20px;">';
					echo '<div class="zoom_img_urls" style = "z-index:100;position:relative;">';
							echo '<img style= "width:140px;height:140px;margin-top:27px;margin-left:40px;border:solid #d2c9c6;border-radius:100px;" src="'.$imgurl.'" alt="Bookmark image" width="100%" height="100%">';
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

</div>

</body>