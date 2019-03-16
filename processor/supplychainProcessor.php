<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['SupplyDescription'])){
		$SupplyDescription = $_POST['SupplyDescription'];
	}
	if(isset($_POST['TariffDetails'])){
		$TariffDetails = $_POST['TariffDetails'];
	}

	$stmt = oci_parse($conn, "INSERT INTO SUPPLYCHAINS (EVENTID, SUPPLYDESCRIPTION, TARIFFDETAILS) VALUES (:EventID, :SupplyDescription, :TariffDetails)");

	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":SupplyDescription", $SupplyDescription);
	oci_bind_by_name($stmt, ":TariffDetails", $TariffDetails);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $CountryID;
	// echo $LawDetails;

	if($Affected > 0){
		header("Location: ../viewSupplyChains.php?Success=Supply Chain has been created!");
	} else {
		header("Location: ../viewSupplyChains.php?Danger=Supply Chain hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['SupplyID'])) {
		$SupplyID = $_POST['SupplyID'];
	}
	if(isset($_POST['EventID'])) {
		$EventID = $_POST['EventID'];
	}
	if(isset($_POST['SupplyDescription'])){
		$SupplyDescription = $_POST['SupplyDescription'];
	}
	if(isset($_POST['TariffDetails'])){
		$TariffDetails = $_POST['TariffDetails'];
	}

	$stmt = oci_parse($conn, "UPDATE SUPPLYCHAINS SET EVENTID = :EventID, SUPPLYDESCRIPTION = :SupplyDescription, TARIFFDETAILS = :TariffDetails WHERE SUPPLYID = :SupplyID");

	oci_bind_by_name($stmt, ":SupplyID", $SupplyID);
	oci_bind_by_name($stmt, ":EventID", $EventID);
	oci_bind_by_name($stmt, ":SupplyDescription", $SupplyDescription);
	oci_bind_by_name($stmt, ":TariffDetails", $TariffDetails);

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
		header("Location: ../viewSupplyChains.php?Success=Supply Chain has been updated!");
	} else {
		header("Location: ../viewSupplyChains.php?Danger=Supply Chain hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['SupplyID'])) {

		$SupplyID = $_GET['SupplyID'];

		$stmt = oci_parse($conn, "DELETE FROM SUPPLYCHAINS WHERE SUPPLYID = :SupplyID");

		ocibindbyname($stmt, ":SupplyID", $SupplyID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if($Affected > 0){
			header("Location: ../viewSupplyChains.php?Success=Supply Chain has been deleted!");
		}	else {
			header("Location: ../viewSupplyChains.php?Danger=Supply Chain hasn't been deleted!");
		}
	}

}
?>