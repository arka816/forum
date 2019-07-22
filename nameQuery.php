<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$sql = "SELECT name FROM Topics";
	$result = $conn->query($sql);

	$str = "";
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if($str == "")
			 	$str = $str.$row["name"];
		 	else
		 		$str = $str.",".$row["name"];
		}
	}
	echo $str;
?>