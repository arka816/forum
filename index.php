<!DOCTYPE html>
<html>
<head>
	<title>login page</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet"> 
	<meta charset="utf-8">
</head>
<body>
	<div style="color: #064169; position: fixed; width: 100%; top: 0px; left: 0px; background-color: #00c1c7; text-align: left; padding: 10px 0px 10px 30px;">
		<span style="font-size: 300%; margin: 0px;">Forum</span>
		<span style="font-family: 'Indie Flower', cursive; font-size: 200%"> .com</span>
	</div>
	<?php
		session_unset(); 
		session_destroy();
		session_start();
		if(!isset($_POST["username"]))
			$_POST = array();
		if($_GET["alert"] == 1)
		{
			echo '<script language="javascript">';
			echo 'alert("invalid username or password")';
			echo '</script>';
		}
	?>
	<div  class="form">
		<h1 style="color: #d83230">SIGN IN</h1>
		<form action="check.php"  method="post">
			<span style="color: red; font-size: 10px">* marked fields are mandatory</span><br>
			<input type="text" name="username" placeholder="Name" class="form" style="width: 200px" required autofocus><span style="color: red"> *</span><br>
			<input type="password" name="password" placeholder="Password" class="form" style="width: 160px" required><span style="color: red"> *</span><br>
			<input type="radio" name="actype" value="admin" required>Admin
			<input type="radio" name="actype" value="user" required>User<span style="color: red"> *</span><br>
			<input type="submit" class="submit" value="Log In"><br>
		</form>
		<br>
		<form action="register.php">
			<span style="color: blue; font-size: 10px">Don't have an account ? Register below.</span><br>
			<input type="submit" class="register" value="Register">
		</form>
	</div>
	<br><br><br><br><br><br><br>
</body>
</html>