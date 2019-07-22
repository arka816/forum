<?php
	//error_reporting(0);

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]))
	{
		$servername = "localhost";
		$username = "id10082728_arka816";
		$password = "arka816";
		$dbname = "id10082728_mydb";
		$logValid = false;
		
		$_SESSION["username"] = $_POST["username"];
		$_SESSION["password"] = $_POST["password"];
		$_SESSION["actype"] = $_POST["actype"];

		echo $_POST["username"];

		// Create connection
		$conn = new mysqli($servername, $username, $password,$dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		echo "connected";

		$sql = "SELECT username,password,firstname,gender,actype FROM MyCustomer";
		$result = $conn->query($sql);

		if($result->num_rows>0)
		{
			while($row = $result->fetch_assoc())
			{
				if($_SESSION["username"] == $row["username"] && $_SESSION["password"] == $row["password"] && $_SESSION["actype"] == $row["actype"])
				{
					$_SESSION["firstname"] = $row["firstname"];
					$_SESSION["gender"] = $row["gender"];
					$logValid = true;
					break;
				}
			}
		}

		if($logValid == true)
		{
			header("Location:home.php");
		}
		else
		{
			echo reset($_POST);
			$alert = 1;
			header("Location:index.php?alert=".$alert);
		}
		$conn->close();
	}
?>