<?php
	session_start();
	
?>
<html lang="en">
<?php
	include "config.php";
	include "head.php";
	/*if ($db_found) {
		$SQL = "INSERT INTO homeworks (Date, Title, Data, Rank) VALUES ('2015-06-30 00:00:00', 'Hello', 'How are you?','2')";
		$result = mysql_query($SQL);
		
		mysql_close($dbLink);

		print "Records added to the database";

		}
		else {

		print "Database NOT Found ";
		mysql_close($dbLink);
	}*/
	$password = $_SESSION['psw'];
	$username = $_SESSION['name'];
	include "CheckEditMode.php";
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;
	//echo $EditMode;
?>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

</style>
</head>
<body>
<div class="container">
<?php
$_SESSION['page'] = "other";
include "main_menu.php"; 

$SQL = "SELECT COUNT(usersubjectlist.UID) FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
$result = mysql_query($SQL);
$row = mysql_fetch_array($result);

$theresnosubjects = 0;
if ($row[0] <= 0) {
	$theresnosubjects = 1;
} else {
	$SQL = "SELECT usersubjectlist.SUBJECTLISTID FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
	//echo $SQL;
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	//echo "<p>".$row[0]."</p>";
	$subject_ids_arr = explode(",", $row[0]);
}
?>
	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
  <h2>Добави ново домашно</h2>
  <form role="form" <?php echo 'action='; echo "hw_added.php"?> method="post">
  
  
    <div class="form-group">
      <label for="date">Дата</label>
      <input type="text" id="datetimepicker4" class="form-control" class="some_class" name="date" size="20" placeholder="30/06/2015">
    </div>
	<div class="form-group">
      <label for="text">Тип</label>
		<select class="form-control" name="type">
			<option value="0">Домашно</option>
			<option value="1">Изпит</option>
		</select>
    </div>
	  <?php
		echo '<div class="form-group">';
		if ($theresnosubjects == 1) {
			echo '<label for="text">Нямате предмети създайте от опциите горе в менюто!</label>';
		} else {
			echo '<label for="text">Изберете от вашия списък с предмети!</label>';
			echo '<select class="form-control" name="title">';
			for ($i = 0;$i < sizeof($subject_ids_arr) - 1; $i++) {
				$SQL = "SELECT subjects.Name, subjects.Rank FROM subjects WHERE subjects.UID = ".$subject_ids_arr[$i];
				$result = mysql_query($SQL);
				$row = mysql_fetch_array($result);
				echo '<option value="'.$row[0].'">'.$row[0].'</option>';
			}
			echo '</select>';
		}
		echo '</div>';
	  ?>
	<div class="form-group">
      <label for="text">Описание</label>
      <textarea type="text" cols="50" rows="7" class="form-control" name="data" placeholder="Решете целия учебник"></textarea>
    </div>
	<div class="form-group">
      <label for="text">URL към изображение</label>
      <input type="text" class="form-control" name="imgurl" placeholder="http://somesite/img.png">
    </div>
	<div class="form-group">
      <label for="text">Важност (от 1 до 4)</label>
		<select class="form-control" name="rank">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
    </div>
	<?php 
		if (($EditMode == 1) && ($theresnosubjects == 0)) {
			echo '<button type="submit" class="btn btn-default">Запази</button>';
		} else {
			if ($EditMode == 0) {
				echo '<p>Не сте влезли в акаунта си!</p>';
			} else {
				echo '<p>Първо създайте предмети във вашия списък от опциите горе!</p>';
			}
		}
	?>
	</form>
</div>
</div>
</div>
</body>
<script src="Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.js"></script>
<script src="Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.js"></script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});

$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});
$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});

$('#datetimepicker1').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5
});
$('#datetimepicker2').datetimepicker({
	yearOffset:222,
	lang:'ch',
	timepicker:false,
	format:'d/m/Y',
	formatDate:'Y/m/d',
	minDate:'-1970/01/02', // yesterday is minimum date
	maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
$('#datetimepicker3').datetimepicker({
	inline:true
});
$('#datetimepicker4').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00'],
	step:5
});
$('#datetimepicker6').datetimepicker();
$('#destroy').click(function(){
	if( $('#datetimepicker6').data('xdsoft_datetimepicker') ){
		$('#datetimepicker6').datetimepicker('destroy');
		this.value = 'create';
	}else{
		$('#datetimepicker6').datetimepicker();
		this.value = 'destroy';
	}
});
var logic = function( currentDateTime ){
	if (currentDateTime && currentDateTime.getDay() == 6){
		this.setOptions({
			minTime:'11:00'
		});
	}else
		this.setOptions({
			minTime:'8:00'
		});
};
$('#datetimepicker7').datetimepicker({
	onChangeDateTime:logic,
	onShow:logic
});
$('#datetimepicker8').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date')
			.toggleClass('xdsoft_disabled');
	},
	minDate:'-1970/01/2',
	maxDate:'+1970/01/2',
	timepicker:false
});
$('#datetimepicker9').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date.xdsoft_weekend')
			.addClass('xdsoft_disabled');
	},
	weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
	timepicker:false
});
var dateToDisable = new Date();
	dateToDisable.setDate(dateToDisable.getDate() + 2);
$('#datetimepicker11').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [false, ""]
		}

		return [true, ""];
	}
});
$('#datetimepicker12').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [true, "custom-date-style"];
		}

		return [true, ""];
	}
});
$('#datetimepicker_dark').datetimepicker({theme:'dark'})


</script>
</html>
