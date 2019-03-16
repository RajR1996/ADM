<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['EventName'])){
		$EventName = $_POST['EventName'];
	}
	if(isset($_POST['EventDescription'])){
		$EventDescription = $_POST['EventDescription'];
	}
	if(isset($_POST['EventDate'])){
		$EventDate = date('d-M-y', strtotime($_POST['EventDate']));
	}

	$stmt = oci_parse($conn, "INSERT INTO KEYEVENTS (COUNTRYID, EVENTNAME, EVENTDESCRIPTION, EVENTDATE) VALUES (:CountryID, :EventName, :EventDescription, :EventDate)");

	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":EventName", $EventName);
	oci_bind_by_name($stmt, ":EventDescription", $EventDescription);
	oci_bind_by_name($stmt, ":EventDate", $EventDate);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if($Affected > 0){
		header("Location: ../viewKeyEvents.php?Success=Key Event has been created!");
	} else {
		header("Location: ../viewKeyEvents.php?Danger=Key Event hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['EventName'])){
		$EventName = $_POST['EventName'];
	}
	if(isset($_POST['EventDescription'])){
		$EventDescription = $_POST['EventDescription'];
	}
	if(isset($_POST['EventDate'])){
		$EventDate = date('d-M-y', strtotime($_POST['EventDate']));
	}
	$stmt = oci_parse($conn, "UPDATE KEYEVENTS SET COUNTRYID = :CountryID, EVENTNAME = :EventName, EVENTDESCRIPTION = :EventDescription, EVENTDATE = :EventDate WHERE EVENTID = :EventID");

	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":EventName", $EventName);
	oci_bind_by_name($stmt, ":EventDescription", $EventDescription);
	oci_bind_by_name($stmt, ":EventDate", $EventDate);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);
	
	// echo "LawID" . ' ' . $LawID . "<br>";
	// echo "CountryID" . ' ' . $CountryID . "<br>";
	// echo "LawDetails" . ' ' . $LawDetails . "<br>";
	// echo "Rows Affected" . ' ' . $Affected;

	if($Affected > 0){
		header("Location: ../viewKeyEvents.php?Success=Key Event has been updated!");
	} else {
		header("Location: ../viewKeyEvents.php?Danger=Key Event hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['EventID'])) {

		$EventID = $_GET['EventID'];

		$stmt = oci_parse($conn, "DELETE FROM KEYEVENTS WHERE EVENTID = :EventID");

		ocibindbyname($stmt, ":EventID", $EventID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if($Affected > 0){
			header("Location: ../viewKeyEvents.php?Success=Key Event has been deleted!");
		}	else {
			header("Location: ../viewKeyEvents.php?Danger=Key Event hasn't been deleted!");
		}
	}

}
?>