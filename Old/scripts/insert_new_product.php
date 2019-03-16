<?php
// remove these style tags to remove the large font size
echo '<style type="text/css">  p {font-size: x-large}  </style>';
echo '<style type="text/css">  table {font-size: x-large}  </style>';

// Accept a parameter called "job" from a form.
$productid = $_POST['productid'];
$description = $_POST['description'];
echo '<p>Parameter values were: '.$productid.' , '.$description.'</p>'; 
echo '<br/><br/>';

// Connect to the Oracle database
require('x_connect.php'); 

// Specify pl/sql statement calling the procdeure with bind variables as parameters  
$query1 = "begin cmsjw5demo.add_product(:productid,:description); end;";

// Parse the query containing a bind variable.
$stmt = oci_parse($conn, $query1 );
 
// Bind the values into the parsed statement.
oci_bind_by_name($stmt, ':productid', $productid);
oci_bind_by_name($stmt, ':description', $description);
 
// Execute the completed statement.
oci_execute($stmt);

// no return data to display 

// Release the statement variable. We'll use the same one again below. 
oci_free_statement($stmt);


// Show the SQL
echo '<p>PL/SQL statement executed was: </br>'.$query1.'</p>';

// Now call procedure list_products(), which uses a ref_cursor to return a list of all products in the product table  

// Define a variable to receive the cursor pointer
$curs = oci_new_cursor($conn);

// Parse the query to submit the procedure call with bind variable :prodlistbv 
$stid = oci_parse($conn, "begin cmsjw5demo.list_products(:prodlistbv); end;");

// Bind the value into the parsed statement.
oci_bind_by_name($stid, ":prodlistbv", $curs, -1, OCI_B_CURSOR);

// Execute the statement to submit the procedure call
oci_execute($stid);

// Execute the REF CURSOR like a normal statement id
oci_execute($curs);  
while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    echo "Product ".$row['PRODID']." is a ".$row['DESCRIP']." added on ".$row['DATEADDED']."<br />\n";

}

// Release the statement variables and close the connection.
oci_free_statement($stid);
oci_free_statement($curs);
oci_close($conn);
?>