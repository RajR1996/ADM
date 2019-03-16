<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['ImmigrationDescription'])){
		$ImmigrationDescription = $_POST['ImmigrationDescription'];
	}
	if(isset($_POST['ImmigrationStatistics'])){
		$ImmigrationStatistics = $_POST['ImmigrationStatistics'];
	}

	$stmt = oci_parse($conn, "INSERT INTO IMMIGRATION (COUNTRYID, EVENTID, IMMIGRATIONDESCRIPTION, IMMIGRATIONSTATISTICS) VALUES (:CountryID, :EventID, :ImmigrationDescription, :ImmigrationStatistics)");

	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":ImmigrationDescription", $ImmigrationDescription);
	oci_bind_by_name($stmt, ":ImmigrationStatistics", $ImmigrationStatistics);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if(count($Affected) > 0){
		header("Location: ../viewImmigrations.php?Success=Taxation has been created!");
	} else {
		header("Location: ../viewImmigrations.php?Danger=Taxation hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['ImmigrationID'])) {
		$ImmigrationID = $_POST['ImmigrationID'];
	}
	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['ImmigrationDescription'])){
		$ImmigrationDescription = $_POST['ImmigrationDescription'];
	}
	if(isset($_POST['ImmigrationStatistics'])){
		$ImmigrationStatistics = $_POST['ImmigrationStatistics'];
	}

	$stmt = oci_parse($conn, "UPDATE IMMIGRATION SET COUNTRYID = :CountryID, EVENTID = :EventID, IMMIGRATIONDESCRIPTION = :ImmigrationDescription, IMMIGRATIONSTATISTICS = :ImmigrationStatistics WHERE IMMIGRATIONID = :ImmigrationID");

	oci_bind_by_name($stmt, ":ImmigrationID", $ImmigrationID);
	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":ImmigrationDescription", $ImmigrationDescription);
	oci_bind_by_name($stmt, ":ImmigrationStatistics", $ImmigrationStatistics);

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
		header("Location: ../viewImmigrations.php?Success=Taxation has been updated!");
	} else {
		header("Location: ../viewImmigrations.php?Danger=Taxation hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['ImmigrationID'])) {

		$ImmigrationID = $_GET['ImmigrationID'];

		$stmt = oci_parse($conn, "DELETE FROM IMMIGRATION WHERE IMMIGRATIONID = :ImmigrationID");

		ocibindbyname($stmt, ":ImmigrationID", $ImmigrationID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if(count($Affected) > 0){
			header("Location: ../viewImmigrations.php?Success=Taxation has been deleted!");
		}	else {
			header("Location: ../viewImmigrations.php?Danger=Taxation hasn't been deleted!");
		}
	}

}
?>