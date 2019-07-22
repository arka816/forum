<!DOCTYPE html>
<html>
<head>
	<title>comments</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="login.css">
	<style type="text/css">
		div#container::-webkit-scrollbar {
		    width: 5px;
		}
		 
		div#container::-webkit-scrollbar-track {
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		}
		 
		div#container::-webkit-scrollbar-thumb {
		  background-color: darkgrey;
		  outline: 1px solid slategrey;
		}
	</style>
</head>
<body onload="initiate()">
	<?php
		error_reporting(0); 
		session_start();
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "myDB";

		// Create connection
		$conn = new mysqli($servername, $username, $password,$dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		/*$sql = "CREATE TABLE Comments (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		topicname VARCHAR(100) NOT NULL,
		username VARCHAR(100) NOT NULL,
		comment TEXT NOT NULL
		)";

		if ($conn->query($sql) === TRUE) {
		    echo "Table MyTopic created successfully";
		} else {
		    echo "Error creating table: " . $conn->error;
		}*/

		setcookie("name",$_GET["name"], time() + (86400 * 30), "/");
		setcookie("uname", $_GET["username"], time() + (86400 * 30), "/");
		setcookie("content", $_GET["content"], time() + (86400 * 30), "/");
		setcookie("actype", $_GET["actype"], time() + (86400 * 30), "/");

		$conn->close();
	?>

	<div id="text" style="display: none"><?php 
	if(isset($_GET["name"]))
		echo $_GET["name"]."|".$_GET["content"]."|".$_GET["username"]."|".$_GET["actype"]; 
	else
		echo $_COOKIE["name"]."|".$_COOKIE["content"]."|".$_COOKIE["uname"]."|".$_COOKIE["actype"];
	?></div>
	<div class="head">
		<div style="padding: 20px; background-color: #7aabfa; border-radius: 20px 20px 0px 0px"><h1 id="header" style="margin: 0px"></h1></div>
		<div style="background-color: rgba(200,200,200,0.4); padding: 20px"><p id="content"></p></div>
	</div><br>
	<div id="container"></div><br>

	<script type="text/javascript">
		var values = new Array();
		var names = new Array();
		var comments = new Array();
		var str = new Array();
		var commentCount = 0;
		var commentArray = new Array();

		str = document.getElementById('text').innerHTML.split("|");
		document.getElementById("header").innerHTML = str[0];
		document.getElementById('content').innerHTML = str[1];

		var topicName = str[0];
		var username = str[2];
		var accountType = str[3];

		function initiate()
		{
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200)
				{
					values = this.responseText.split("|");
					names = values[0].split(",");
					comments = values[1].split("^");
					ids = values[2].split(",");

					for (var i = 0; i < names.length; i++) {
						if(names[0] != "")
						{
							commentCount++;
							commentCreate(i,names[i],comments[i]);
						}
					}
				}
			};
			xhttp.open("GET","commentQuery.php?topicName="+topicName,false);
			xhttp.send();
		}

		function commentCreate(i,name,comment)
		{
 			var container = document.getElementById("container");
 			breaker = document.createElement("br");

 			commentArray[i] = document.createElement("div");
 			commentArray[i].style.marginBottom = "20px";
 			commentArray[i].id = i;
 			container.append(commentArray[i]);

 			commentContainer = document.createElement("span");
 			commentContainer.style.display = "inline-grid";
 			commentContainer.style.borderRadius = "10px";
 			commentContainer.style.padding = "10px";
 			commentContainer.style.padding = "5px";
 			commentContainer.style.marginBottom = "2px";
 			commentContainer.style.backgroundColor = "#f1f1f1";
 			commentContainer.style.maxwidth = "400px";
 			commentArray[i].append(commentContainer);

 			user = document.createElement("span");
 			user.style.fontWeight = "bold";
 			user.innerHTML = name;
 			commentContainer.append(user);

 			statement = document.createElement("span");
 			statement.style.color = "grey";
 			statement.innerHTML = comment;
 			commentContainer.append(statement);


 			if(accountType == "admin")
 			{
 				//commentContainer.append(breaker);
 				deleteCom = document.createElement("div");
 				deleteCom.innerHTML  = "delete";
 				deleteCom.style.color = "grey";
 				deleteCom.style.fontSize = "80%";
 				deleteCom.style.paddingLeft = "10px";
 				deleteCom.style.cursor = "pointer";
 				deleteCom.addEventListener("click",function(){
 					document.getElementById("text").innerHTML = i;
 					deleteAlert(i,name,comment);
 				});
 				commentArray[i].append(deleteCom);
 			}
		}

		function deleteAlert(i,name,comment)
		{
			document.getElementById("text").innerHTML = i+"|"+name+"|"+comment;
			delAlert = document.createElement("div");
			delAlert.id = "delAlert";
			delAlert.innerHTML = "Are you sure you want to delete this comment?";
			document.body.appendChild(delAlert);

			breaker = document.createElement("br");
			delAlert.append(breaker);

			yes = document.createElement("button");
			yes.id = "yes";
			yes.innerHTML = "yes";
			yes.className = "ans";
			yes.addEventListener("click",function(){
				deleteComment();
			});
			delAlert.append(yes);

			cancel = document.createElement("button");
			cancel.id = "cancel";
			cancel.innerHTML = "cancel";
			cancel.className = "ans";
			cancel.addEventListener("click",function(){
				document.getElementById('delAlert').style.display = "none";
			});
			delAlert.append(cancel);

			document.getElementById('delAlert').style.display = "block";

		}
		function deleteComment(){
			var str = document.getElementById("text").innerHTML.split("|");

			i= str[0];
			name = str[1];
			comment = str[2];

			document.getElementById(i).style.display = "none";
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","commentDel.php?name="+name+"&topic="+topicName+"&comment="+comment);
			xhttp.send();
			document.getElementById('delAlert').style.display = "none";
		}

		function addComment()
		{
			var com = document.getElementById("commentBox").value;
			document.getElementById("commentBox").value = "";
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200)
				{
					//document.getElementById('text').innerHTML = this.responseText;
				}
			}
			xhttp.open("GET","commentTable.php?username="+username+"&comment="+com+"&topicname="+topicName,false);
			xhttp.send();
			commentCreate(commentCount++,username,com);
		}
	</script>

	<div style="text-align: left; position: fixed; bottom: 0%; left: 5%; width: 86%; padding: 2%; background-color: transparent; border-radius: 0px 0px 20px 20px">
		<textarea id="commentBox" autofocus placeholder="Type Comment"></textarea>
		<input type="submit" id="post" value="post" onclick="addComment()">
	</div>	
</body>
</html>