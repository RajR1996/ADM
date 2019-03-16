<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['LawDetails'])){
		$LawDetails = $_POST['LawDetails'];
	}

	$stmt = oci_parse($conn, "INSERT INTO EULAWS (COUNTRYID, LAWDETAILS) VALUES (:CountryID, :LawDetails)");

	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":LawDetails", $LawDetails);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if($Affected > 0){
		header("Location: ../viewEULaws.php?Success=Law has been created!");
	} else {
		header("Location: ../viewEULaws.php?Danger=Law hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['LawID'])) {
		$LawID = $_POST['LawID'];
	}
	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['LawDetails'])){
		$LawDetails = $_POST['LawDetails'];
	}

	$stmt = oci_parse($conn, "UPDATE EULAWS SET COUNTRYID = :CountryID, LAWDETAILS = :LawDetails WHERE LAWID = :LawID");

	oci_bind_by_name($stmt, ":LawID", $LawID);
	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":LawDetails", $LawDetails);

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
		header("Location: ../viewEULaws.php?Success=Law has been updated!");
	} else {
		header("Location: ../viewEULaws.php?Danger=Law hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['LawID'])) {

		$LawID = $_GET['LawID'];

		$stmt = oci_parse($conn, "DELETE FROM EULAWS WHERE LAWID = :LawID");

		ocibindbyname($stmt, ":LawID", $LawID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if($Affected > 0){
			header("Location: ../viewEULaws.php?Success=Law has been deleted!");
		}	else {
			header("Location: ../viewEULaws.php?Danger=Law hasn't been deleted!");
		}
	}

}
?>