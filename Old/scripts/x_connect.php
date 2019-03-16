<?php
$oracle_home = "/apps/orainst/product/12.1";

$oracle_lib = "/apps/orainst/product/12.1/lib";

$oracle_path = "/apps/orainst/product/12.1/bin";

putenv("ORACLE_HOME=$oracle_home");

$savedLib = getenv("LD_LIBRARY_PATH");

putenv("LD_LIBRARY_PATH=$oracle_lib:$savedLib");

$savedPath = getenv("PATH");

putenv("$oracle_path:$savedPath");

putenv("TNS_ADMIN=/apps/orainst/product/12.1/network/admin");


// This scripts sets up PHP environment variables to display all errors on the screen
// and then connects to an oracle database

// Send PHP errors to the screen (should always be off for live systems)
ini_set('display_errors', 1);

// Set PHP error reporting level to report all errors.
error_reporting(E_ALL);

echo "<style type='text/css'> p {font-size: x-large} </style>";

// CONNECT TO ORACLE STUDENT ACCOUNT AT HALLAM
// Display 'connecting' message
// echo "<p>Connecting . . . </p>";

// Set up variables for connection
$con_hostname = 'homepages.shu.ac.uk:1521/shu11g.shu.ac.uk';
// CHANGE THE LINES BELOW TO ADD YOUR LOGIN DETAILS !!!
$con_username = 'b4025068';
$con_password = 'password123';


// Connect to the database.  $conn is a variable of type 'resource', and is the connection handle. 
// It returns a connection identifier, or FALSE (if it fails to connect)
 $conn = oci_connect($con_username, $con_password, $con_hostname);
 
 // if (!$conn) {
 // 	$e = oci_error();
 // 	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
 // } else { 
 // 	echo "<p> . . . Connected</p>";
 // }
?>
