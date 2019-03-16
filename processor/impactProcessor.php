<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['ImpactDescription'])) {
		$ImpactDescription = $_POST['ImpactDescription'];
	}

	$stmt = oci_parse($conn, "INSERT INTO IMPACT (IMPACTDESCRIPTION) VALUES (:ImpactDescription)");

	oci_bind_by_name($stmt, ":ImpactDescription", $ImpactDescription);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $ImpactDescription;

	if($Affected > 0){
		header("Location: ../viewImpacts.php?Success=Impact has been created!");
	} else {
		header("Location: ../viewImpacts.php?Danger=Impact hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['ImpactID'])) {
		$ImpactID = $_POST['ImpactID'];
	}
	if(isset($_POST['ImpactDescription'])) {
		$ImpactDescription = $_POST['ImpactDescription'];
	}

	$stmt = oci_parse($conn, "UPDATE IMPACT SET IMPACTDESCRIPTION = :ImpactDescription WHERE IMPACTID = :ImpactID");

	oci_bind_by_name($stmt, ":ImpactID", $ImpactID);
	oci_bind_by_name($stmt, ":ImpactDescription", $ImpactDescription);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);
	
	// echo "ImpactID" . ' ' . $ImpactID . "<br>";
	// echo "ImpactDescription" . ' ' . $ImpactDescription . "<br>";
	// echo "Rows Affected" . ' ' . $Affected;

	if($Affected > 0){
		header("Location: ../viewImpacts.php?Success=Impact has been updated!");
	} else {
		header("Location: ../viewImpacts.php?Danger=Impact hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['ImpactID'])) {

		$ImpactID = $_GET['ImpactID'];

		$stmt = oci_parse($conn, "DELETE FROM IMPACT WHERE IMPACTID = :ImpactID");

		ocibindbyname($stmt, ":ImpactID", $ImpactID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if($Affected > 0){
			header("Location: ../viewImpacts.php?Success=Impact has been deleted!");
		}	else {
			header("Location: ../viewImpacts.php?Danger=Impact hasn't been deleted!");
		}
	}

}
?>