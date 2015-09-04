<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
?>
<body>

<?php
	$comment_mode = "on";
	
	if (isset($_SESSION['psw']) && isset($_SESSION['name'])) {
		$password = $_SESSION['psw'];
		$username = $_SESSION['name'];
	}
	
	$SQL = "SELECT COUNT(user.Name) FROM user WHERE user.Password = '".$password."'";
	$result = mysql_query($SQL);
	$number_of_users = mysql_fetch_array($result);
	
	if ($number_of_users[0] <= 0) {
		$comment_mode = "off";
	}
	if (isset($_SESSION['psw']) && isset($_SESSION['name'])) {
		$password = $_SESSION['psw'];
		$username = $_SESSION['name'];
	}
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;
	$_SESSION['page'] = "other";

	include "CheckEditMode.php";
	
	$hwid = $_GET['hwid'];
	
	$_SESSION['hwid'] = $_GET['hwid'];
?>



<div class="container">
<?php include "main_menu.php"; ?>

<?php
	echo '<div id = "my_page">';
	
	$SQL = "SELECT homeworks.Date, homeworks.Title, homeworks.Data, homeworks.Rank, WEEKDAY(homeworks.Date) FROM homeworks WHERE homeworks.UID = ".$hwid;
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	$SQL = "SELECT imgurl.URL FROM imgurl, hwimg WHERE imgurl.UID = hwimg.IMGURLID AND hwimg.HWID = ".$hwid;
	$result = mysql_query($SQL);
	$row2 = mysql_fetch_array($result);
	
	echo '<div class="page-header">';
		switch($row[4]){
			case 0: $weekday = 'ЗА ПОНЕДЕЛНИК';
			break;
			case 1: $weekday = 'ЗА ВТОРНИК';
			break;
			case 2: $weekday = 'ЗА СРЯДА';
			break;
			case 3: $weekday = 'ЗА ЧЕТВЪРТЪК';
			break;
			case 4: $weekday = 'ЗА ПЕТЪК';
			break;
			case 5: $weekday = 'ЗА СЪБОТА';
			break;
			case 6: $weekday = 'ЗА НЕДЕЛЯ';
			break;
		}
		if ($row[0] == date("Y-m-d")) {
			$weekday2 = '(днес) ';
		} else {
			$weekday2 = '';
		}
		echo '<h1>'.$weekday.' <small id = "smalltag">'.$weekday2.$row[0].'</small></h1>';
		echo '</div>';
		echo '<div class="row">';
		
		echo '	<div class="col-sm-3" style = "margin:10px;background-color: white;border-radius:7px;">';
			switch($row[3]){
				case 1: $color = "white";
				break;
				case 2: $color = "#a8f293";
				break;
				case 3: $color = "#ffb495";
				break;
				case 4: $color = "#fa7194";
				break;
			} 
			echo '	<h3 style = "background-color: '.$color.';border-width:thin; border-style: solid;border-color: #d0d0d0;border-radius:5px; padding: 5px;">'.$row[1].'</h3>';
			if (strlen($row2[0]) > 0) {
				echo ' <p style = "border-width:thin; border-style: solid;background-color:#F3F3F3;border-color: #BEBEBE;border-radius:5px; padding: 9px;"><a href = "'.$row2[0].'" rel="lightbox"><img src="'.$row2[0].'" alt="HomeWork image" width="100%"></a></p>';
			}
			echo '	<p style = "border-width:thin; border-style: solid;background-color:#F3F3F3;border-color: #BEBEBE;border-radius:5px; padding: 9px;">'.$row[2].'</p>';
		echo '</div>';
		
		echo '	<div class="col-sm-8" style = "margin:10px;background-color: white;border-radius:7px;">';
			echo '	<h3 style = "background-color: white;border-width:thin; border-style: solid;border-color: #d0d0d0;border-radius:5px; padding: 5px;">Коментари</h3>';
			
			if ($comment_mode == "on") {
				include "comment_form.php";
			}
			
			
			$SQL = "SELECT usercommenthomework.COMMENTID, usercommenthomework.USERID FROM usercommenthomework WHERE usercommenthomework.HWID = ".$hwid." ORDER BY usercommenthomework.UID DESC";
			$result = mysql_query($SQL);
			
			while ($row = mysql_fetch_array($result)) {
			
				$SQL = "SELECT user.Name FROM user, usercommenthomework WHERE usercommenthomework.USERID = user.UID AND user.UID = ".$row[1];
				$result2 = mysql_query($SQL);
				$c_user = mysql_fetch_array($result2);
				
				$SQL = "SELECT comments.Data, comments.Date FROM comments, usercommenthomework WHERE comments.UID = usercommenthomework.COMMENTID AND usercommenthomework.COMMENTID = ".$row[0];
				$result3 = mysql_query($SQL);
				$c_data_date = mysql_fetch_array($result3);
				echo '<div style = "border-width:thin;border-style: solid;background-color:#F3F3F3;border-color: #BEBEBE;border-radius:5px;padding: 9px;margin-bottom:20px;">';
				echo '	<p style = " font-weight: bold;">'.$c_user[0].'<span style = "color:gray;font-size:10px;"> (Публикувано на '.$c_data_date[1].')</span></p>';
				echo '	<p style = "border-width:thin; border-style: solid;background-color:white;border-color: #BEBEBE;border-radius:5px; padding: 9px;">'.$c_data_date[0].'</p>';
				echo '</div>';
			}
		echo '</div>';
		
		echo '</div>';
	
	
?>



</div>
</div>
</body>
</html>