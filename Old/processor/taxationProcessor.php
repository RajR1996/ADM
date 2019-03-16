<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['TaxDescription'])){
		$TaxDescription = $_POST['TaxDescription'];
	}
	if(isset($_POST['TaxValue'])){
		$TaxValue = $_POST['TaxValue'];
	}

	$stmt = oci_parse($conn, "INSERT INTO TAXATION (EVENTID, TAXDESCRIPTION, TAXVALUE) VALUES (:EventID, :TaxDescription, :TaxValue)");

	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":TaxDescription", $TaxDescription);
	oci_bind_by_name($stmt, ":TaxValue", $TaxValue);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if(count($Affected) > 0){
		header("Location: ../viewTaxations.php?Success=Taxation has been created!");
	} else {
		header("Location: ../viewTaxations.php?Danger=Taxation hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['TaxID'])) {
		$TaxID = $_POST['TaxID'];
	}
	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['TaxDescription'])){
		$TaxDescription = $_POST['TaxDescription'];
	}
	if(isset($_POST['TaxValue'])){
		$TaxValue = $_POST['TaxValue'];
	}

	$stmt = oci_parse($conn, "UPDATE TAXATION SET EVENTID = :EventID, TAXDESCRIPTION = :TaxDescription, TAXVALUE = :TaxValue WHERE TAXID = :TaxID");

	oci_bind_by_name($stmt, ":TaxID", $TaxID);
	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":TaxDescription", $TaxDescription);
	oci_bind_by_name($stmt, ":TaxValue", $TaxValue);

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
		header("Location: ../viewTaxations.php?Success=Taxation has been updated!");
	} else {
		header("Location: ../viewTaxations.php?Danger=Taxation hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['TaxID'])) {

		$TaxID = $_GET['TaxID'];

		$stmt = oci_parse($conn, "DELETE FROM TAXATION WHERE TAXID = :TaxID");

		ocibindbyname($stmt, ":TaxID", $TaxID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if(count($Affected) > 0){
			header("Location: ../viewTaxations.php?Success=Taxation has been deleted!");
		}	else {
			header("Location: ../viewTaxations.php?Danger=Taxation hasn't been deleted!");
		}
	}

}
?>