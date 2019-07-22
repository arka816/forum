<!DOCTYPE html>
<html>
<head>
	<title>test drive</title>
</head>
<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "myDB";
		// Create connection
		$conn = new mysqli($servername, $username, $password,$dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		echo "Connected successfully. ";

		$sql = "SELECT firstname,lastname,username,email,password,DOB,gender,actype FROM MyCustomer";
		$result = $conn->query($sql);
		if($result->num_rows>0)
		{
			while($row = $result->fetch_assoc())
			{
				echo "<br>";
				echo $row["firstname"]; echo ",     ";
				echo $row["lastname"]; echo ",     ";
				echo $row["username"]; echo ",     ";
				echo $row["email"]; echo ",     ";
				echo $row["password"]; echo ",     ";
				echo $row["DOB"]; echo " ,    ";
				echo $row["gender"]; echo ",     ";
				echo $row["actype"]; echo ",     ";
			}
		}
		
	?>
</body>
</html>