<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	$sql = "SELECT name,content,upvote,downvote,comment FROM topicTable";
	$result = $conn->query($sql);

	$str1 = "";
	$str2 = "";
	$str3 = "";
	$str4 = "";
	$str5 = "";

	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			if($str1 == "")
			 	$str1 = $str1.$row["name"];
		 	else
		 		$str1 = $str1.",".$row["name"];

		 	if($str2 == "")
			 	$str2 = $str2.$row["content"];
		 	else
		 		$str2 = $str2."^".$row["content"];

		 	if($str3 == "")
			 	$str3 = $str3.$row["upvote"];
		 	else
		 		$str3 = $str3.",".$row["upvote"];

		 	if($str4 == "")
			 	$str4 = $str4.$row["downvote"];
		 	else
		 		$str4 = $str4.",".$row["downvote"];

		 	if($str5 == "")
			 	$str5 = $str5.$row["comment"];
		 	else
		 		$str5 = $str5.",".$row["comment"];
		}
	}
	$str = $str1."|".$str2."|".$str3."|".$str4."|".$str5;
	echo $str;
	$conn->close();
?>