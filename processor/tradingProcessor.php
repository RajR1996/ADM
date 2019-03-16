<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['TradeDescription'])){
		$TradeDescription = $_POST['TradeDescription'];
	}
	if(isset($_POST['TradeAgreement'])){
		$TradeAgreement = $_POST['TradeAgreement'];
	}

	$stmt = oci_parse($conn, "INSERT INTO TRADING (COUNTRYID, TRADEDESCRIPTION, TRADEAGREEMENT) VALUES (:CountryID, :TradeDescription, :TradeAgreement)");

	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":TradeDescription", $TradeDescription);
	oci_bind_by_name($stmt, ":TradeAgreement", $TradeAgreement);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $TradeDescription;
	// echo $TradeAgreement;

	if($Affected > 0){
		header("Location: ../viewTradings.php?Success=Trade has been created!");
	} else {
		header("Location: ../viewTradings.php?Danger=Trade hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['TradingID'])) {
		$TradingID = $_POST['TradingID'];
	}
	if(isset($_POST['CountryID'])) {
		$CountryID = $_POST['CountryID'];
	}
	if(isset($_POST['TradeDescription'])){
		$TradeDescription = $_POST['TradeDescription'];
	}
	if(isset($_POST['TradeAgreement'])){
		$TradeAgreement = $_POST['TradeAgreement'];
	}

	$stmt = oci_parse($conn, "UPDATE TRADING SET COUNTRYID = :CountryID, TRADEDESCRIPTION = :TradeDescription, TRADEAGREEMENT = :TradeAgreement WHERE TRADINGID = :TradingID");

	oci_bind_by_name($stmt, ":TradingID", $TradingID);
	oci_bind_by_name($stmt, ":CountryID", $CountryID);
	oci_bind_by_name($stmt, ":TradeDescription", $TradeDescription);
	oci_bind_by_name($stmt, ":TradeAgreement", $TradeAgreement);

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
		header("Location: ../viewTradings.php?Success=Trade has been updated!");
	} else {
		header("Location: ../viewTradings.php?Danger=Trade hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['TradingID'])) {

		$TradingID = $_GET['TradingID'];

		$stmt = oci_parse($conn, "DELETE FROM TRADING WHERE TRADINGID = :TradingID");

		ocibindbyname($stmt, ":TradingID", $TradingID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if($Affected > 0){
			header("Location: ../viewTradings.php?Success=Trade has been deleted!");
		}	else {
			header("Location: ../viewTradings.php?Danger=Trade hasn't been deleted!");
		}
	}

}
?>