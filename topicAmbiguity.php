<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$sql = "SELECT name FROM topicTable";
	$result = $conn->query($sql);

	$name = $_GET["name"];
	$val = false;

	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if(strcmp($name, $row["name"]) == 0)
			{
				$val = true;
				break;
			}
		}
	}
	
	echo $val;
	$conn->close();
?>