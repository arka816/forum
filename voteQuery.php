<?php
	$topic = $_GET["topic"];
	$user = $_GET["user"];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	//error_reporting(0);  
	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$sql = "SELECT username,topicname,upvote FROM myVote";
	$result = $conn->query($sql);

	$val1 = 1;

	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if(strcmp($user, $row["username"]) == 0 && strcmp($topic, $row["topicname"]) == 0)
			{
				if($row["upvote"] == 1)
				{
					$val1 = 2;
					break;
				}
			}
		}
	}
	
	$sql = "SELECT username,topicname,downvote FROM myVote";
	$result = $conn->query($sql);

	$val2 = 1;

	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if(strcmp($user, $row["username"]) == 0 && strcmp($topic, $row["topicname"]) == 0)
			{
				if($row["downvote"] == 1)
				{
					$val2 = 2;
					break;
				}
			}
		}
	}

	echo $val1."|".$val2;	
	$conn->close();
?>