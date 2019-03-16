<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['ChangesDescription'])){
		$ChangesDescription = $_POST['ChangesDescription'];
	}
	if(isset($_POST['NegotiatedDeal'])){
		$NegotiatedDeal = $_POST['NegotiatedDeal'];
	}
	if(isset($_POST['BusinessImpact'])){
		$BusinessImpact = $_POST['BusinessImpact'];
	}

	$stmt = oci_parse($conn, "INSERT INTO CHANGESMODEL (EVENTID, CHANGESDESCRIPTION, NEGOTIATEDDEAL, BUSINESSIMPACT) VALUES (:EventID, :ChangesDescription, :NegotiatedDeal, :BusinessImpact)");

	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":ChangesDescription", $ChangesDescription);
	oci_bind_by_name($stmt, ":NegotiatedDeal", $NegotiatedDeal);
	oci_bind_by_name($stmt, ":BusinessImpact", $BusinessImpact);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if(count($Affected) > 0){
		header("Location: ../viewChangesModels.php?Success=Changes Model has been created!");
	} else {
		header("Location: ../viewChangesModels.php?Danger=Changes Model hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['ModelID'])) {
		$ModelID = $_POST['ModelID'];
	}
	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['ChangesDescription'])){
		$ChangesDescription = $_POST['ChangesDescription'];
	}
	if(isset($_POST['NegotiatedDeal'])){
		$NegotiatedDeal = $_POST['NegotiatedDeal'];
	}
	if(isset($_POST['BusinessImpact'])){
		$BusinessImpact = $_POST['BusinessImpact'];
	}

	$stmt = oci_parse($conn, "UPDATE CHANGESMODEL SET EVENTID = :EventID, CHANGESDESCRIPTION = :ChangesDescription, NEGOTIATEDDEAL = :NegotiatedDeal, BUSINESSIMPACT = :BusinessImpact WHERE MODELID = :ModelID");

	oci_bind_by_name($stmt, ":ModelID", $ModelID);
	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":ChangesDescription", $ChangesDescription);
	oci_bind_by_name($stmt, ":NegotiatedDeal", $NegotiatedDeal);
	oci_bind_by_name($stmt, ":BusinessImpact", $BusinessImpact);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);
	
	// echo "LawID" . ' ' . $LawID . "<br>";
	// echo "CountryID" . ' ' . $CountryID . "<br>";
	// echo "LawDetails" . ' ' . $LawDetails . "<br>";
	// echo "Rows Affected" . ' ' . $Affected;

	if(count($Affected) > 0){
		header("Location: ../viewChangesModels.php?Success=Changes Model has been updated!");
	} else {
		header("Location: ../viewChangesModels.php?Danger=Changes Model hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['ModelID'])) {

		$ModelID = $_GET['ModelID'];

		$stmt = oci_parse($conn, "DELETE FROM CHANGESMODEL WHERE MODELID = :ModelID");

		ocibindbyname($stmt, ":ModelID", $ModelID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if(count($Affected) > 0){
			header("Location: ../viewChangesModels.php?Success=Changes Model has been deleted!");
		}	else {
			header("Location: ../viewChangesModels.php?Danger=Changes Model hasn't been deleted!");
		}
	}

}
?>