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
<?php include "main_menu.php"; $_SESSION["hwid"] = $_GET["hwid"]?>

<style>
#MyBox{
	width:50%;
	margin:auto;
}
@media only screen and (max-width: 767px) {
	#MyBox{
		width:100%;
		margin:0px;
	}
}

</style>

<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">

<div id = "MyBox" style = "background-color:white;border-radius:10px;">
<div style = "color:#d2c9c6;background-color:#837d7c;border-radius:10px;text-align:center;font-size:25px;padding:10px;">
	Сигурни ли сте, че искате да изтриете това домашно?
</div>
<div style = "padding-top:20px;padding-bottom:20px;padding-left:40px;padding-right:40px;">
<a href = "delete_hw.php?hwid=<?php echo $_GET["hwid"]?>&class=<?php echo $_GET["class"]?>&page=<?php echo $_GET["page"]?>"><button class = "btn btn-default" style = "width:100%;">
Продължи
</button></a>
</div>
</div>

</div>
</body>