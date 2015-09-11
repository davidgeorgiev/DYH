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
			$SQL = "SELECT favsites.Name, favsites.ImgUrl, favsites.Url, favsites.Data FROM favsites WHERE favsites.UID = ".$_GET["bookmarkid"];
			$MyResult = mysql_query($SQL);
			$MyBookMarkInfo = mysql_fetch_array($MyResult);
			$imgurl = $MyBookMarkInfo[1];
			$title = $MyBookMarkInfo[0];
			$data = $MyBookMarkInfo[3];
			$url = $MyBookMarkInfo[2];
			echo '<h1 id = "urlTitleForm">Редакция</h1>
			<form role="form" action="bookmark_edited.php?bookmarkid='.$_GET["bookmarkid"].'" method="post">
			<div class="form-group">
			<input type="text" class="form-control" id = "MyInputBox" value = "'.$title.'" name="title" placeholder="Заглавие">
			<input type="text" class="form-control" id = "MyInputBox" value = "'.$url.'" name="url" placeholder="URL адрес">
			<input type="text" class="form-control" id = "MyInputBox" value = "'.$imgurl.'" name="imgurl" placeholder="URL към изображение">
			<input  type="text" cols="50" rows="7" class="form-control" id = "MyInputBox" value = "'.$data.'" name="data" placeholder="Описание"></input >
			<div class="form-group">
			<button class="btn btn-default" id = "MyButtonToAddURL" type="submit" >Редактирай</button>
			</form>';
		}
		
	?>
	</div>

</div>

</body>