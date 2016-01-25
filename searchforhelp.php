<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/head_for_datepickers.php";
?>
<?php
	include "start_check.php";
	$_SESSION['page'] = "other";
?>
<body>
<div class="container">
<?php include "main_menu.php";?>

	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">


	<form role="form" action = submithelp.php method="post">
		<div class="form-group">
			<label class = "InfoTitleLabel" for="text">Потърсете помощ от другите</label>
			<input type="text" class="form-control" id="StandartInputBox" name="helptitle" placeholder="Заглавие">
			<textarea type="text" cols="50" rows="7" class="form-control" name="helpstr" placeholder="Опишете своя проблем по домашно или задача, която не можете да решите"></textarea>
		</div>
		<button type="submit" class="btn btn-default">Търси помощ</button>
	</form>
<?php
?>

	</div>

</div>
</body>
