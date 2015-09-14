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
<?php include "main_menu.php";
	
	$SubjectNameToAdd = $_SESSION['Subject'];
	
?>

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">
<div style = " margin: auto;width: 98%;border-radius:10px;border:3px solid #d2c9c6;background-color:#837d7c;padding: 10px;">
<h1 style = "color:white;">Можете да отбележите домашното като решено след като добавите предмета в списъка си.</h1>
<form id="subject_input" role="form" <?php echo 'action='; echo "subjects_added.php?user=".$username."&hwid=".$_GET["hwid"]?> method="post">
     <div id="dynamicInput">
          <br> <br/><div class="form-group" style = "color:white;">
		  
			<select class="form-control" name="myInputs[]" style = "margin-top:0;">
				<?php echo '<option value = "'.$SubjectNameToAdd.'">'.$SubjectNameToAdd.'</option>'; ?>
			</select>
			<select class="form-control" name="myRanks[]"><?php for ($i = 1; $i <=10; $i++) {echo '<option value="'.$i.'">';$rank_of_subject = $i;include "subject_scale_to_words.php";echo $rank_of_subject_with_words."</option>";}?></select></div>
     </div>
	 
	 
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

</div>

</body>