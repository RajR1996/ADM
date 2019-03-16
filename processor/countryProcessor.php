<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['CountryName'])) {
		$CountryName = $_POST['CountryName'];
	}
	if(isset($_POST['Gross'])){
		$Gross = $_POST['Gross'];
	}

	$Count = 0;

	$valid = oci_parse($conn, "SELECT COUNTRYNAME FROM COUNTRY WHERE COUNTRYNAME = :CountryName");

	oci_bind_by_name($valid, ":CountryName", $CountryName);
	oci_execute($valid);
	$Count = oci_fetch_all($valid, $res);
	oci_free_statement($valid);

	if($Count < 1){

		$stmt = oci_parse($conn, "INSERT INTO COUNTRY (COUNTRYNAME, GDP) VALUES (:CountryName, :GDP)");

		oci_bind_by_name($stmt, ":CountryName", $CountryName);
		oci_bind_by_name($stmt, ":GDP", $Gross);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);

		// echo $Gross;
		// echo $CountryName;
		if($Affected > 0){
			header("Location: ../viewCountries.php?Success=$CountryName has been created!");
		} else {
			header("Location: ../viewCountries.php?Danger=$CountryName hasn't been created!");
		}

	}	else {
		header("Location: ../viewCountries.php?Danger=$CountryName already exists!");
	}

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['CountryName'])) {
		$CountryName = $_POST['CountryName'];
	}
	if(isset($_POST['Gross'])){
		$Gross = $_POST['Gross'];
	}


	$stmt = oci_parse($conn, "UPDATE COUNTRY SET COUNTRYNAME = :CountryName, GDP = :GDP WHERE COUNTRYID = :CountryID");

	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":CountryName", $CountryName);
	oci_bind_by_name($stmt, ":GDP", $Gross);

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
		header("Location: ../viewCountries.php?Success=$CountryName has been updated!");
	} else {
		header("Location: ../viewCountries.php?Danger=$CountryName hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['CountryID'])) {

		$CountryID = $_GET['CountryID'];

		$stmt = oci_parse($conn, "DELETE FROM COUNTRY WHERE COUNTRYID = :CountryID");

		ocibindbyname($stmt, ":CountryID", $CountryID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);

		if($Affected > 0){
			header("Location: ../viewCountries.php?Success=Country has been deleted!");
		}	else {
			header("Location: ../viewCountries.php?Danger=Country hasn't been deleted!");
		}
	}

}
?>