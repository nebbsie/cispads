<?php
session_start();
include "connect.php";
require "objects/User.php";

checkPOSTMethod($conn);

/*
* Function that controls the POST method
* @param (conn) the connection object
*/
function checkPOSTMethod($conn){

    echo "here";

	if (isset ($_POST['search'])) {
		searchUser($_POST['searchName'], $conn);
	}
	else if (isset($_POST['create'])) {
		createUser($_POST['username'], $_POST['password'], $conn);
	}
	else if (isset($_POST['viewAll'])) {
		getAllUsers($conn);
	}
	else if (isset($_POST['login'])){
        echo "here2";
		userLogin($_POST['username'], $_POST['password'], $conn);
	}
	else if (isset($_POST['selectDelete'])){
		$id = $_POST['deleteVal'];
		deleteSCByID($id, $conn);
	}
	else if (isset($_POST['user-logout'])){
		logoutUser($conn);
	}

}

/*
* Function takes in username to search for
* @param (iUsername) username to search for
* @param (conn) connection to the database
*/
function searchUser($iUsername, $conn) {
	$sqlSearchUserName = "SELECT * FROM users WHERE username = '$iUsername'";
	$result = $conn->query($sqlSearchUserName);

	if($result->num_rows > 0) {
		echo "Found User";
	} else {
		echo "User Not Found";
	}
	endConnection($conn);
}

/*
* Function returns if the user has been found
* @param (iUsername) username to search for
* @param (conn) connection to the database
*/
function checkIfUserExists($iUsername, $conn){
	$sqlSearchName = "SELECT * FROM users WHERE username = '$iUsername'";
	$result = $conn->query($sqlSearchName);

	if($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
	endConnection($conn);
}

/*
* Function creates a new user with the given data
* @param (iUsername) username to create user with
* @param (iPassword) password to create user with
* @param (conn) connection to the database
*/
function createUser($iUsername, $iPassword, $conn){
	$sqlCreateUser = "INSERT INTO Users (userID, username, password, lastloggedin, firstname, lastname, profilepic)
	VALUES ('$iUsername' , '$iPassword')";

	if(checkIfUserExists($iUsername, $conn)){
		echo "Cannot create new user, a user with this name alread exists";
	} else {
		if(mysqli_query($conn, $sqlCreateUser)) {
			echo "Created User " . $iUsername . " with password " . $iPassword;
		} else {
			echo "<br><br>Could Not Create User!" . mysqli_error($conn);
		}
	}
}

/*
* Function returns prints all of the users to the screen
* @param (conn) the connection object
*/
function getAllUsers($conn){
	$sqlGetAllUsers = "SELECT * FROM users";
	$result = $conn->query($sqlGetAllUsers);

	if($result->num_rows > 0) {
		echo "Results Found: " . $result->num_rows . "<br> <hr>";

		while($row = $result->fetch_assoc()) {
			echo "ID: " . $row['userID'] . " <br>   Username: " . $row['username'] . " <br>   Password: " . $row['password'] . " <hr>";
		}
	} else {
		echo "0 Results";
	}
	endConnection($conn);
}



function deleteUserByID($id, $conn){
	$sqlDeleteByID = "DELETE FROM users WHERE user_id = '$id' ";

	if(mysqli_query($conn, $sqlDeleteByID)) {
			echo "Deleted User ";
	} else {
		echo "<br><br>Could Not Delete User!" . mysqli_error($conn);
	}

	endConnection($conn);
}


function getSCByID($id ,$conn){
	$sqlSearchSCBYID = "SELECT * FROM sub_contractors WHERE id = '$id'";
	$result = $conn->query($sqlSearchSCBYID);
	if($result->num_rows > 0) {
		saveContractorToSession($result);
		header('Location: ' . "../editContractor");
	} else {
		header('Location: ' . "../subcontractors");
	}
}


function userLogin($username, $password, $conn){
	$sqlLogin = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$result = $conn->query($sqlLogin);
    echo "here";
	if($result->num_rows > 0) {
		saveToSession($result);
		$user = unserialize($_SESSION['user']);
		$id = intval($user->userID);
		$times =  $user->times;
		$times = intval($times);
		$times = $times + 1;

		$sqlUpdateSC = "UPDATE users SET timesUsed=$times  WHERE id = $id ";

		if ($conn->query($sqlUpdateSC) === TRUE) {
		} else {
			echo "Error updating record: " . mysqli_error($conn);
		}

		header('Location: ' . "../userpage.php");
	} else {
		$_SESSION["failed"] = "true";
		header('Location: ' . "../");
	}
	endConnection($conn);
}

function logoutUser($conn){
	$conn->close();
	session_unset();
	session_destroy();
	header('Location: ' . "../");
}


/*
* Function takes in the connection object and
* closes the connection
* @param (conn) the connection object to close
*/
function endConnection($conn) {
	$conn->close();
}



function saveToSession($result){
	session_unset();
	while($row = $result->fetch_assoc()) {
	    $user = new User();
	    $user->fName = $row['fname'];
	    $user->lName = $row['lname'];
	    $user->userID = $row['id'];
	    $user->username = $row['username'];
	    $user->password = $row['password'];
	    $user->times = $row['timesUsed'];
	    $user->PDF = $row['pdfs'];
	    $_SESSION['user'] = serialize($user);
	}
}