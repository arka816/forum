<?php
	$name = $_GET["topicname"];
	$command = $_GET["command"];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	//error_reporting(0);  
	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$sql = "SELECT name,upvote FROM topicTable";
	$result = $conn->query($sql);

	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if(strcmp($name, $row["name"]) == 0)
			{
				$upvote = $row["upvote"];
				break;
			}
		}
	}
	if($command) $upvote++;
	else $upvote--;

	$sql = "UPDATE topicTable SET upvote = $upvote WHERE name = '$name'";
	mysqli_query($conn, $sql);
	
	echo $upvote;	
	$conn->close();
?>