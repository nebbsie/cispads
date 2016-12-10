<?php 
session_start();
include "connect.php";


checkPOSTMethod($conn);


/*
* Function that controlls the POST method
* @param (conn) the connection object
*/
function checkPOSTMethod($conn){
	if (isset ($_POST['edit-sc'])) {
		getSCByID($_POST['edit-sc-id'], $conn);
	} else if(isset($_POST['sc-edit-submit'])){
		updateContractor($_POST['sc-id'], $_POST['sc-name'], $_POST['sc-taxRef'], $_POST['sc-verNumber'], $_POST['sc-taxTreatment'], $_POST['sc-email'], $conn);
	} else if(isset($_POST['sc-delete-submit'])){
		deleteUserByID($_POST['sc-id'], $conn);
	}	else if(isset($_POST['view-sub_contractors'])){
		getAllSubContractors($conn);
	} else if(isset($_POST['add-sub_contractors'])){
		header('Location: ' . "../addSC.php");
	} else if(isset($_POST['sc-add-submit'])){
		addNewSC( $_POST['sc-name'], $_POST['sc-taxRef'], $_POST['sc-verNumber'], $_POST['sc-taxTreatment'], $_POST['sc-email'], $conn);
	} else if(isset($_POST['create-pad'])){
		console.log("Helo");
		getAllSubContractorsNoLink($conn);
		header('Location: ' . "../createPAD.php");
	}
}

function getSCByID($id ,$conn){

	$sqlSearchSCBYID = "SELECT * FROM sub_contractors WHERE id = '$id'";
	$result = $conn->query($sqlSearchSCBYID);
	if($result->num_rows > 0) {
		saveContractorToSession($result);
		header('Location: ' . "../editContractor.php");
	} else {
		echo "User Not Found"; 
		header('Location: ' . "../subcontractors.php");
	}
	
	endConnection($conn);
}

function addNewSC($name, $taxRef, $verNumber ,$taxTreatment, $email, $conn){
	
	$id = intval($_SESSION['user-id']);

	$sqlCreateUser = "INSERT INTO sub_contractors (userID, name, taxRef, verNumber, taxTreatment, email)
		VALUES ($id,'$name' , '$taxRef', '$verNumber', '$taxTreatment', '$email')";

	if(mysqli_query($conn, $sqlCreateUser)) {
		$_SESSION["sc-add-fail"] = "false";
	} else {
		$_SESSION["sc-delete-fail"] = "true";
	}

	header('Location: ' . "../userpage.php");
}


function getAllSubContractors($conn){
	$id = intval($_SESSION['user-id']);
	$sqlGetAllSC = "SELECT * FROM sub_contractors WHERE userID = $id";
	$result = $conn->query($sqlGetAllSC);

	$array = array();

	if($result->num_rows > 0) {
		echo "Results Found: " . $result->num_rows . "<br> <hr>";

		while($row = $result->fetch_assoc()) {
			$array[] = $row;
		}

		$_SESSION["result"] = $array;

		header('Location: ' . "../subcontractors.php");
		
	} else {
		header('Location: ' . "../subcontractors.php");
	}
	endConnection($conn);
}

function getAllSubContractorsNoLink($conn){
	$id = intval($_SESSION['user-id']);
	$sqlGetAllSC = "SELECT * FROM sub_contractors WHERE userID = $id";
	$result = $conn->query($sqlGetAllSC);

	$array = array();

	if($result->num_rows > 0) {
		echo "Results Found: " . $result->num_rows . "<br> <hr>";

		while($row = $result->fetch_assoc()) {
			$array[] = $row;
		}

		$_SESSION["result"] = $array;

		return;
		
	} else {
		echo "0 Results";
	}
	endConnection($conn);
}

function updateContractor($id, $name, $taxRef, $verNumber ,$taxTreatment, $email, $conn){
	$id2 = intval($_SESSION['user-id']);
	$sqlUpdateSC = "UPDATE sub_contractors SET name='$name', taxRef='$taxRef', verNumber='$verNumber', taxTreatment='$taxTreatment', email='$email'  WHERE id = $id ";
	if ($conn->query($sqlUpdateSC) === TRUE) {
		$_SESSION["sc-edit-fail"] = "false";
	} else {
		$_SESSION["sc-edit-fail"] = "true";
		echo "Error updating record: " . mysqli_error($conn);
	}

	header('Location: ' . "../userpage.php");

	endConnection($conn);
}

function deleteUserByID($id, $conn){
	$sqlDeleteByID = "DELETE FROM sub_contractors WHERE id = '$id' ";

	if(mysqli_query($conn, $sqlDeleteByID)) {
		$_SESSION["sc-delete-fail"] = "false";
	} else {
		$_SESSION["sc-delete-fail"] = "true";
	}

	header('Location: ' . "../userpage.php");

	endConnection($conn);
}


function saveContractorToSession($result){
	while($row = $result->fetch_assoc()) {
			$_SESSION["sc-id"] = $row['id'];
			$_SESSION["sc-name"] = $row['name'];
			$_SESSION["sc-verNumber"] = $row['verNumber'];
			$_SESSION["sc-taxRef"] = $row['taxRef'];
			$_SESSION["sc-taxTreatment"] = $row['taxTreatment'];
			$_SESSION["sc-email"] = $row['email'];
	}
}


?>