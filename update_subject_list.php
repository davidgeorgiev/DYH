<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	
	
?>
<body>

<script language="javascript">
fields = 1;
function addInput(divName) {
if (fields <= 35) {
//document.getElementById('subject_input').innerHTML += '<br> <br/><div class="form-group"><label for="text">Предмет '+fields+'</label><input type="text" class="form-control" name="subject'+fields+'" placeholder="Въведете името на предмета тук"></div>';


var newdiv = document.createElement('div');
newdiv.innerHTML = '<br> <br/><div class="form-group" style = "color:white;"><label for="text">Предмет '+(fields+1)+'</label><input type="text" class="form-control" name="myInputs[]" placeholder="Въведете името на предмета тук"><label for="text">Любимост</label><select class="form-control" name="myRanks[]"><?php for ($i = 1; $i <=10; $i++) {echo '<option value="'.$i.'">';$rank_of_subject = $i;include "subject_scale_to_words.php";echo $rank_of_subject_with_words."</option>";}?></select></div>';
document.getElementById(divName).appendChild(newdiv);
fields++;

} else {
document.getElementById('dynamicInput').innerHTML += "<br />Достигнали сте максималният брой предмети!";
document.form.add.disabled=true;
}
}
</script>

<?php

	include "start_check.php";
	$my_temp = $_SESSION['page'];
	if ($my_temp != 'check_width') {
		header('Location: check_width_and_send_to.php?user='.$username.'&page=update_subject_list') and exit;
	}
	$_SESSION['page'] = "other";

?>

<style>
#progressbar {
	background-color: #837d7c;
	border-radius: 3px; /* (height of inner div) / 2 + padding */
	padding: 3px;
}

#progressbar > div {
	background-color: #d2c9c6;
	width: 40%; /* Adjust with JavaScript */
	height: 20px;
	border-radius: 3px;
	text-align:center;font-size:16px;
	font-weight: normal;
}
</style>

<div class="container">
<?php
include "main_menu.php";
echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';
?>


<?php
$SQL = "SELECT COUNT(usersubjectlist.UID) FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
$result = mysql_query($SQL);
$row = mysql_fetch_array($result);

if ($row[0] <= 0) {
	echo "<p>Още нямате списък с предмети! Въведете ги долу!</p>";
} else {
	$SQL = "SELECT usersubjectlist.SUBJECTLISTID FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
	//echo $SQL;
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	//echo "<p>".$row[0]."</p>";
	$subject_ids_arr = explode(",", $row[0]);
	
	
	echo '<div class="list-group">';
	echo '<a href="#" class="list-group-item unactive" style = "background-color:#837d7c;">';
	echo '<h4 class="list-group-item-heading" style = "color:white">Вашите предмети</h4>';
	echo '<p class="list-group-item-text"></p>';
	echo '</a>';
	echo '<div style = "margin:10px;padding:0px;border-radius:7px;">';
	$subjects_window_height = $_GET["height"]*0.70;
	echo '<div style = "border-radius:7px;overflow-y: scroll; height:'.$subjects_window_height.';">';
	echo '<table style = "float:left;font-size:13px;">';
	
	if ($_GET["width"] > 1250){
		$number_of_tds = 4;
	} else if (($_GET["width"] <= 1250) && ($_GET["width"] > 1070)) {
		$number_of_tds = 3;
	} else if ((($_GET["width"] <= 1070) && ($_GET["width"] > 870)) || (($_GET["height"] > $_GET["width"]) && ($_GET["width"] > 657))) {
		$number_of_tds = 2;
	} else {
		$number_of_tds = 1;
	}
	for ($i = 0;$i < sizeof($subject_ids_arr) - 1; $i++) {
		$SQL = "SELECT subjects.Name, subjects.Rank FROM subjects WHERE subjects.UID = ".$subject_ids_arr[$i];
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		
		//echo $row[0].$row[1];
		
		$rank_of_subject = $row[1];
		include "subject_scale_to_words.php";
		
		if (!(($i+$number_of_tds) % $number_of_tds)){
			if ($i > 0){
				echo '</tbody>';
			}
			echo '<tbody>';
		}
		echo '<td style = "background-color:#f2f2f2;border:solid #837d7c;padding:12px;">';
		echo '<a href="#"  style = "height: 200px;text-decoration:none;color:#655f5e;" >';
		echo '<h4 class="list-group-item-heading" style = "font-size:16px;font-weight: bold;">'.($i+1).'. '.$row[0].'</h4>';
		echo '<p class="list-group-item-text" style = "padding-left:20px;padding-top:10px;font-size: 15px;">'.$rank_of_subject_with_words.'</p>';
		echo '<div id="progressbar" style = "margin:15px;">';
		$percentage = $row[1]*10;
		echo '<div style = "width: '.$percentage.'%;">';
		echo $percentage.'%';
		echo '</div>';
		echo '</div>';
		echo '</a>';
		echo '</td>';
		//echo "<p>".$SQL."</p>";
	}
	echo '</tbody>';
	echo '</table></div></div></div>';
	
}
?>

<?php
	// echo '<table class="table table-bordered" style = "float:left;font-size:13px;margin-top:15px;">';
	// for ($i = 0;$i <= 100;$i++){
		// if (!(($i+4) % 4)){
			// if ($i > 0){
				// echo '</tbody>';
			// }
			// echo '<tbody>';
		// }
			// echo '<td>'.$i.'</td>';
		
	// }
	// echo '</tbody>';
	// echo '</table>';
// ?>

<div style = " margin: auto;width: 98%;border-radius:10px;border:3px solid #d2c9c6;background-color:#837d7c;padding: 10px;">
<form id="subject_input" role="form" <?php echo 'action='; echo "subjects_added.php?user=".$username?> method="post">
     <div id="dynamicInput">
          <br> <br/><div class="form-group" style = "color:white;"><label for="text">Предмет 1</label><input type="text" class="form-control" name="myInputs[]" placeholder="Въведете името на предмета тук"><label for="text">Любимост</label><select class="form-control" name="myRanks[]"><?php for ($i = 1; $i <=10; $i++) {echo '<option value="'.$i.'">';$rank_of_subject = $i;include "subject_scale_to_words.php";echo $rank_of_subject_with_words."</option>";}?></select></div>
     </div>
	 <p>Внимание веднъж въведен предмет не може да се изтрива или редактира!</p>
     <input type="button" class="btn btn-default" value="Още един" onClick="addInput('dynamicInput');">
	 
	 
	 <?php 
	 if ($EditMode == 1) {
		echo '<button type="submit" class="btn btn-default">Запази</button>';
	 } else {
		echo '<br> </br><div class="alert alert-danger" role="alert">Нямате право да запазите тази форма. Регистрирайте се ';
		echo '<a href="index.php" class="alert-link">тук</a>';
		echo '!</div>';
	 }
	 ?>
	 
	 
</form>
</div>

<?php
echo '</div>';
?>



</div>
</body>
</html>