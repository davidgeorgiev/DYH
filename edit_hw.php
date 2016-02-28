<?php
	session_start();

?>
<html>
<?php
	include "config.php";
	include "head.php";
	include "some_external_phps/FixURLLinks.php";
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
	if ($_SESSION['page'] != 'check_width'){
		header('Location: check_width_and_send_to.php?page=edit_hw&user='.$username.'&hwid='.$_GET["hwid"]) and exit;
	}
	include "CheckEditMode.php";
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;

	$SQL = "SELECT imgurl.UID FROM imgurl, hwimg WHERE hwimg.IMGURLID = imgurl.UID AND hwimg.HWID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	$_SESSION['imgurlid'] = $row[0];
	$_SESSION['hwid'] = $_GET["hwid"];
	//echo $EditMode;
	include "some_external_phps/head_for_datepickers.php";
?>
<body>

<div class="container">
<?php
$_SESSION['page'] = "other";
include "main_menu.php";

$SQL = "SELECT COUNT(usersubjectlist.UID) FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
$result = mysql_query($SQL);
$row3 = mysql_fetch_array($result);

$theresnosubjects = 0;
if ($row3[0] <= 0) {
	$theresnosubjects = 1;
} else {
	$SQL = "SELECT usersubjectlist.SUBJECTLISTID FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
	//echo $SQL;
	$result = mysql_query($SQL);
	$row3 = mysql_fetch_array($result);
	//echo "<p>".$row[0]."</p>";
	$subject_ids_arr = explode(",", $row3[0]);
}
?>
<?php
	$SQL = "SELECT homeworks.Date, homeworks.Title, homeworks.Data, homeworks.Rank, homeworks.Type FROM homeworks WHERE homeworks.UID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	$SQL = "SELECT imgurl.URL FROM imgurl, hwimg WHERE hwimg.IMGURLID = imgurl.UID AND hwimg.HWID = ".$_GET["hwid"];
	$result = mysql_query($SQL);
	$row2 = mysql_fetch_array($result)
?>
	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
  <h2>Редактирай домашно</h2>
  <form role="form" <?php echo 'action='; echo "hw_edited.php"?> method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label class = "InfoTitleLabel" for="date">Дата</label>
      <?php //echo '<input type="date" class="form-control" name="date" value = "'.$row[0].'" placeholder="2015-06-30">'; ?>
	   <?php
		if ($_GET["height"] > $_GET["width"]){
			echo '<input type="date" class="form-control" id="pickdate" value = "'.$row[0].'" name="date" size="20" />';
		} else {
			echo '<input type="text" id="datetimepicker4" class="form-control" value = "'.$row[0].'" class="some_class" name="date" size="20" placeholder="30/06/2015">';
		}
	  ?>
    </div>
	<div class="form-group">
      <label class = "InfoTitleLabel" for="text">Тип</label>
		<select class="form-control" name="type">
			<?php
				if ($row[4] == 0) {
					echo '<option value="0">Домашно</option>';
					echo '<option value="1">Изпит</option>';
					echo '<option value="2">Друго</option>';
				} else if ($row[4] == 1){
					echo '<option value="1">Изпит</option>';
					echo '<option value="0">Домашно</option>';
					echo '<option value="2">Друго</option>';
				} else if ($row[4] == 2){
					echo '<option value="2">Друго</option>';
					echo '<option value="1">Изпит</option>';
					echo '<option value="0">Домашно</option>';
				}
			?>
		</select>
    </div>
    <?php
		echo '<div class="form-group">';
		if ($theresnosubjects == 1) {
			echo '<label class = "InfoTitleLabel" for="text">Нямате предмети създайте от опциите горе в менюто!</label>';
		} else {
			echo '<label class = "InfoTitleLabel" for="text">Изберете от вашия списък с предмети!</label>';
			echo '<select class="form-control" name="title">';
			echo '<option value="'.$row[1].'">'.$row[1].'</option>';
			for ($i = 0;$i < sizeof($subject_ids_arr) - 1; $i++) {
				$SQL = "SELECT subjects.Name, subjects.Rank FROM subjects WHERE subjects.UID = ".$subject_ids_arr[$i];
				$result = mysql_query($SQL);
				$row3 = mysql_fetch_array($result);
				echo '<option value="'.$row3[0].'">'.$row3[0].'</option>';
			}
			echo '</select>';
		}
		echo '</div>';
	  ?>
	<div class="form-group">
      <label class = "InfoTitleLabel" for="text">Описание</label>

	  <?php

		$DoneText = $row[2];
		$breaks = array("<br />","<br>","<br/>");
		$DoneText = str_ireplace($breaks, "\r\n", $DoneText);
	  ?>

      <?php echo '<textarea type="text" cols="50" rows="7" class="form-control" name="data" placeholder="Решете целия учебник">'.$DoneText.'</textarea>'; ?>
    </div>
	<?php	echo '<a href = "'.$row2[0].'" rel="lightbox" >

			<div class="frame-square" style = "display: inline-block;vertical-align: top; padding: 10px;width: 200px; height: 200px;margin-right: .5em;margin-bottom: .3em;">
				<div class="crop" style = " height: 100%;overflow: hidden;position: relative;">
					<img style = " display: block;width: 100%; height: 100%;margin: auto;position: absolute;top: -100%;right: -100%;bottom: -100%;left: -100%;border:solid #d2c9c6;"src="'.$row2[0].'">
				</div>
			</div>

		</a>'; ?>
	<div class="form-group">
		<label class = "InfoTitleLabel"  for="text">Заменете снимката</label>
		<input id="input-1" type="file" class="file" name="fileToUpload">
	</div>
	<div class="form-group">
      <label class = "InfoTitleLabel" for="text">Важност (от 1 до 4)</label>
		<select class="form-control" name="rank">
			<?php echo '<option value="'.$row[3].'">'.$row[3].'</option>';

			for ($i = 1; $i <= 4; $i++) {
				if ($i != $row[3]) {
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			}

			?>
		</select>
    </div>
	<?php
		$SQL = "SELECT COUNT(UID) FROM uh WHERE USERID = ".Get_Logged_users_id()." AND HWID = ".$_GET["hwid"];
		//echo $SQL;
		$ResultCountUIDs = mysql_query($SQL);
		$MyCountedUIDs = mysql_fetch_array($ResultCountUIDs);
		if (($EditMode == 1)&&($MyCountedUIDs[0]>0)) {
			echo '<button type="submit" class="btn btn-default">Submit</button>';
		}else{
			echo '<p>Нямате право да запазите това съдържание.</p>';
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
