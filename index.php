<html>
<?php
	include "head.php";
?>
<body>
<div class="" id="loginModal" ">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
		<h3>Have an Account?</h3>
	  </div>
	  <div class="modal-body">
		<div class="well">
		  <ul class="nav nav-tabs">
			<li class="active"><a href="#login" data-toggle="tab">Login</a></li>
			<li><a href="#create" data-toggle="tab">Create Account</a></li>
		  </ul>
		  <div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="login">
			  <form class="form-horizontal" action="" method="POST">
				<fieldset>
				     
				  <div class="control-group">
					<!-- Username -->
					<label class="control-label" for="username">Username</label>
					<div class="controls">
					  <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
					</div>
				  </div>

				  <div class="control-group">
					<!-- Password-->
					<label class="control-label" for="password">Password</label>
					<div class="controls">
					  <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
					</div>
				  </div>


				  <div class="control-group">
					<!-- Button -->
					<div class="controls" style = "margin-top:10px;">
					  <?php
					  echo '<a id = "choose_class" href="home.php?class=">LOGIN</a>'; ?>
					</div>
				  </div>
				</fieldset>
			  </form>                
			</div>
			<div class="tab-pane fade" id="create">
			  <form id="tab">
				<label>Username</label>
				<input type="text" value="" class="input-xlarge">
				<label>Password</label>
				<input type="password" id="password" name="password" placeholder="" class="input-xlarge">

				<div>
				  <button class="btn btn-primary"style = "margin-top:10px;">Create Account</button>
				</div>
			  </form>
			</div>
		</div>
	  </div>
	</div>
</div>
</body>
</html>