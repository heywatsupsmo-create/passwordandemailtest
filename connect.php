<?php
$first = $_POST['first']; 
$password = $_POST['password']; 
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = getenv('DB_PORT');

$conn = mysqli_init();
$conn->ssl_set(NULL, NULL, "/var/www/html/ca.pem", NULL, NULL);

$success = $conn->real_connect($host, $user, $pass, $db, $port);

if (!$success) {
    die('Connection Failed : ' . mysqli_connect_error());
} else {
    $stmt = $conn->prepare("INSERT INTO registration (first, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $first, $password);
    
    if($stmt->execute()) {
        echo "Registration Successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
