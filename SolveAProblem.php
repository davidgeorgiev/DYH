<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/FixURLLinks.php";
?>
<?php
	include "start_check.php";
	$_SESSION['page'] = "other";
?>
<body>
<div class="container">
<?php include "main_menu.php";?>

	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
	<?php
		$problemIdToSolve = $_GET["problemid"];
		$SQL = "SELECT Title,USERID,HELPSTR,DATE FROM neededhelp WHERE UID = ".$problemIdToSolve;
		$HelpResult = mysql_query($SQL);
		$MyFetchedResult = mysql_fetch_array($HelpResult);
	?>
	<h1 id = 'StandartTitle' style = "margin-top:4px;"><?php echo $MyFetchedResult["Title"];?></h1>
	<div id = "StandartBox">
		<div class="row" id = "URLBOX" style = "margin-bottom:20px;margin-top:20px;">
			<?php
				echo "<p id = 'StandartInsideText'>".FixURLsData($MyFetchedResult["HELPSTR"])."</p><p id = 'StandartInsideText' class = 'StandartInsideTextDate'>Публикувано на: ".$MyFetchedResult["DATE"]." от ".GetFullUserNamebyID($MyFetchedResult["USERID"],1)." ".GetFullUserNamebyID($MyFetchedResult["USERID"],2)."</p>";
			?>
		</div>
	</div>
	<?php echo '<form role="form" action = problemSolved.php?problemid='.$problemIdToSolve.' method="post">';?>
		<div class="form-group">
			<label class = "InfoTitleLabel" for="text">Дайте някакво решение на проблема на <?php echo GetFullUserNamebyID($MyFetchedResult["USERID"],1)." ".GetFullUserNamebyID($MyFetchedResult["USERID"],2);?></label>
			<textarea type="text" cols="50" rows="7" class="form-control" name="strforhelp" placeholder="Дайте съвет на човека тук..."></textarea>
		</div>
		<?php
			if(ifLogged()){
				echo '<button type="submit" class="btn btn-default">Запази</button>';
			}else{
				echo '<p>Не сте влезли в профила си! :(</p>';
			}
		?>
	</form>
<?php
?>

	</div>

</div>
</body>
