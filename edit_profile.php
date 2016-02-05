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
<?php include "main_menu.php";?>

<div id = "my_page" style = "border-radius:20px;background: rgba(243, 243, 243, 0.4);">

	<div id = "urlForm">

	<?php

		if ($EditMode == 1){
			$UserInfo = ReturnALLUserInfoByIdOrByName(Get_Logged_users_name());
			echo '<h1 id = "urlTitleForm">Редакция на профила</h1>
			<form role="form" action="profile_edited.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
			<input type="text" class="form-control" id = "MyInputBox" value = "'.$UserInfo["FirstName"].'" name="FirstName" placeholder="Първо име">
			<input type="text" class="form-control" id = "MyInputBox" value = "'.$UserInfo["LastName"].'" name="LastName" placeholder="Фамилия">
			<!--<input  type="text" cols="50" rows="7" class="form-control" id = "MyInputBox" value = "'.$UserInfo["IMGURL"].'" name="IMGURL" placeholder="URL към снимка"></input >-->
			</div>
			<a href = "'.$UserInfo["IMGURL"].'" rel="lightbox" >

					<div class="frame-square" style = "display: inline-block;vertical-align: top; padding: 10px;width: 200px; height: 200px;margin-right: .5em;margin-bottom: .3em;">
						<div class="crop" style = " height: 100%;overflow: hidden;position: relative;">
							<img style = " display: block;width: 100%; height: 100%;margin: auto;position: absolute;top: -100%;right: -100%;bottom: -100%;left: -100%;border:solid #d2c9c6;"src="'.$UserInfo["IMGURL"].'">
						</div>
					</div>

			</a>
			<p><label class="control-label">Променете снимката</label></p>
			<div class="form-group" style = "width:90%;margin:auto;">
			<input id="input-1" type="file" class="file" name="fileToUpload">
			</div>
			<div class="form-group">
			<input type="text" class="form-control" id = "MyInputBox" value = "'.$UserInfo["Text"].'" name="Text" placeholder="Описание с две-три думи">
			</div>
			<div class="form-group">
			<button class="btn btn-default" id = "MyButtonToAddURL" type="submit" >Редактирай</button>
			</div>
			</form>';
		}

	?>
	</div>

</div>

</body>
