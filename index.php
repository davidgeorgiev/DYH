<html>
<?php
	include "head.php";
	include "config.php";
?>
<head>
<style>
.shakeimage {POSITION: relative}
</style>
<script>
/*
In header
*/
var rector=3
var stopit=0
var a=1
function init(which){
stopit=0
shake=which
shake.style.left=0
shake.style.top=0
}
function rattleimage(){
if ((!document.all&&!document.getElementById)||stopit==1)
return
if (a==1){
shake.style.top=parseInt(shake.style.top)+rector
}
else if (a==2){
shake.style.left=parseInt(shake.style.left)+rector
}
else if (a==3){
shake.style.top=parseInt(shake.style.top)-rector
}
else{
shake.style.left=parseInt(shake.style.left)-rector
}
if (a<4)
a++
else
a=1
setTimeout("rattleimage()",50)
}
function stoprattle(which){
stopit=1
which.style.left=0
which.style.top=0
}
</script>
</head>
<body>
<div class="container">


<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $passErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = $psw = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["psw"])) {
     $passErr = "Password is required";
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
     
   if (empty($_POST["website"])) {
     $website = "";
   } else {
     $website = test_input($_POST["website"]);
     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
       $websiteErr = "Invalid URL"; 
     }
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }

   if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>
<style>
#MyButtonToAddURL{
	font-size:15px;font-family:Arial;border:solid #d2c9c6;border-width:thin;border-radius:7px;width:auto;
}
#MyButtonToAddURL:hover{
	font-family:Arial;
}
#MyInputBox{
	font-size:20px;
	height:35px;
	margin:auto;
}
#MyInputBox:hover;{
	background:#d2c9c6;
}
#RegInput{
	margin-top:20px;
	margin-left:-15px;
}
#BoxHeadingButton{
	background:#b2a5a1;
	color:#837d7c;
	font-weight:bold;
	border-radius:0px;
	font-family: Hattori;
	font-weight:bold;
	width:100%;
	
	font-size:20px;
	height:50px;
	margin:auto;
}
</style>
<div class="" id="loginModal">
	  <div class="modal-header">
		<!--<h3 style = "color:rgba(243, 243, 243, 0.8);">DYH</h3>-->
	  </div>
	  <div class="modal-body"  style = "background-color:#d2c9c6;">
		<div class="well" style = "background-color:#837d7c;">
		  <ul class="nav nav-tabs">
			<li class="active"><a href="#login" id = "BoxHeadingButton" data-toggle="tab">Вход</a></li>
			<li><a href="#create" data-toggle="tab" id = "BoxHeadingButton">Създай профил</a></li>
		  </ul>
		  <div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="login">
			<form method="post" class="form-horizontal" <?php echo 'action='; echo "check_user.php";?>> 
				<fieldset>
				     
				  <div class="control-group" style = "margin-top:20px;">
					<!-- Username -->
					<div class="form-group" >
					<input type="text" name="name" id = "MyInputBox" class="form-control" placeholder = "Потребителско име" value="<?php echo $name;?>">
					<span class="error"> <?php echo $nameErr;?></span>
					</div>
					<div class="form-group">
					<input type="password" id = "MyInputBox" class="form-control" name="psw" placeholder = "Парола" value="<?php echo $psw;?>">
					<span class="error"> <?php echo $passErr;?></span>
					</div>
				   
				   <br><br>
				  </div>



				  <div class="control-group">
					<!-- Button -->
					<div class="controls" style = "margin-top:-40px;">
					  <input class="btn btn-default" id = "MyButtonToAddURL" type="submit" name="submit" value="Влез"> 
					</div>
				  </div>
				</fieldset>
			  </form>                
			</div>
			<div class="tab-pane fade" id="create">
				<form id="tab" role="form" <?php echo 'action='; echo "acc_added.php";?> method="post">
					<div id = "RegInput">
					<div class="form-group" >
					<input type="text" name="FirstName" id = "MyInputBox" class="form-control" placeholder = "Първо име" value="<?php echo $name;?>">
					</div>
					<div class="form-group" >
					<input type="text" name="LastName" id = "MyInputBox" class="form-control" placeholder = "Фамилия" value="<?php echo $name;?>">
					</div>
					<div class="form-group" >
					<input type="text" name="Text" id = "MyInputBox" class="form-control" placeholder = "Опишете себе си с две-три думи" value="<?php echo $name;?>">
					</div>
					<div class="form-group" >
					<input type="text" name="IMGURL" id = "MyInputBox" class="form-control" placeholder = "URL към снимка" value="<?php echo $name;?>">
					</div>
					<div class="form-group" >
						<label for="text" id = "descURL" style = "font-family:Arial;margin:auto;margin-left:20px;font-size:25px;color:#d2c9c6;">Рожден ден</label>
						<select class="form-control" id = "MyInputBox" style = "margin-left:19px;float:left;width:40%;margin-right:13px;" name="Month">
							<?php 
								include "graphs/convert_month_to_word.php";
								echo '<option value="0">Месец</option>';
								for ($counter = 1; $counter <= 12; $counter++){
									if ($counter < 10){
										$Zero = "0";
									} else {
										$Zero = "";
									}
									echo '<option value="'.$Zero.$counter.'">'.ConvertMonthToWord($counter).'</option>';
								}
							?>
						</select>
						<select class="form-control" id = "MyInputBox" style = "width:40%;" name="Day">
							<option value="0">Ден</option>
							<?php 
								for ($counter = 1; $counter <= 31; $counter++){
									if ($counter < 10){
										$Zero = "0";
									} else {
										$Zero = "";
									}
									echo '<option value="'.$Zero.$counter.'">'.$counter.'</option>';
								}
							?>
						</select>
						<select class="form-control" id = "MyInputBox" style = "margin-top:18px;" name="Year">
							<option value="0">Година</option>
							<?php 
								for ($counter = (date("Y")-5); $counter > 1989; $counter--){
									echo '<option value="'.$counter.'">'.$counter.'</option>';
								}
							?>
						</select>
						<select class="form-control" id = "MyInputBox" style = "margin-top:18px;" name="Sex">
							<option value="1">Момче</option>
							<option value="2">Момиче</option>
						</select>
					</div>
					<div class="form-group" >
					<input type="text" name="name" id = "MyInputBox" class="form-control" placeholder = "Потребителско име" value="<?php echo $name;?>">
					</div>
					<div class="form-group">
					<input type="password" id = "MyInputBox" class="form-control" name="psw" placeholder = "Парола" value="<?php echo $psw;?>">
					</div>
					</div>
					<button class="btn btn-primary" id = "MyButtonToAddURL" type="submit" >Създай профил</button>
				</form>
			</div>
		</div>
	  </div>
	  <a href="home.php?user=david" id = "index_image" style = "position:fixed;right:130;top:105;" target=_blank><img class=shakeimage onmouseout="stoprattle(this)" onmouseover="init(this);rattleimage()" src="css/features.jpg" border=0 width="500px"></a>
  
	<?php
		echo '<style>#descURL{color:#837d7c;font-size:20px;font-weight:bold;margin:auto;margin-left:10px;font-family:Arial;}</style>';
	
		$SQL = "SELECT COUNT(user.Name) FROM user";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		echo '<p id = "descURL" >Регистрирани потребители: ';
		echo $row[0].'</p>';
		
		$SQL = "SELECT COUNT(homeworks.UID) FROM homeworks";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		echo '<p id = "descURL">Домашни: ';
		echo $row[0].'</p>';
		
		$SQL = "SELECT COUNT(otherinfo.UID) FROM otherinfo";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		echo '<p id = "descURL">Допълнително: ';
		echo $row[0].'</p>';
	?>
	</div>
</div>
<?php
if($name != ""){
	if ($db_found) {
		$result = mysql_query("SELECT Count(user.Name) FROM user WHERE user.Name = '".$name."'");
		$row = mysql_fetch_array($result);
		
		if ($row[0] > 0){
			$home = 'home.php?class='.$name.'&psw='.$psw;
		} else {
			$home = 'notreg.php';
		}
		header('Location: '.$home) and exit;
	}
	else {
		echo 'Database not found!';
		mysql_close($dbLink);
	}
}
// echo "<h2>Your Input:</h2>";
// echo $name;
?>
</div>
</body>
</html>