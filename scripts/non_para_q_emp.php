<?php
// remove these style tags to remove the large font size
echo '<style type="text/css">  p {font-size: x-large}  </style>';
echo '<style type="text/css">  table {font-size: x-large}  </style>';

// Accept a parameter called "job" from a form.
$job = $_POST['job'];
echo '<p>Parameter value was: '.$job.'</p>'; 
echo '<br/><br/>';

// Connect to the Oracle database
require('x_connect.php'); 

// Specify SQL STATEMENT CONTAINING A PHP VARIABLE  
$query1 = "SELECT * FROM emp WHERE job = UPPER('$job') ORDER BY empno";

// Parse the query containing a PHP variable.
$stmt = oci_parse($conn, $query1);
 
// Execute the completed statement.
oci_execute($stmt);
 
echo "<table border='1' cellpadding='5'>\n";
while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

// Release the statement variable and close the connection
oci_free_statement($stmt);
oci_close($conn);

// Show the SQL
echo '<p>SQL statement executed was: </br>'.$query1.'</p>';
?>