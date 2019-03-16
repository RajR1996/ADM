<?php   
// the stored procedure meltingpts_rc returns a ref cursor in :cursbv

// Accept parameters called "lowval" and "hival" from a form.
$lowval = $_POST['lowval'];
$hival = $_POST['hival'];

// display them
echo '<p>Parameter values were: '.$lowval.' , '.$hival.'</p>'; 
echo '<br/><br/>'; 

// Connect to the Oracle database
require('x_connect.php');  

// define the cursor  (extra step relative to prepared statements or SP's 
$curs = oci_new_cursor($conn);

// parse the procedure call with embedded variables
$stid = oci_parse($conn, "begin cmsjw5demo.meltingpts_rc(:meltlow, :melthigh, :cursbv); end;");

// link the refcursor bind variable to the PHP variable $curs   (needs the special -1 and OCI_B_CURSOR parameters
oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);

// link the IN parameter bind variables to the PHP variables %lowval, $hival
oci_bind_by_name($stid, ':melthigh', $hival);
oci_bind_by_name($stid, ':meltlow', $lowval);

// execute the procedure call
oci_execute($stid);

// execute the REF CURSOR like a normal statement
oci_execute($curs);  

// loop to print all the rows (5 columns in the cursor)
while (($row = oci_fetch_row($curs)) != false) {
    echo $row[1]." ".$row[2]." ".$row[3]." ".$row[4]." ".$row[5]."<br />\n";

}
oci_free_statement($stid);
oci_free_statement($curs);
oci_close($conn);

?>  
