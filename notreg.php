﻿<html>
<?php 
include "head.php";
?>
<body>

<div class="container">
<?php include "main_menu.php"; ?>
	<div class="jumbotron">
		<?php 
			echo '<h1>Грешка!</h1>';
			
		?>
	</div>
	<?php
	echo '<div class="alert alert-danger" role="alert">Несъществуващ профил. Регистрирай се ';
	echo '<a href="index.php" class="alert-link">тук</a>';
	echo '!</div>';
	?>
</div>



</body>
</html>