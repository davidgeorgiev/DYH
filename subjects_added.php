<?php
	session_start();
	echo '<html>';
	include "head.php";
	include "config.php";
	
?>
<body>

<?php

	include "start_check.php";
	$_SESSION['page'] = "other";

?>

<div class="container">
<?php
include "main_menu.php";
echo '<div id = "my_page">';


for ($i = 0 ;$i < sizeof($_POST['myInputs']); $i++){
	echo '<p>Предмет '.($i+1).' - '.$_POST['myInputs'][$i].'</p>';
	if (strlen($_POST['myInputs'][$i]) > 0){
		$SQL = "INSERT INTO subjects (Name) VALUES ('".$_POST['myInputs'][$i]."')";
		$result = mysql_query($SQL);
		$id = mysql_insert_id();
		echo $id.', ';
	}
}
?>


</div>
</body>
</html>