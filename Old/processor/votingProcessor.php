<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['MPID'])) {
		echo $MPID = $_POST['MPID'];
	}
	if(isset($_POST['VotingDecision'])){
		echo $VotingDecision = $_POST['VotingDecision'];
	}
	if(isset($_POST['VotingDescription'])) {
		echo $VotingDescription = $_POST['VotingDescription'];
	}


	$stmt = oci_parse($conn, "INSERT INTO VOTING (MPID, VOTINGDESCRIPTION, VOTINGDECISION) VALUES (:MPID, :VotingDescription, :VotingDecision)");

	oci_bind_by_name($stmt, ":MPID", $MPID);
	oci_bind_by_name($stmt, ":VotingDecision", $VotingDecision);
	oci_bind_by_name($stmt, ":VotingDescription", $VotingDescription);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);

	// echo $Gross;
	// echo $CountryName;
	if(count($Affected) > 0){
		header("Location: ../viewVotings.php?Success=Vote has been created!");
	} else {
		$err = OCIError();
    // echo "Oracle Connect Error " . $err[text];
		header("Location: ../viewVotings.php?Danger=Vote hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['VotingID'])) {
		$VotingID = $_POST['VotingID'];
	}
	if(isset($_POST['MPID'])) {
		$MPID = $_POST['MPID'];
	}
	if(isset($_POST['VotingDecision'])){
		$VotingDecision = $_POST['VotingDecision'];
	}
	if(isset($_POST['VotingDescription'])) {
		$VotingDescription = $_POST['VotingDescription'];
	}


	$stmt = oci_parse($conn, "UPDATE VOTING SET MPID = :MPID, VOTINGDECISION = :VotingDecision, VOTINGDESCRIPTION = :VotingDescription WHERE VOTINGID = :VotingID");

	oci_bind_by_name($stmt, ":VotingID", $VotingID);
	oci_bind_by_name($stmt, ":MPID", $MPID);
	oci_bind_by_name($stmt, ":VotingDecision", $VotingDecision);
	oci_bind_by_name($stmt, ":VotingDescription", $VotingDescription);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);
	
	// echo "CountryID" . ' ' . $CountryID . "<br>";
	// echo "GDP" . ' ' . $Gross . "<br>";
	// echo "Country Name" . ' ' . $CountryName . "<br>";
	// echo "Rows Affected" . ' ' . $Affected;

	if(count($Affected) == 1){
		header("Location: ../viewVotings.php?Success=Vote has been updated!");
	} else {
		header("Location: ../viewVotings.php?Danger=Vote hasn't been updated!");
	}

} else {

	// Delete
	if(isset($_GET['VotingID'])) {

		$VotingID = $_GET['VotingID'];

		$stmt = oci_parse($conn, "DELETE FROM VOTING WHERE VOTINGID = :VotingID");

		ocibindbyname($stmt, ":VotingID", $VotingID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		
		if(count($Affected) > 0){
			header("Location: ../viewVotings.php?Success=Vote has been deleted!");
		}	else {
			header("Location: ../viewVotings.php?Danger=Vote hasn't been deleted!");
		}
	}

}
?>