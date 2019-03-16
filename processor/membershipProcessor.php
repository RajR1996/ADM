<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['AreaID'])) {
		$AreaID = $_POST['AreaID'];
	}

	$Count = 0;
	
	$valid = oci_parse($conn, "SELECT * FROM MEMBERSHIP WHERE COUNTRYID = :CountryID AND AREAID = :AreaID");

	oci_bind_by_name($valid, ":CountryID", $CountryID);
	oci_bind_by_name($valid, ":AreaID", $AreaID);
	oci_execute($valid);
	$Count = oci_fetch_all($valid, $res);
	oci_free_statement($valid);

	if($Count < 1){

		$stmt = oci_parse($conn, "INSERT INTO MEMBERSHIP (COUNTRYID, AREAID) VALUES (:CountryID, :AreaID)");

		oci_bind_by_name($stmt, ":CountryID", $CountryID);
		oci_bind_by_name($stmt, ":AreaID", $AreaID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);


		// echo $ImpactID;

		if($Affected > 0){
			header("Location: ../viewMemberships.php?Success=Membership has been created!");
		} else {
			header("Location: ../viewMemberships.php?Danger=Membership hasn't been created!");
		}
		
	}	else {
		header("Location: ../viewMemberships.php?Danger=Membership already exists!");
	}

// Delete
} else {

	if(isset($_GET['AreaID'])) {

		$CountryID = $_GET['CountryID'];
		$AreaID = $_GET['AreaID'];

		$stmt = oci_parse($conn, "DELETE FROM MEMBERSHIP WHERE COUNTRYID = :CountryID AND AREAID = :AreaID");

		ocibindbyname($stmt, ":CountryID", $CountryID);
		ocibindbyname($stmt, ":AreaID", $AreaID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if($Affected > 0){
			header("Location: ../viewMemberships.php?Success=Membership has been deleted!");
		}	else {
			header("Location: ../viewMemberships.php?Danger=Membership hasn't been deleted!");
		}
	}

}
?>