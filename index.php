﻿<html>
<?php
	include "head.php";
	include "config.php";
?>
<body>
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
<div class="" id="loginModal" ">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
		<h3 style = "color:rgba(243, 243, 243, 0.8);">Have an Account?</h3>
	  </div>
	  <div class="modal-body">
		<div class="well">
		  <ul class="nav nav-tabs">
			<li class="active"><a href="#login" data-toggle="tab">Login</a></li>
			<li><a href="#create" data-toggle="tab">Create Account</a></li>
		  </ul>
		  <div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="login">
			<form method="post" class="form-horizontal" <?php echo 'action='; echo "home.php";?>> 
				<fieldset>
				     
				  <div class="control-group" style = "margin-top: 20px; margin-right: 80%;margin-left: 2%;">
					<!-- Username -->
					<div class="form-group" >
					<label for="text" style = "margin-right: 10px;" >Име: </label>
					<input type="text" name="name" class="form-control"  value="<?php echo $name;?>">
					<span class="error"> <?php echo $nameErr;?></span>
					</div>
					<div class="form-group">
					<label for="password">Парола</label>
					<input type="password" class="form-control" name="psw" value="<?php echo $psw;?>">
					<span class="error"> <?php echo $passErr;?></span>
					</div>
				   
				   <br><br>
				  </div>



				  <div class="control-group">
					<!-- Button -->
					<div class="controls" style = "margin-top:-40px;">
					  <input class="btn btn-default" type="submit" name="submit" value="Влез"> 
					</div>
				  </div>
				</fieldset>
			  </form>                
			</div>
			<div class="tab-pane fade" id="create">
				<form id="tab" role="form" <?php echo 'action='; echo "acc_added.php";?> method="post">
					<div class="form-group" >
					<label for="text" style = "margin-right: 10px;" >Име: </label>
					<input type="text" name="name" class="form-control"  value="<?php echo $name;?>">
					</div>
					<div class="form-group">
					<label for="password">Парола</label>
					<input type="password" class="form-control" name="psw" value="<?php echo $psw;?>">
					</div>
					<button class="btn btn-primary" type="submit" >Създай профил</button>
				</form>
			</div>
		</div>
	  </div>
	  <div class="panel panel-primary"><div class="panel-heading">Информация</div>
  <div class="panel-body">
	<?php
	
		$SQL = "SELECT COUNT(user.Name) FROM user";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		echo '<p>Регистрирани потребители: ';
		echo $row[0].'</p>';
		
		$SQL = "SELECT COUNT(homeworks.UID) FROM homeworks";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		echo '<p>Домашни: ';
		echo $row[0].'</p>';
		
		$SQL = "SELECT COUNT(otherinfo.UID) FROM otherinfo";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		echo '<p>Други: ';
		echo $row[0].'</p>';
	?>
  </div></div>
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

</body>
</html>