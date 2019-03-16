<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['EffectName'])){
		$EffectName = $_POST['EffectName'];
	}
	if(isset($_POST['EffectDescription'])){
		$EffectDescription = $_POST['EffectDescription'];
	}
	if(isset($_POST['EffectDuration'])){
		$EffectDuration = $_POST['EffectDuration'];
	}

	$stmt = oci_parse($conn, "INSERT INTO EFFECT (EVENTID, EFFECTNAME, EFFECTDESCRIPTION, EFFECTDURATION) VALUES (:EventID, :EffectName, :EffectDescription, :EffectDuration)");

	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":EffectName", $EffectName);
	oci_bind_by_name($stmt, ":EffectDescription", $EffectDescription);
	oci_bind_by_name($stmt, ":EffectDuration", $EffectDuration);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if(count($Affected) > 0){
		header("Location: ../viewEffects.php?Success=Effect has been created!");
	} else {
		header("Location: ../viewEffects.php?Danger=Effect hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['EffectID'])) {
		$EffectID = $_POST['EffectID'];
	}
	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['EffectName'])){
		$EffectName = $_POST['EffectName'];
	}
	if(isset($_POST['EffectDescription'])){
		$EffectDescription = $_POST['EffectDescription'];
	}
	if(isset($_POST['EffectDuration'])){
		$EffectDuration = $_POST['EffectDuration'];
	}

	$stmt = oci_parse($conn, "UPDATE EFFECT SET EVENTID = :EventID, EFFECTNAME = :EffectName, EFFECTDESCRIPTION = :EffectDescription, EFFECTDURATION = :EffectDuration WHERE EFFECTID = :EffectID");

	oci_bind_by_name($stmt, ":EffectID", $EffectID);
	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":EffectName", $EffectName);
	oci_bind_by_name($stmt, ":EffectDescription", $EffectDescription);
	oci_bind_by_name($stmt, ":EffectDuration", $EffectDuration);

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
		header("Location: ../viewEffects.php?Success=Effect has been updated!");
	} else {
		header("Location: ../viewEffects.php?Danger=Effect hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['EffectID'])) {

		$EffectID = $_GET['EffectID'];

		$stmt = oci_parse($conn, "DELETE FROM EFFECT WHERE EFFECTID = :EffectID");

		ocibindbyname($stmt, ":EffectID", $EffectID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if(count($Affected) > 0){
			header("Location: ../viewEffects.php?Success=Effect has been deleted!");
		}	else {
			header("Location: ../viewEffects.php?Danger=Effect hasn't been deleted!");
		}
	}

}
?>