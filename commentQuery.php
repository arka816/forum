<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$sql = "SELECT id,topicname,username,comment FROM Comments";
	$result = $conn->query($sql);

	$topic = $_GET["topicName"];

	$str1 = "";
	$str2 = "";
	$str3 = "";

	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if(strcmp($row["topicname"], $topic) == 0)
			{
				if($str1 == "")
				 	$str1 = $str1.$row["username"];
			 	else
			 		$str1 = $str1.",".$row["username"];

			 	if($str2 == "")
				 	$str2 = $str2.$row["comment"];
			 	else
			 		$str2 = $str2."^".$row["comment"];

			 	if($str3 == "")
				 	$str3 = $str3.$row["id"];
			 	else
			 		$str3 = $str3.",".$row["id"];
			}
		}
	}
	$str = $str1."|".$str2."|".$str3;
	echo $str;

	$conn->close();
?>