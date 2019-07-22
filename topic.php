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
	
	$topicname = $_GET["name"];
	$content = $_GET["content"];

	$sql = "INSERT INTO topicTable (name,content,upvote,downvote,comment)
	VALUES ('$topicname','$content','0','0','0')";

	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	/*$sql = "DELETE FROM topicTable";

	if($conn->query($sql) === TRUE)
		echo "record deleted";
	else
		echo $conn->error;*/
	$conn->close();
?>