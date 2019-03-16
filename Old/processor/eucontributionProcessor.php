<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['ContributionDescription'])){
		$ContributionDescription = $_POST['ContributionDescription'];
	}
	if(isset($_POST['BudgetDetails'])){
		$BudgetDetails = $_POST['BudgetDetails'];
	}

	$stmt = oci_parse($conn, "INSERT INTO EUCONTRIBUTION (COUNTRYID, CONTRIBUTIONDESCRIPTION, BUDGETDETAILS) VALUES (:CountryID, :ContributionDescription, :BudgetDetails)");

	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":ContributionDescription", $ContributionDescription);
	oci_bind_by_name($stmt, ":BudgetDetails", $BudgetDetails);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if(count($Affected) > 0){
		header("Location: ../viewEUContributions.php?Success=EU Contribution has been created!");
	} else {
		header("Location: ../viewEUContributions.php?Danger=EU Contribution hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['ContributionID'])) {
		$ContributionID = $_POST['ContributionID'];
	}
	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['ContributionDescription'])){
		$ContributionDescription = $_POST['ContributionDescription'];
	}
	if(isset($_POST['BudgetDetails'])){
		$BudgetDetails = $_POST['BudgetDetails'];
	}

	$stmt = oci_parse($conn, "UPDATE EUCONTRIBUTION SET COUNTRYID = :CountryID, CONTRIBUTIONDESCRIPTION = :ContributionDescription, BUDGETDETAILS = :BudgetDetails WHERE CONTRIBUTIONID = :ContributionID");

	oci_bind_by_name($stmt, ":ContributionID", $ContributionID);
	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":ContributionDescription", $ContributionDescription);
	oci_bind_by_name($stmt, ":BudgetDetails", $BudgetDetails);

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
		header("Location: ../viewEUContributions.php?Success=EU Contribution has been updated!");
	} else {
		header("Location: ../viewEUContributions.php?Danger=EU Contribution hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['ContributionID'])) {

		$ContributionID = $_GET['ContributionID'];

		$stmt = oci_parse($conn, "DELETE FROM EUCONTRIBUTION WHERE CONTRIBUTIONID = :ContributionID");

		ocibindbyname($stmt, ":ContributionID", $ContributionID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if(count($Affected) > 0){
			header("Location: ../viewEUContributions.php?Success=EU Contribution has been deleted!");
		}	else {
			header("Location: ../viewEUContributions.php?Danger=EU Contribution hasn't been deleted!");
		}
	}

}
?>