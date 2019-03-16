<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['MPFName'])) {
		$MPFName = $_POST['MPFName'];
	}
	if(isset($_POST['MPLName'])){
		$MPLName = $_POST['MPLName'];
	}
	if(isset($_POST['MPParty'])) {
		$MPParty = $_POST['MPParty'];
	}
	if(isset($_POST['MPLocation'])){
		$MPLocation = $_POST['MPLocation'];
	}

	$stmt = oci_parse($conn, "INSERT INTO MPS (EVENTID, COUNTRYID, MPFNAME, MPLNAME, MPPARTY, MPLOCATION) VALUES (:EventID, :CountryID, :MPFName, :MPLName, :MPParty, :MPLocation)");

	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":MPFName", $MPFName);
	oci_bind_by_name($stmt, ":MPLName", $MPLName);
	oci_bind_by_name($stmt, ":MPParty", $MPParty);
	oci_bind_by_name($stmt, ":MPLocation", $MPLocation);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);

	// echo $Gross;
	// echo $CountryName;
	if($Affected > 0){
		header("Location: ../viewMPs.php?Success=$MPFName $MPLName has been created!");
	} else {
		//$err = OCIError();
    // echo "Oracle Connect Error " . $err[text];
		header("Location: ../viewMPs.php?Danger=$MPFName $MPLName hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['MPID'])) {
		$MPID = $_POST['MPID'];
	}
	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['MPFName'])) {
		$MPFName = $_POST['MPFName'];
	}
	if(isset($_POST['MPLName'])){
		$MPLName = $_POST['MPLName'];
	}
	if(isset($_POST['MPParty'])) {
		$MPParty = $_POST['MPParty'];
	}
	if(isset($_POST['MPLocation'])){
		$MPLocation = $_POST['MPLocation'];
	}

	$stmt = oci_parse($conn, "UPDATE MPS SET EVENTID = :EventID, COUNTRYID = :CountryID, MPFNAME = :MPFName, MPLNAME = :MPLName, MPPARTY = :MPParty, MPLOCATION = :MPLocation WHERE MPID = :MPID");

	oci_bind_by_name($stmt, ":MPID", $MPID);	
	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":MPFName", $MPFName);
	oci_bind_by_name($stmt, ":MPLName", $MPLName);
	oci_bind_by_name($stmt, ":MPParty", $MPParty);
	oci_bind_by_name($stmt, ":MPLocation", $MPLocation);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);
	
	// echo "CountryID" . ' ' . $CountryID . "<br>";
	// echo "GDP" . ' ' . $Gross . "<br>";
	// echo "Country Name" . ' ' . $CountryName . "<br>";
	// echo "Rows Affected" . ' ' . $Affected;

	if($Affected > 0){
		header("Location: ../viewMPs.php?Success=$MPFName $MPLName has been updated!");
	} else {
		header("Location: ../viewMPs.php?Danger=$MPFName $MPLName hasn't been updated!");
	}

} else {

	// Delete
	if(isset($_GET['MPID'])) {

		$MPID = $_GET['MPID'];

		$stmt = oci_parse($conn, "DELETE FROM MPS WHERE MPID = :MPID");

		ocibindbyname($stmt, ":MPID", $MPID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		
		if($Affected > 0){
			header("Location: ../viewMPs.php?Success=MP has been deleted!");
		}	else {
			header("Location: ../viewMPs.php?Danger=MP hasn't been deleted!");
		}
	}

}
?>