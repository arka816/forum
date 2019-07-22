<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	//error_reporting(0);  
	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$topic = $_GET["topic"];

	$sql = "SELECT name,upvote,downvote,comment FROM topicTable";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {
			if(strcmp($topic, $row["name"]) == 0)
			{
				echo $row["upvote"]."|".$row["downvote"]."|".$row["comment"];
				break;
			}
		}
	}
		
	$conn->close();
?>