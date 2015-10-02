<?php
function PrintResult($name, $IMGURL, $FirstName, $LastName, $Text, $Sex, $Error = "", $OnMainPage = 0){
	
	if (strlen($Error) <= 0){
		$h3 = "Вашият акаунт беше създаден успешно!";
		$href = 'index.php';
		$Target = '';
	} else {
		$h3 = "Операцията е неуспешна поради следните причини!";
		$href = 'index.php';
		$FirstName = "Фатална";
		$LastName = "Грешка";
		$Text = $Error;
		$IMGURL = "css/fatal_error.png";
		$name = "Опитайте пак!";
		$Target = '';
	}
	if ($OnMainPage == 0){
		echo '<div class="panel panel-default" style = "margin-top:3%;">';
		echo '<h3 class="panel-title" id = "urlTitleForm">'.$h3.'</h3>';
		
	} else {
		$href = 'home.php?user='.$name;
	}
	if ($Sex == 1){
		$bgc = '#e5e9ec';
	} else {
		$bgc = '#ece5e7';
	}
	echo '<div class="panel-body" style = "background-color:'.$bgc.';border:solid #726b69;border-width:thin;border-radius:3px;">';

	echo '<a href = "'.$href.'" '.$Target.'><div class="row" id = "URLBOX" style = "margin-bottom:20px;margin-top:20px;">';
	echo '<div class="col-sm-3" style = "margin-top:20px;">';
		echo '<div class="zoom_img_urls" class = "thumb1" style = "border:solid #726b69;border-radius:50%;background: url('.$IMGURL.') 50% 50% no-repeat;background-size: 100% 100%;z-index:100;">';
		echo '</div>';
	echo '</div>';
		echo '<div class="col-sm-8">';
		echo '<p id = "UrlTitle" style = "color:#726b69;">'.$FirstName." ".$LastName.'<small style = "font-size:30px;text-align:center;"> ('.$name.')</small></p>';
			
		echo '<p id = "descURL" style = "margin-left:20%;text-align:center;margin-top:0px;color:#726b69;">'.$Text.'</p>';
	echo '</div>';
	echo '</div>';
	echo '</a>';
	echo '</div>';
	if ($OnMainPage == 0){
		echo '</div>';
	}
}
function PrintAccountInfoByUSERNAME($username, $OnMainPage){
	$SQL = "SELECT user.Name, user.FirstName, user.LastName, user.Password, user.IMGURL, user.Birthday, user.Text, user.Sex FROM user WHERE user.Name = '".$username."'";
	$MyUserInfoResult = mysql_query($SQL);
	$MyUserInfo = mysql_fetch_array($MyUserInfoResult);
	
	PrintResult($MyUserInfo[0], $MyUserInfo[4], $MyUserInfo[1], $MyUserInfo[2], $MyUserInfo[6], $MyUserInfo[7], "", $OnMainPage);
}
function GetAccountInfoByUSERNAMEorID($username = "",$userid = 0){
	if (strlen($username) > 0){
		$SQL = "SELECT user.Name, user.FirstName, user.LastName, user.Password, user.IMGURL, user.Birthday, user.Text, user.Sex FROM user WHERE user.Name = '".$username."'";
	} else if ($userid > 0){
		$SQL = "SELECT user.Name, user.FirstName, user.LastName, user.Password, user.IMGURL, user.Birthday, user.Text, user.Sex FROM user WHERE user.UID = '".$userid."'";
	}
	
	$MyUserInfoResult = mysql_query($SQL);
	$MyUserInfo = mysql_fetch_array($MyUserInfoResult);
	
	return array($MyUserInfo[0], $MyUserInfo[4], $MyUserInfo[1], $MyUserInfo[2], $MyUserInfo[6], $MyUserInfo[7]);
}
?>
