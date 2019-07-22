<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);
	// Connection Status
	if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		echo "Connected successfully. ";
	
	$username = $_GET["username"];
	$comment = $_GET["comment"];
	$topic = $_GET["topicname"];

	$sql = "INSERT INTO Comments (topicname,username,comment)
	VALUES ('$topic','$username','$comment')";

	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

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

	$count++;
	$sql = "UPDATE topicTable SET comment = $count WHERE name = '$topic'";
	mysqli_query($conn, $sql);

	/*$sql = "DELETE FROM Topics";

	if($conn->query($sql) === TRUE)
		echo "record deleted";
	else
		echo $conn->error;*/
	$conn->close();
?>