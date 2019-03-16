<?php
require('x_connect.php'); 

// remove these style tags to remove the large font size
echo '<style type="text/css">  p {font-size: x-large}  </style>';
echo '<style type="text/css">  table {font-size: x-large}  </style>';

$stid = oci_parse($conn, "SELECT * FROM EMP");
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

oci_free_statement($stid);
oci_close($conn);
echo '<p><br/><br/>. . . disconnected.</p>';
?> 


