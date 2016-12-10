<?php
session_start();
include "connect.php";
require_once('PHPMailer/class.phpmailer.php');

 // Take the image data and decode to an actual image.
$filteredData=substr($_POST['img_val'], strpos($_POST['img_val'], ",")+1);
$unencodedData=base64_decode($filteredData);

// Get email address
$emailA = $_SESSION["pad-email"];
echo "<br>Email: " . $emailA . "<br>";

//Save the image
userLogin($conn);
$base = "images"; // Base folder to save in.
$name = $_SESSION['user-id']; // Folder to save in.
$dir = $base . '/' . $name . '/' . $_SESSION['times'] . ".jpg"; // The full directory.

mkdir($base . '/' . $name); // Make the folder to save the image in. Open if already made.
file_put_contents($dir, $unencodedData); // Save the image in the directory.

$_SESSION['sent-email'] = true;
$_SESSION['sent-email-to'] = $emailA;

header('Location: ' . "../userpage.php");

// Send email //



$email = new PHPMailer();
$email->From      = 'dave@nebbs.com';
$email->FromName  = 'Dave Nebbs';
$email->Subject   = 'CIS PAD';
$email->Body      = 'Please find attached a pdf.';
$email->AddAddress( 'steve@nebbs.com' );
$email->AddAttachment( $dir , 'pad.jpg' );
$email->Send();

function userLogin($conn){
	// Update the user PDF count.
	$id = $_SESSION['user-id'];
	$id = intval($id);

	$getPDF = "SELECT * FROM users WHERE id = $id";
	$result = $conn->query($getPDF);

	if($result->num_rows > 0) {
		saveToSession($result);
	}

	// Update the users PDF count.
	$times =  $_SESSION['pdfs'];
	$times = intval($times);
	$times = $times + 1;
	$_SESSION['times'] = $times;

	$sqlUpdateSC = "UPDATE users SET pdfs=$times  WHERE id = $id";

	if($conn->query($sqlUpdateSC) === True){
		echo "Added Image Succesfully";
	}

	return;
} 

function saveToSession($result){
	session_unset();
	while($row = $result->fetch_assoc()) {
		$_SESSION["user-id"] = $row['id'];
		$_SESSION["username"] = $row['username'];
		$_SESSION["password"] = $row['password'];
		$_SESSION["fname"] = $row['fname'];
		$_SESSION["lname"] = $row['lname'];
		$_SESSION["times"] = $row['timesUsed'];
		$_SESSION["pdfs"] = $row['pdfs'];
		echo $row['pdfs'];
	}
}

?>
