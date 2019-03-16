<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['ImpactID'])) {
		$ImpactID = $_POST['ImpactID'];
	}
	if(isset($_POST['AreaID'])) {
		$AreaID = $_POST['AreaID'];
	}

	$stmt = oci_parse($conn, "INSERT INTO OUTOUTCOME (IMPACTID, AREAID) VALUES (:ImpactID, :AreaID)");

	oci_bind_by_name($stmt, ":ImpactID", $ImpactID);
	oci_bind_by_name($stmt, ":AreaID", $AreaID);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $ImpactID;

	if(count($Affected) > 0){
		header("Location: ../viewOutOutcomes.php?Success=Out Outcome has been created!");
	} else {
		header("Location: ../viewOutOutcomes.php?Danger=Out Outcome hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['OutcomeID'])) {
		$OutcomeID = $_POST['OutcomeID'];
	}
	if(isset($_POST['ImpactID'])) {
		$ImpactID = $_POST['ImpactID'];
	}
	if(isset($_POST['AreaID'])) {
		$AreaID = $_POST['AreaID'];
	}

	$stmt = oci_parse($conn, "UPDATE OUTOUTCOME SET IMPACTID = :ImpactID, AREAID = :AreaID WHERE OUTCOMEID = :OutcomeID");

	oci_bind_by_name($stmt, ":OutcomeID", $OutcomeID);
	oci_bind_by_name($stmt, ":ImpactID", $ImpactID);
	oci_bind_by_name($stmt, ":AreaID", $AreaID);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);
	
	// echo "OutcomeID" . ' ' . $OutcomeID . "<br>";
	// echo "ImpactDescription" . ' ' . $ImpactDescription . "<br>";
	// echo "Rows Affected" . ' ' . $Affected;

	if(count($Affected) > 0){
		header("Location: ../viewOutOutcomes.php?Success=Out Outcome has been updated!");
	} else {
		header("Location: ../viewOutOutcomes.php?Danger=Out Outcome hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['OutcomeID'])) {

		$OutcomeID = $_GET['OutcomeID'];

		$stmt = oci_parse($conn, "DELETE FROM OUTOUTCOME WHERE OUTCOMEID = :OutcomeID");

		ocibindbyname($stmt, ":OutcomeID", $OutcomeID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if(count($Affected) > 0){
			header("Location: ../viewOutOutcomes.php?Success=Out Outcome has been deleted!");
		}	else {
			header("Location: ../viewOutOutcomes.php?Danger=Out Outcome hasn't been deleted!");
		}
	}

}
?>