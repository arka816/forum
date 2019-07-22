<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$sql = "SELECT content FROM topicTable";
	$result = $conn->query($sql);

	$str = "";
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if($str == "")
			 	$str = $str.$row["content"];
		 	else
		 		$str = $str."|".$row["content"];
		}
	}
	echo $str;
?>