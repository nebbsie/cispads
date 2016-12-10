<?php 
session_start();
include "connect.php";


checkPOSTMethod($conn);


/*
* Function that controlls the POST method
* @param (conn) the connection object
*/
function checkPOSTMethod($conn){
	if (isset ($_POST['create-pad'])) {
		createPad($conn, $_POST['sc-id-pad'], $_POST['date-pad'], $_POST['gross-amount-pad'],
		 $_POST['material-cost-pad']);
	}
	if (isset ($_POST['view-pad'])) {
		getAllPads($conn);
		header('Location: ' . "../allPads.php");
	}

	if (isset ($_POST['view-pad-single'])) {
		getPADByID($_POST['view-pad-id'], $conn);	
	}
}


function getPADByID($id ,$conn){

	$sqlSearchSCBYID = "SELECT * FROM pad WHERE id = '$id'";
	$result = $conn->query($sqlSearchSCBYID);
	if($result->num_rows > 0) {
		savePadToSession($result, $conn);
		header('Location: ' . "../padViewer.php");
	} else {
		echo "User Not Found"; 
	}
	
	endConnection($conn);
}


function getAllPads($conn){
	$id = $_SESSION["user-id"];
	if($id == 0){
		$sqlgetAllPads = "SELECT * FROM pad";
	}else{
		$sqlgetAllPads = "SELECT * FROM pad WHERE userID = $id";
	}
	
	$result = $conn->query($sqlgetAllPads);

		$array = array();

	if($result->num_rows > 0) {
		echo "Results Found: " . $result->num_rows . "<br> <hr>";

		while($row = $result->fetch_assoc()) {
			$array[] = $row;
		}

		$_SESSION["result-pads"] = $array;

		return;		
	} else {
		echo "0 Results";
		return;	
	}
	endConnection($conn);
}


function createPad($conn, $id, $date, $gross, $materials){
	getSCByID($id, $conn);

	// Getting the is higher parameter
	$isHigher = 0;
	$isGross = 0;
	$isStandard = 0;

	if($_SESSION["pad-taxTreatment"] == "Higher"){
		$isHigher = 1;
	}

	if($_SESSION["pad-taxTreatment"] == "Standard"){
		$isStandard = 1;
	}

	if($_SESSION["pad-taxTreatment"] == "Gross"){
		$isGross = 1;
	}


	
	$grossCost = intval($gross);
	$materialsCost = intval($materials);


	$amountLiable = $grossCost - $materialsCost;
	$amountDeducted = 0;

	$dateSplit = DateTime::createFromFormat("Y-m-d", $date);

 	$day = $dateSplit->format("d");
 	$month = $dateSplit->format("m");
 	$year = $dateSplit->format("y");


 	

	if($isHigher == 1){
		$amountDeducted = $amountLiable * 0.4;	
	}

	if($isStandard == 1){
		$amountDeducted = $amountLiable * 0.2;	
	}

	$amountDeducted = floor($amountDeducted);
	$amountPayable = $grossCost - $amountDeducted;



// CONVERTING TO INTS
    $sendID = intval($id);
	$day = intval($day);
 	$month = intval($month);
 	$year = intval($year);

 	$day = sprintf("%02d", $day);
 	$month = sprintf("%02d", $month);


 	$amountDeducted = intval($amountDeducted);
 	$amountPayable = intval($amountPayable);
 	$isHigher = intval($isHigher);
 	$email = $_SESSION["pad-email"];


	echo "ID: " . " " . $sendID . "<br>";
	echo "DAY: " . " " . $day . "<br>";
	echo "MONTH: " . " " . $month . "<br>";
	echo "YEAR: " . " " . $year . "<br>";
	echo "GROSS: " . " " . $grossCost . "<br>";
	echo "MATERIALS: " . " " . $materialsCost . "<br>";
	echo "Liable: " . " " . $amountLiable . "<br>";
	echo "Deducted: " . " " . $amountDeducted . "<br>";
	echo "Payable: " . " " . $amountPayable . "<br>";
	echo "Higher Rate: " . " " . $isHigher . "<br>";
	echo "Email: ". $email;

	$name = $_SESSION['pad-name'];
	$userID = $_SESSION["user-id"];

	$sqlCreatePad = "
	INSERT INTO pad
	(userID,name,subID, day, month, year, grossCost, materialsCost, amountLiable, amountDeducted, amountPayable, higherRate, email)
	VALUES 
	($userID, '$name',$sendID, $day, $month, $year, $grossCost, $materialsCost, $amountLiable, $amountDeducted, $amountPayable, $isHigher, '$email')";

	if ($conn->query($sqlCreatePad) === TRUE) {
    	echo "New record created successfully";
    	$_SESSION["pad-view-name"] = $_SESSION['pad-name'] ;
    	$_SESSION["pad-view-taxRef"] = $_SESSION['pad-taxRef'] ;
    	$_SESSION["pad-view-verNumber"] = $_SESSION['pad-verNumber'] ;
    	$_SESSION["pad-sendID"] = $sendID;
    	$_SESSION["pad-day"] = $day;
    	$_SESSION["pad-month"] = $month;
    	$_SESSION["pad-year"] = $year;
		$_SESSION["pad-materials"] = $materialsCost;
    	$_SESSION["pad-gross"] = $grossCost;
    	$_SESSION["pad-liable"] = $amountLiable;
    	$_SESSION["pad-deducted"] = $amountDeducted;
    	$_SESSION["pad-payable"] = $amountPayable;
    	$_SESSION["pad-isHigher"] = $isHigher;
    	$_SESSION["pad-email"] = $email;

    	header('Location: ' . "../padViewer.php");
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function getSCByID($id ,$conn){
	$sqlSearchSCBYID = "SELECT * FROM sub_contractors WHERE id = '$id'";
	$result = $conn->query($sqlSearchSCBYID);
	if($result->num_rows > 0) {
		saveContractorToSession($result);
		return;
	} else {
		echo "User Not Found"; 
	}
	
	endConnection($conn);
}

function savePadToSession($result, $conn){

    	while($row = $result->fetch_assoc()) {

    		$_SESSION["pad-view-name"] = $row['name'];
    		$_SESSION["pad-day"] = $row['day'];
    		$_SESSION["pad-month"] = $row['month'];
    		$_SESSION["pad-year"] = $row['year'];
    		$_SESSION["pad-materials"] = $row['materialsCost'];
    		$_SESSION["pad-sendID"] = $row['subID'];
       		$_SESSION["pad-gross"] = $row['grossCost'];
    		$_SESSION["pad-liable"] = $row['amountLiable'];
    		$_SESSION["pad-deducted"] = $row['amountDeducted'];
    		$_SESSION["pad-payable"] = $row['amountPayable'];
    		$_SESSION["pad-isHigher"] = $row['higherRate'];
    		$_SESSION["pad-email"] = $row['email'];


    		getSCByID($_SESSION["pad-sendID"], $conn);

    		$_SESSION["pad-view-verNumber"] = $_SESSION['pad-verNumber'] ;
    		$_SESSION["pad-view-taxRef"] = $_SESSION['pad-taxRef'] ;
    	}

    	return;
}

function saveContractorToSession($result){
	while($row = $result->fetch_assoc()) {
			$_SESSION["pad-id"] = $row['id'];
			$_SESSION["pad-name"] = $row['name'];
			$_SESSION["pad-verNumber"] = $row['verNumber'];
			$_SESSION["pad-taxRef"] = $row['taxRef'];
			$_SESSION["pad-taxTreatment"] = $row['taxTreatment'];
			$_SESSION["pad-email"] = $row['email'];
	}

	return;

}

?>