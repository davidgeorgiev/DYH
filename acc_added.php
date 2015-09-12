<?php
	session_start();
?>
<html>
<?php 
include "head.php";
include "config.php";
include  "some_external_phps/PrintAccountInfo.php";

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function CheckPostArguments($name, $psw, $FirstName, $LastName, $Birthday, $IMGURL, $Text){
	$Error = "";
	$SQL = "SELECT Count(user.Name) FROM user WHERE user.Name = '".$name."'";
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	if ($row[0] > 0){
		$Error .= 'Вече съществува акаунт с такова име! ';
	}
	if (strlen($psw) < 6){
		$Error .= 'Паролата може да е минимум 6 символа! ';
	}
	if (strlen($name) <= 0){
		$Error .= 'Не сте въвели потребителско име! ';
	}
	if ((strlen($FirstName) <= 0) || (strlen($LastName) <= 0)){
		$Error .= 'Не сте въвели името си или фамилията си или и двете! ';
	}
	if(!exif_imagetype($IMGURL)){
		$Error .= 'Невалиден адрес на изображение! ';
	}
	$Split_date = explode("-", $Birthday);
	$ErrDate = 0;
	foreach($Split_date as $value){
		if ($value == "0"){
			$ErrDate = 1;
		}
	}
	unset($value);
	if ($ErrDate == 1){
		$Error .= 'Неправилно въведена дата на раждане! ';
	}
	if (strlen($Text) <= 0){
		$Error .= 'Липсва описание! ';
	}
	ob_start();
	var_dump(validateDate($Birthday));
	$result = ob_get_clean();
	if ($result == false){
		$Error .= 'Не съществува такава дата! ';
	}
	return $Error;
}


?>
<body>

<div class="container">
		<?php 
			$name = $_POST["name"];
			$psw = $_POST["psw"];
			$FirstName = $_POST["FirstName"];
			$LastName = $_POST["LastName"];
			$Birthday = $_POST["Year"]."-".$_POST["Month"]."-".$_POST["Day"];
			$IMGURL = $_POST["IMGURL"];
			$Text = $_POST["Text"];
			$Sex = $_POST["Sex"];
			
			$Error = CheckPostArguments($name, $psw, $FirstName, $LastName, $Birthday, $IMGURL, $Text);
			
			//$_SESSION['name'] = $username;
	$EmptyLine = 1;
	if ($db_found) {
			if (strlen($Error) <= 0){
				$SQL = "INSERT INTO user (Name, Password, FirstName, LastName, IMGURL, Birthday, Sex, Text) VALUES ('".$name."', '".$psw."', '".$FirstName."', '".$LastName."', '".$IMGURL."', '".$Birthday."', ".$Sex.", '".$Text."')";
				$result = mysql_query($SQL);
				$USERuid = mysql_insert_id();
				
				$SQL = "UPDATE user SET user.Password = '".$psw.$USERuid."' WHERE user.UID = ".$USERuid;
				$MyUpdate = mysql_query($SQL);
				
				$SQL = "INSERT INTO twoweeks (EvenWeekID, OddWeekID, OtherWeekID) VALUES (9, 9, 9)";
				$result = mysql_query($SQL);
				$uid = mysql_insert_id();
				
				$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$name."'";
				$result = mysql_query($SQL);
				$row2 = mysql_fetch_array($result);
				
				$SQL = "INSERT INTO uw (UserID, TwoWeeksID) VALUES ('".$row2[0]."', ".$uid.")";
				$result = mysql_query($SQL);
				
				mysql_close($dbLink);
				
				$_SESSION['psw'] = $psw.$USERuid;
				$_SESSION['name'] = $name;
			}
			echo '<div id = "urlTitleForm" style = "margin-bottom:-40px;color:red;">Внимание! Oт съображение за сигурност паролата ви е ';
			for ($counter = 1; $counter <= strlen($psw); $counter++) {
			echo '●';
			}
			echo $USERuid.'</div>';
			PrintResult($name, $IMGURL, $FirstName, $LastName, $Text, $Error);
	}
	?>
 
</div>
</div>
</body>
</html>