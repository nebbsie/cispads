<?php
$serverName = "localhost";
$username = "cispadsc_admin";
$password = "bellamy1995";
$dbName = "cispadsc_CIS";
$conn = new mysqli($serverName, $username, $password, $dbName);
if($conn -> connect_error) {
	die("Connection Failed" . $conn->connect_error);
}
?>