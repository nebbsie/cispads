<?php
$serverName = "";
$username = "";
$password = "";
$dbName = "";

$conn = new mysqli($serverName, $username, $password, $dbName);

if($conn -> connect_error) {
	die("Connection Failed" . $conn->connect_error);
}

?>






