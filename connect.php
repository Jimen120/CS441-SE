<?php
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

if(!empty($firstname))
{
	if(!empty($lastname))
	{
		$host = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$dbname = "test";


		//creating the connection
		$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

		if(mysqli_connect_error())
		{
			die('Connect Error('. mysqli_connect_errno() .') '
			. mysqli_connect_error());
		}
		else
		{
			$sql = "INSERT INTO users (firstname, lastname, email, password)
			VALUES ('$firstname', '$lastname', '$email', '$password')";
			if($conn->query($sql))
			{
				echo "New record is inserted successfully";
			}
			else
			{
				echo "Error: ". $sql ."<br>". $conn->error;
			}

			$conn->close();
		}
	}
	else{
		echo: "lastname should not be empty";
	}
}
else{
	echo "firstname should not be empty";
	die();
}


?>