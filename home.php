<!DOCTYPE html>
<html>
<head>
	<title>home page</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">
	<meta charset="utf-8">
</head>
<body onload="initiate()">
	<?php
		session_start();
		error_reporting(0);  

		unset($_COOKIE[$fname]);
		unset($_COOKIE[$uname]);
		unset($_COOKIE[$gen]);
		unset($_COOKIE[$ac]);

		$servername = "localhost";
		$username = "id10082728_arka816";
		$password = "arka816";
		$dbname = "id10082728_mydb";

		// Create connection
		$conn = new mysqli($servername, $username, $password,$dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		if(isset($_SESSION["firstname"]))
		{
			setcookie("fname",$_SESSION["firstname"], time() + (86400 * 30), "/");
			setcookie("uname", $_SESSION["username"], time() + (86400 * 30), "/");
			setcookie("gen", $_SESSION["gender"], time() + (86400 * 30), "/");
			setcookie("ac", $_SESSION["actype"], time() + (86400 * 30), "/");
		}
	?>

	<div style="color: #012661; font-size: 40px; position: fixed; z-index: 3; top: 63px; background-color: #00c1c7; width: 100%; padding: 10px 0px 10px 20px; text-align: left">
		Welcome <span id="text"><?php 
		if(isset($_SESSION["firstname"]))
			echo $_SESSION["firstname"]; 
		else
			echo $_COOKIE["fname"];
		?></span> !!
	</div>

	<div id="count"></div>
	<div id="ustatus"></div>
	<div id="dstatus"></div>
	<div id="contentName"></div>

	<div class="header">
		<span style="position: fixed; left: 10px; top: 6px"><h1 style="margin: 0px; color: #012661; font-size: 240%">Forum</h1>
		</span>
		<span style="font-family: 'Indie Flower', cursive; font-size: 200%; position: fixed; left: 130px"> .com</span>
		<span id="actype">
			<?php 
				if(strcmp($_COOKIE["ac"], "admin") == 0) 
					echo "admin";
				else if(strcmp($_COOKIE["ac"], "user") == 0) 
					echo "user";
			?>
		</span>
		<span id="actype">
			<?php 
				if(strcmp($_COOKIE["gen"], "male") == 0) 
					echo "<i class = 'fa fa-male'></i>";
				else if(strcmp($_COOKIE["gen"], "female") == 0) 
					echo "<i class = 'fa fa-female'></i>";
			?>
		</span>
		<span style="margin-right: 20px;">
			<form action="index.php" style="display: inline;">
				<input style="z-index: 3" type="submit" class="submit" name="logout" value="Log Out" onclick="<?php session_unset(); session_destroy(); ?>">
			</form>
		</span>
	</div>
	<br><br><br><br><br><br><br>

	<?php
		/*$sql = "CREATE TABLE topicTable (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100) NOT NULL,
		content TEXT NOT NULL,
		upvote INT(10),
		downvote INT(10),
		comment INT(10)
		)";

		if ($conn->query($sql) === TRUE) {
		    echo "Table topicTable created successfully";
		} else {
		    echo "Error creating table: " . $conn->error;
		}

		$sql = "CREATE TABLE myVote (username VARCHAR(30),
		topicname VARCHAR(30),
		upvote INT(10),
		downvote INT(10)
		)";
		if ($conn->query($sql) === TRUE) {
		    echo "Table myVote created successfully";
		} else {
		    echo "Error creating table: " . $conn->error;
		}*/

		$conn->close();
	?>

	<br>
	<div style="text-align: left; ">
		<button id="topicAdd" onclick="addTopic()"><i class="fa fa-plus-square"></i> Add Topic</button><br><br>
	</div>

	<script type="text/javascript">
		function addTopic(){
			document.getElementById('addTopic').style.display = "block";
		}
		function displayTopic(){
			var name = document.getElementById('topicName').value;
			var content = document.getElementById('topicContent').value;

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200)
				{
					document.getElementById('contentName').innerHTML = this.responseText;
					if(this.responseText == false)
					{
						var xhttp = new XMLHttpRequest();
						xhttp.open("GET","topic.php?name="+name+"&content="+content);
						xhttp.send();
						document.getElementById('addTopic').style.display = "none";
						topicCreate(topicCount,name,content,0,0,0);
						topicCount++;
					}
					else
					{
						document.getElementById("formTopic").reset();
						alert("topic with the same name exists");
					}
				}
			}
			xhttp.open("GET","topicAmbiguity.php?name="+name);
			xhttp.send();
		}

		function discardEdit()
		{
			document.getElementById('editContent').style.display = "none";
		}
		function discardAdd()
		{
			document.getElementById('addTopic').style.display = "none";
		}

		function editContent(name,content){
			var id = name + "box";
			document.getElementById(id).style.display = "none";
			document.getElementById('contentName').innerHTML = name;
			document.getElementById('editContent').style.display = "grid";
			document.getElementById('editedContent').value = content;
		}
		function updateContent(){
			var name = document.getElementById('contentName').innerHTML;
			var str =  document.getElementById('editedContent').value;

			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","updateTopic.php?name="+name+"&content="+str);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send();
			document.getElementById('editContent').style.display = "none";
			var id = name + "body";
			document.getElementById(id).innerHTML = str;
		}
	</script>

	<div id="editContent">
		<form  action="javascript:updateContent()">
			<h1 id="contentName"></h1>
			Edit Content:<br><textarea id="editedContent" required></textarea><br><br>
			<input id="submit" type="submit" value="Add">
			<input id="discard" value="Discard" onclick="discardEdit()" style="cursor: pointer;">
		</form>
	</div>

	<div id="addTopic">
		<form id="formTopic" action="javascript:displayTopic()">
			Topic Name: <input id="topicName" type="text" name="topicName" required autofocus><br>
			Add Content:<br><textarea id="topicContent" required></textarea><br><br>
			<input id="submit" type="submit" value="Add">
			<input id="discard" value="Discard" onclick="discardAdd()" style="cursor: pointer;">
		</form>
	</div>
	<script type="text/javascript" src="home.js"></script>
</body>
</html>