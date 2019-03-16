<?php

// Connect to the Oracle database
require('x_connect.php');  

$stid = oci_parse($conn, 'begin cmsjw5demo.what_time_is_it(:thetime); end;');

// The procedure parameter is an OUT bind. The default type
// will be a string type so binding a length 10 means that at most 10
// digits will be returned.
oci_bind_by_name($stid, ':thetime', $time, 10);

oci_execute($stid);

echo "The time is: "."$time";   

oci_free_statement($stid);
oci_close($conn);

?> 
