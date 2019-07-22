<!DOCTYPE html>
<html>
<head>
	<title>Registration page</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet"> 
	<meta charset="utf-8">
</head>
<body>
	<script type="text/javascript">
		document.getElementById("register").reset();
	</script>
	<div style="color: #064169; position: fixed; width: 100%; top: 0px; left: 0px; background-color: #00c1c7; text-align: left; padding: 10px 0px 10px 30px;">
		<span style="font-size: 300%; margin: 0px;">Forum</span>
		<span style="font-family: 'Indie Flower', cursive; font-size: 200%"> .com</span>
	</div>
	<div class="form" style="width: 450px">
		<h1 style="color: #d83230">
			WELCOME!<br>
			REGISTER HERE
		</h1>
		<form action="register.php" method="post" id="register">
			<span style="color: red; font-size: 10px">* marked fields are mandatory</span><br>

			<input type="text" name="firstname" placeholder="First Name" class="form" style="width: 200px" required autofocus><span style="color: red"> *</span><br>

			<input type="text" name="lastname" placeholder="Last Name" class="form" style="width: 200px">

			<br><input type="text" name="username" placeholder="Username" class="form" style="width: 200px" required><span style="color: red"> *</span><br>

			<input type="text" name="email" placeholder="Email" class="form" style="width: 250px" required><span style="color: red"> *</span><br>

			Type a Password: <input type="password" name="password1" class="form" style="width: 160px"  required><span style="color: red"> *</span><br>

			<span style="color: red; font-size: 12px">Password should contain at least 8 characters among which there should be an uppercase letter, a lowercase letter, a number, and a special character</span><br>

			Confirm Password: <input type="password" name="password2"  class="form" style="width: 160px" required><span style="color: red"> *</span><br>

			Date of Birth: <input type="date" name="bday" class="form" value="<?php echo $date;?>"> <i class="fa fa-calendar"> </i> <br><br>

			Gender:
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="female">Female
			<input type="radio" name="gender" value="other">Other<br><br>

			Account Type:
			<input type="radio" name="type" value="admin" required>Administrator
			<input type="radio" name="type" value="user">User<span style="color: red">  *</span><br>
			<input type="submit" class="submit" value="Register">
			<input type="reset" name="reset" value="reset" class="register"><br>
		</form>
		<div class="my_class"></div>
	</div>
	<br><br><br><br><br><br><br>

	<?php
		error_reporting(0);

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
	
		$status = FALSE;


		//form validation code
		if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["firstname"]))
		{
			$status = TRUE;
			if(!preg_match("/^[a-zA-Z]*$/", $_POST['firstname']) && !empty($_POST["firstname"]))
			{
				$status = FALSE;
				echo '<script language="javascript">';
				echo 'alert("name must contain only letters")';
				echo '</script>';
			}

			if(!preg_match("/^[a-zA-Z]*$/", $_POST['lastname']) && !empty($_POST['lastname']))
			{
				$status = FALSE;
				echo '<script language="javascript">';
				echo 'alert("surname must contain only letters")';
				echo '</script>';
			}

			$sql = "SELECT username,id FROM MyCustomer";
			$result = $conn->query($sql);

			if($result->num_rows>0)
			{
				while($row = $result->fetch_assoc())
				{
					if(strcmp($row["username"], $_POST["username"]) == 0)
					{
						$status = FALSE;
						echo '<script language="javascript">';
						echo 'alert("username already taken")';
						echo '</script>';
						break;
					}
				}
			}

			if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && $_POST["email"]!="")
			{
				$status = FALSE;
				echo '<script language="javascript">';
				echo 'alert("invalid email address")';
				echo '</script>';
			}

			$containsLetter  = preg_match('/[a-zA-Z]/',$_POST["password1"]);
			$containsDigit   = preg_match('/\d/',$_POST["password1"]);
			$containsSpecial = preg_match('/[^a-zA-Z\d]/', $_POST["password1"]);
			$containsAll = $containsLetter && $containsDigit && $containsSpecial;

			if(!$containsAll)
			{
				$status = FALSE;
				echo '<script language="javascript">';
				echo 'alert("password  should contain an uppercase letter, a lowercase letter, a number, and a special character")';
				echo '</script>';
			}

			if(strlen($_POST["password1"])<2)
			{
				$status = FALSE;
				echo '<script language="javascript">';
				echo 'alert("password cannot be shorter than 8 characters")';
				echo '</script>';
			}
			if(strcmp($_POST["password1"], $_POST["password2"])!=0)
			{
				$status = FALSE;
				echo '<script language="javascript">';
				echo 'alert("passwords do not match")';
				echo '</script>';
			}
		}




		// sql to create table
		/*$sql = "CREATE TABLE MyCustomer (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30),
		username VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		password VARCHAR(50),
		DOB VARCHAR(20),
		gender VARCHAR(10), 
		actype VARCHAR(20)
		)";

		if ($conn->query($sql) === TRUE) {
		    echo "Table MyCustomer created successfully";
		} else {
		    echo "Error creating table: " . $conn->error;
		}*/


		//code to enter data into table
		if($status == TRUE)
		{
			$firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
			$email = $_POST["email"];
			$username = $_POST["username"];
			$password = $_POST["password1"];
			$bday = $_POST["bday"];
			$gender = $_POST["gender"];
			$type = $_POST["type"];

			$sql = "INSERT INTO MyCustomer (firstname,lastname,username,email,password,DOB,gender,actype) 
			VALUES ('$firstname','$lastname','$username','$email','$password','$bday','$gender','$type')";

			if (mysqli_query($conn, $sql)) {
			    echo '<script language="javascript">';
			    echo 'alert("New record created successfully")';
			    echo '</script>';
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}


		}
		$conn->close();
	?> 
</body>
</body>
</html>
