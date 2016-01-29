<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";
	include "some_external_phps/head_for_datepickers.php";
	include "some_external_phps/PrintHelpPosts.php";
?>
<?php
	include "start_check.php";
	$_SESSION['page'] = "other";
?>
<body>
<div class="container">
<?php include "main_menu.php";?>

	<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">

	<h1 class = "InfoTitleLabel" style = "font-size:35px;">
	<?php
		$only_me = $_GET["only_me"];
		if($only_me){
			echo 'Вашите проблеми чакащи помощ';
		}else{
			echo 'Помогни на някого!';
		}

	?>
	</h1>

<?php
	PrintHelpPosts($only_me);
?>

	</div>

</div>
</body>
