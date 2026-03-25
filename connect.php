<?php
	$first = $_POST['first'];
	$password = $_POST['password'];
	
	//Database Connection
	$conn = new mysqli('localhost', 'root', '', 'test');
	if($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error); // Corrected line
	} else {
		$stmt = $conn->prepare("insert into registration (first, password)
			values(?,?)");
		$stmt->bind_param("ss",$first, $password);
		$stmt->execute();
		echo "registration Successfully";
		$stmt-close();
		$conn->close();
	}
?>