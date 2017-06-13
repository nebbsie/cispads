<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "cispads";
$conn = new mysqli($serverName, $username, $password, $dbName);
if($conn -> connect_error) {
	die("Connection Failed" . $conn->connect_error);
}
?>