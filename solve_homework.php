﻿<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/return_hw_info_by_id.php";
?>
<?php
	include "start_check.php";
	// if ($_SESSION['page'] != 'check_width'){
		// header('Location: check_width_and_send_to.php?user='.$username.'&page='.$current_page_is) and exit;
	// }
	$_SESSION['page'] = "other";
	
	function IHaveThisSubjectInSubjectList($userid,$hwid){
		$MyCurrentHomeworkIfno = returnHomeworkInfoByID($_GET["hwid"]);
		
		$SQL = "SELECT usersubjectlist.SUBJECTLISTID FROM usersubjectlist WHERE usersubjectlist.USERID = ".$userid;
		$MySubjectListResult = mysql_query($SQL);
		$MySubjectListIDS = mysql_fetch_array($MySubjectListResult);
		
		$IhaveIt = 0;
		$MySubjectIDsArray = explode(",",$MySubjectListIDS[0]);
		for($counter = 0; $counter < (sizeof($MySubjectIDsArray)-1); $counter++){
			$SQL = "SELECT subjects.Name, subjects.UID FROM subjects WHERE subjects.UID = ".$MySubjectIDsArray[$counter];
			//echo '<p>'.$SQL.'</p>';
			$MySubjectNameResult = mysql_query($SQL);
			$MySubjectName = mysql_fetch_array($MySubjectNameResult);
			if ($MySubjectName[0] == $MyCurrentHomeworkIfno["MainInfo"]["Title"]){
				$IhaveIt = 1;
				$SubjectID = $MySubjectName[1];
			}
			//echo $MySubjectName[0]." = ".$MyCurrentHomeworkIfno["MainInfo"]["Title"];
		}
		if ($IhaveIt == 0){
			$SubjectID = 0;
		}
		//echo '<p style = "margin-top:10%;">'.$SubjectID.'</p>';
		return $SubjectID;
	}
	
	
	if (!IHaveThisSubjectInSubjectList(Get_Logged_users_id(),$_GET["hwid"])){
		$MyCurrentHomeworkIfno = returnHomeworkInfoByID($_GET["hwid"]);
		
		$_SESSION['Subject'] = $MyCurrentHomeworkIfno["MainInfo"]["Title"];
		header('Location: add_to_my_list_subject_with_name.php?hwid='.$_GET["hwid"]) and exit;
	} else {
		$SubjectID = IHaveThisSubjectInSubjectList(Get_Logged_users_id(),$_GET["hwid"]);
	}
?>
<body>
<div class="container">
<?php include "main_menu.php"; $_SESSION["hwid"] = $_GET["hwid"]


?>

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">


<form role="form" <?php echo 'action='; echo "solve_homework_final.php?user=".$_GET["user"]."&hwid=".$_GET["hwid"]?> method="post">
<select class="form-control" name="SubjectID" style = "margin-top:0;">
<option value = "<?php echo $SubjectID?>" ><?php echo $SubjectID?></option>
</select>
<div class="form-group">
  <label for="date">Преди да завършите това действие моля попълнете тази форма, за да могат другите да видят мнението ви за това домашно! :)</label>
</div>
<div class="form-group">
  <label for="text">За колко време решихте домашното</label>
	<select class="form-control" name="time_for_solving">
		<option value="0.083">Пет минути</option>
		<option value="0.16">Десет минути</option>
		<option value="0.33">Двайсет минути</option>
		<option value="0.5">Половин час</option>
		<option value="0.66">Четиресет минути</option>
		<option value="0.83">Петдесет минути</option>
		<option value="1">Цял час</option>
		<option value="1.25">Час и четвърт</option>
		<option value="1.5">Час и половина</option>
		<option value="1.75">Час и три четвърти</option>
		<option value="2">Около два часа</option>
		<option value="3">Около три часа</option>
		<option value="4">Около четири часа</option>
		<option value="5">Около пет часа</option>
		<option value="8">Мъчих се цял ден</option>
		<option value="9">Мъчих се цяла нощ</option>
		<option value="16">Два дни</option>
		<option value="24">Три дни</option>
		<option value="32">Четири дни</option>
		<option value="40">Пет дни</option>
		<option value="48">Шест дни</option>
		<option value="56">Седмица</option>
		<option value="112">Две седмици</option>
		<option value="168">Три седмици</option>
		<option value="224">Месец</option>
		<option value="448">Два месеца</option>
		<option value="600">Много повече от два месеца</option>
	</select>
</div>
<!--<div class="form-group">
  <label for="text">Каква оценка получихте</label>
	<select class="form-control" name="assessment">
		<option value="1">Никаква</option>
		<option value="2">Слаб 2</option>
		<option value="3">Среден 3</option>
		<option value="4">Добър 4</option>
		<option value="5">Много добър 5</option>
		<option value="6">Отличен 6</option>
	</select>
</div>-->
<div class="form-group">
  <label for="text">Мнение за домашното</label>
	<select class="form-control" name="pleasure">
		<option value="10">Даже не си направих труда да го пиша</option>
		<option value="20">Много гадно домашно, даже не го реших цялото</option>
		<option value="30">Написах нещо колкото да отбия номера</option>
		<option value="40">Малко, но от сърце</option>
		<option value="50">Старах се, но не е кой знае какво</option>
		<option value="60">Наистина много се старах да го напиша</option>
		<option value="70">Дадох най-доброто от себе си</option>
		<option value="80">Написах го с лекота и ми хареса много</option>
		<option value="90">Толкова ми хареса, че искам такива домашни всеки ден</option>
		<option value="100">Не мога да опиша колко много ми хареса</option>
		
	</select>
</div>
<div class="form-group">
  <label for="text">Колко страници написахте (голям формат)</label>
	<select class="form-control" name="length">
		<option value="0">По-малко от една</option>
		<option value="1">Една</option>
		<option value="1.5">Една и половина</option>
		<option value="2">Две</option>
		<option value="2.5">Две и половина</option>
		<option value="3">Три</option>
		<option value="4">От три до пет</option>
		<option value="7">Седем</option>
		<option value="10">Около десет</option>
		<option value="20">Около двайсет</option>
		<option value="30">Около трийсет</option>
		<option value="45">Над трийсет</option>
		<option value="70">Не мога да опиша колко много страници изписах, направо се скапах от умора</option>
	</select>
</div>
<div class="form-group">
  <label for="text">Научихте ли нещо от това</label>
	<select class="form-control" name="learned">
		<option value="10">Нищо не научих, само си загубих времето</option>
		<option value="20">Да, но в главата ми е пълна каша</option>
		<option value="35">Научих разни неща, но не много</option>
		<option value="50">Научих толкова колкото ми трябваше да знам</option>
		<option value="95">Научих всичко</option>
		<option value="100">Научих всичко, даже учих и от други места</option>
		<option value="110">Толкова много научих, че не е истина</option>
	</select>
</div>
<div class="form-group">
<div class="form-group">
  <label for="text">Преписвахте ли</label>
	<select class="form-control" name="cheat">
		<option value="1">Да, толкова много, че направо цялото е преписано</option>
		<option value="2">От части да</option>
		<option value="3">Малко</option>
		<option value="4">Преписвах, но с учебна цел и наистина научих доста неща от това</option>
		<option value="5">Не съм, това не е в мой стил</option>
	</select>
</div>
<div class="form-group">
      <label for="text">Допълнителни впечатления</label>
      <textarea type="text" cols="50" rows="7" class="form-control" name="SomePersonalText" placeholder="Напишете нещо тук"></textarea>
    </div>
<?php
$loged = 0;
$SQL = "SELECT COUNT(user.UID) FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
//echo $SQL;
$result = mysql_query($SQL);
$num_of_found_users_with_this_psw = mysql_fetch_array($result);
if ($num_of_found_users_with_this_psw[0] > 0){
	$loged = 1;
}
if ($loged == 1) {
	echo '<button type="submit" class="btn btn-default">Запиши</button>';
} else {
	echo "Не сте влезли!";
}
?>
</form>

</div>
</div>
</body>
</html>