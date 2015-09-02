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
newdiv.innerHTML = '<br> <br/><div class="form-group"><label for="text">Предмет '+(fields+1)+'</label><input type="text" class="form-control" name="myInputs[]" placeholder="Въведете името на предмета тук"></div>';
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
	$_SESSION['page'] = "other";

?>

<div class="container">
<?php
include "main_menu.php";
echo '<div id = "my_page">';
?>
<form id="subject_input" role="form" <?php echo 'action='; echo "subjects_added.php"?> method="post">
     <div id="dynamicInput">
          <br> <br/><div class="form-group"><label for="text">Предмет 1</label><input type="text" class="form-control" name="myInputs[]" placeholder="Въведете името на предмета тук"></div>
     </div>
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


<?php
echo '</div>';
?>



</div>
</body>
</html>