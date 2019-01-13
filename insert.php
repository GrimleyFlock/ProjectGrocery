<?php
	$Email = $_POST['email'];
	$Password = $_POST['psw'];
	$Repeat_password = $_POST['psw-repeat'];

if ( !empty($Email) || !empty($Password) || !empty($Repeat_password)){
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "sign_up";

//Creating connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

	if(mysql_connect_error()){
		die('Connect Error('.mysql_connect_errno().')'. mysqli_connect_error());
	} else {
		$SELECT = "SELECT email From register Where email = ? Limit 1";
		$INSERT = "INSERT Intro register (Email, Password, Repeat_password ) values (?, ?, ?)";

		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $Email);
		$stmt->execute();
		$stmt->bind_result($Email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;

		if ($rnum == 0){
			$stmt->close();

			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sss", $Email, $Password, $Repeat_password);
			$stmt->execute();
			echo "New record inserted";
		} else {
			echo "This email has been used to register";
		}
		$stmt->close();
		$conn->close();
		

		}


	}
	
	
	
	
} else {
	echo "All fields are required";
	die();
	
}

?>
