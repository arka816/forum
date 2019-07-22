<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$sql = "SELECT name,id FROM Topics";
	$result = $conn->query($sql);

	$name = $_GET["name"];
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if(strcmp($name, $row["name"]) == 0)
			{
				$key = $row["id"];
			}
		}
	}
	
	echo $key;
	$conn->close();
?>