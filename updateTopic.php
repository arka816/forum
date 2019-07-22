<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$name = $_GET["name"];
	$content = $_GET["content"];

	$sql = "UPDATE topicTable SET content = '$content' WHERE name = '$name'";
	mysqli_query($conn, $sql);

	echo $content;

	$conn->close();
?>