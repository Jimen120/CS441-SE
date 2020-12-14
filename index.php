<?php


if(!empty($firstname) || !empty($lastname) || !empty($email) || !empty($password))
{
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "test";

//creating the connection
$conn = new mysqli($host, $dbUsername);

if(mysqli_connect_error())
{
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
}
else{
	$SELECT = "SELECT email From users Where email = ? Limit 1";
	$INSERT = "INSERT Into users (firstname, lastname, email, password) values (?, ?, ?, ?)";

	//prepare statement
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum = $stmt->num_rows;

	if($rnum==0)
	{
		$stmt->close();

		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("ssss",$firstname, $lastname, $email, $password);
		$stmt->execute();
		echo "New record has been updated successfully";
	}
	else{
		echo "someone already registered using this email";
	}
	$stmt->close();
	$conn->close();
}

}
else{
	echo "Data successfully inserted";
	die();
}


?>