<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	
	CheckFriendShipByNameAndKickOut($_GET["user"], Get_Logged_users_id());
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
		$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$username."'";
		$MyUserIDResult = mysql_query($SQL);
		$MyUserID = mysql_fetch_array($MyUserIDResult);
		
		$SQL = "SELECT favsites.Name, favsites.ImgUrl, favsites.Url, favsites.USERID, favsites.Data, favsites.UID FROM favsites WHERE favsites.USERID = ".$MyUserID[0];
		$MyResult = mysql_query($SQL);
		$UserInfo = ReturnALLUserInfoByIdOrByName($username);
		echo '<h1 id = "urlTitleForm">Важните сайтове на '.$UserInfo["FirstName"]." ".$UserInfo["LastName"].'</h1>';
		while($MyBookMarkInfo = mysql_fetch_array($MyResult)){
			if ($EditMode == 1){
				$Trash = '<a href="delete_bookmark.php?bookmarkid='.$MyBookMarkInfo[5].'&class='.$username.'&page=homeworks_time_chart" style = "text-decoration:none;color:white;font-size:15px;padding:4px;margin-left:-80%;"><span class="glyphicon glyphicon-trash"></span> </a>';
				$Pencil = '<a href="edit_bookmark.php?bookmarkid='.$MyBookMarkInfo[5].'&class='.$username.'" style = "text-decoration:none;color:white;font-size:15px;"><span class="glyphicon glyphicon-pencil"></span> </a>'; 
			} else {
				$Trash = "";
				$Pencil = "";
			}
			$imgurl = $MyBookMarkInfo[1];
			$title = $MyBookMarkInfo[0];
			$data = $MyBookMarkInfo[4];
			$url = $MyBookMarkInfo[2];
			echo '<div>';
				if (strpos($url,'http') !== false) {
					$Beginning = "";
				} else {
					$Beginning = "http://";
				}
				echo '<div class="row" id = "URLBOX" style = "margin-bottom:20px;">';
				echo '<div class="col-sm-3" style = "margin-top:20px;">';
					echo $Trash.$Pencil.'<div class="zoom_img_urls" class = "thumb1" style = "border:solid #d2c9c6;border-radius:50%;background: url('.$imgurl.') 50% 50% no-repeat;background-size: 150px;z-index:100;">';
					echo '</div>';
				echo '</div>';
					echo '<a href = "'.$Beginning.$url.'" target="blank"><div class="col-sm-8">';
					echo '<p id = "UrlTitle">'.$title.'</p>';
						
						echo '<p id = "descURL">'.$data.'</p>';
					echo '</div>';
					echo '</a>';
					
					echo '</div>';
				echo '</div>';
			//echo '</div>';
		}
		
		if ($EditMode == 1){
			echo '<h1 id = "urlTitleForm">Добави сайт</h1>
			<form role="form" action="url_added.php" method="post">
			<div class="form-group">
			<input type="text" class="form-control" id = "MyInputBox"  name="title" placeholder="Заглавие">
			<input type="text" class="form-control" id = "MyInputBox"  name="url" placeholder="URL адрес">
			<input type="text" class="form-control" id = "MyInputBox"  name="imgurl" placeholder="URL към изображение">
			<input  type="text" cols="50" rows="7" class="form-control" id = "MyInputBox" name="data" placeholder="Описание"></input >
			<div class="form-group">
			<button class="btn btn-default" id = "MyButtonToAddURL" type="submit" >Добави</button>
			</form>';
		}
		
	?>
	</div>
	</div>

</div>

</body>