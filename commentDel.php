<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$name = $_GET["name"];
	$topic = $_GET["topic"];
	$comment = $_GET["comment"];

	$sql = "DELETE FROM Comments WHERE username = '$name' AND topicname = '$topic' AND comment = '$comment'";
	mysqli_query($conn, $sql);

	$sql = "SELECT name,comment FROM topicTable";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {
			if(strcmp($topic, $row["name"]) == 0)
			{
				$count = $row["comment"];
			}
		}
	}

	$count--;
	$sql = "UPDATE topicTable SET comment = $count WHERE name = '$topic'";
	mysqli_query($conn, $sql);

	$conn->close();
?>