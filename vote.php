<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	//error_reporting(0);  
	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$user = $_GET["user"];
	$topic = $_GET["topic"];
	$code = $_GET["code"];

	if($code == 1)
	{
		$sql = "INSERT INTO myVote (username,topicname,upvote,downvote)
		VALUES ('$user','$topic',1,0)";
	}
	else if($code == 3)
	{
		$sql = "INSERT INTO myVote (username,topicname,upvote,downvote)
		VALUES ('$user','$topic',0,1)";
	}
	else 
	{
		$sql = "DELETE FROM myVote WHERE username = '$user' AND topicname = '$topic'";
	}

	mysqli_query($conn, $sql);
	$conn->close();
?>