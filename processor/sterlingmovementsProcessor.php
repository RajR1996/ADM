<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['SterlingDescription'])){
		$SterlingDescription = $_POST['SterlingDescription'];
	}
	if(isset($_POST['MarketValue'])){
		$MarketValue = $_POST['MarketValue'];
	}
	if(isset($_POST['SterlingStatistics'])){
		$SterlingStatistics = $_POST['SterlingStatistics'];
	}

	$stmt = oci_parse($conn, "INSERT INTO STERLINGMOVEMENTS (EVENTID, STERLINGDESCRIPTION, MARKETVALUE, STERLINGSTATISTICS) VALUES (:EventID, :SterlingDescription, :MarketValue, :SterlingStatistics)");

	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":SterlingDescription", $SterlingDescription);
	oci_bind_by_name($stmt, ":MarketValue", $MarketValue);
	oci_bind_by_name($stmt, ":SterlingStatistics", $SterlingStatistics);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if($Affected > 0){
		header("Location: ../viewSterlingMovements.php?Success=Sterling Movement has been created!");
	} else {
		header("Location: ../viewSterlingMovements.php?Danger=Sterling Movement hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['SterlingMovementID'])) {
		$SterlingMovementID = $_POST['SterlingMovementID'];
	}
	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['SterlingDescription'])){
		$SterlingDescription = $_POST['SterlingDescription'];
	}
	if(isset($_POST['MarketValue'])){
		$MarketValue = $_POST['MarketValue'];
	}
	if(isset($_POST['SterlingStatistics'])){
		$SterlingStatistics = $_POST['SterlingStatistics'];
	}

	$stmt = oci_parse($conn, "UPDATE STERLINGMOVEMENTS SET EVENTID = :EventID, STERLINGDESCRIPTION = :SterlingDescription, MARKETVALUE = :MarketValue, STERLINGSTATISTICS = :SterlingStatistics WHERE STERLINGMOVEMENTID = :SterlingMovementID");

	oci_bind_by_name($stmt, ":SterlingMovementID", $SterlingMovementID);
	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":SterlingDescription", $SterlingDescription);
	oci_bind_by_name($stmt, ":MarketValue", $MarketValue);
	oci_bind_by_name($stmt, ":SterlingStatistics", $SterlingStatistics);

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
		header("Location: ../viewSterlingMovements.php?Success=Sterling Movement has been updated!");
	} else {
		header("Location: ../viewSterlingMovements.php?Danger=Sterling Movement hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['SterlingMovementID'])) {

		$SterlingMovementID = $_GET['SterlingMovementID'];

		$stmt = oci_parse($conn, "DELETE FROM STERLINGMOVEMENTS WHERE STERLINGMOVEMENTID = :SterlingMovementID");

		ocibindbyname($stmt, ":SterlingMovementID", $SterlingMovementID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if($Affected > 0){
			header("Location: ../viewSterlingMovements.php?Success=Sterling Movement has been deleted!");
		}	else {
			header("Location: ../viewSterlingMovements.php?Danger=Sterling Movement hasn't been deleted!");
		}
	}

}
?>