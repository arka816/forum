<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$topic = $_GET["topicname"];

	$sql = "DELETE FROM Comments WHERE topicname = '$topic'";
	mysqli_query($conn, $sql);

	$sql = "DELETE FROM topicTable WHERE name = '$topic'";
	mysqli_query($conn, $sql);

	$sql = "DELETE FROM myVote WHERE topicname = '$topic'";
	mysqli_query($conn, $sql);

	$conn->close();
?>