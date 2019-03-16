<?php

require('../scripts/x_connect.php');

// Create
if($_POST['Action'] == "Create") {

	if(isset($_POST['AreaName'])) {
		$AreaName = $_POST['AreaName'];
	}
	if(isset($_POST['AreaInfo'])){
		$AreaInfo = $_POST['AreaInfo'];
	}

	$stmt = oci_parse($conn, "INSERT INTO AREA (AREANAME, AREAINFO) VALUES (:AreaName, :AreaInfo)");

	oci_bind_by_name($stmt, ":AreaName", $AreaName);
	oci_bind_by_name($stmt, ":AreaInfo", $AreaInfo);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);


	// echo $AreaName;
	// echo $AreaInfo;

	if(count($Affected) > 0){
		header("Location: ../viewAreas.php?Success=$AreaName has been created!");
	} else {
		header("Location: ../viewAreas.php?Danger=$AreaName hasn't been created!");
	}	

// Update	
} elseif($_POST['Action'] == "Update") {

	if(isset($_POST['AreaID'])) {
		$AreaID = $_POST['AreaID'];
	}
	if(isset($_POST['AreaName'])) {
		$AreaName = $_POST['AreaName'];
	}
	if(isset($_POST['AreaInfo'])){
		$AreaInfo = $_POST['AreaInfo'];
	}

	$stmt = oci_parse($conn, "UPDATE AREA SET AREANAME = :AreaName, AreaInfo = :AreaInfo WHERE AREAID = :AreaID");

	oci_bind_by_name($stmt, ":AreaID", $AreaID);
	oci_bind_by_name($stmt, ":AreaName", $AreaName);
	oci_bind_by_name($stmt, ":AreaInfo", $AreaInfo);

	oci_execute($stmt);
	$Affected = oci_num_rows($stmt);
	oci_commit($conn);

	oci_free_statement($stmt);
	oci_close($conn);
	
	// echo "AreaID" . ' ' . $AreaID . "<br>";
	// echo "AreaName" . ' ' . $AreaName . "<br>";
	// echo "AreaInfo" . ' ' . $AreaInfo . "<br>";
	// echo "Rows Affected" . ' ' . $Affected;

	if(count($Affected) > 0){
		header("Location: ../viewAreas.php?Success=$AreaName has been updated!");
	} else {
		header("Location: ../viewAreas.php?Danger=$AreaName hasn't been updated!");
	}

// Delete
} else {

	if(isset($_GET['AreaID'])) {

		$AreaID = $_GET['AreaID'];

		$stmt = oci_parse($conn, "DELETE FROM AREA WHERE AREAID = :AreaID");

		ocibindbyname($stmt, ":AreaID", $AreaID);

		oci_execute($stmt);
		$Affected = oci_num_rows($stmt);
		oci_commit($conn);

		oci_free_statement($stmt);
		oci_close($conn);
		
		if(count($Affected) > 0){
			header("Location: ../viewAreas.php?Success=Area has been deleted!");
		}	else {
			header("Location: ../viewAreas.php?Danger=Area hasn't been deleted!");
		}
	}

}
?>