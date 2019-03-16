<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM MEMBERSHIP INNER JOIN COUNTRY ON MEMBERSHIP.COUNTRYID = COUNTRY.COUNTRYID INNER JOIN AREA ON MEMBERSHIP.AREAID = AREA.AREAID");
oci_execute($stid);
//oci_fetch_all($stid, $emps);
/* highlight_string("<?php\n\$emps =\n" . var_export($emps, true) . ";\n?>"); */

?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - View Memberships</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">
  <link rel="stylesheet" type="text/css" href="css/tableSearch.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <?php if(isset($_GET['Success'])) { ?><br>
      <div class="alert alert-success" role="alert">
       <?php echo $_GET['Success']; ?>
      </div>
    <?php } ?>

    <?php if(isset($_GET['Danger'])) { ?><br>
      <div class="alert alert-danger" role="alert">
        <?php echo $_GET['Danger']; ?>
      </div>
    <?php } ?>

    <h1 class="display-1">View Memberships</h1><br>

    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for an Area or Country">

    <table class="table table-hover" id="myTable">
      <thead>
        <tr>
          <th>Country Name</th>
          <th>Area Name</th>
          <!-- <th>Edit</th> -->
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
          $AreaID = $row['AREAID'];
          $CountryID = $row['COUNTRYID'];
          //foreach ($row as $item) { ?>
        <tr>
          <td><?php echo $row['COUNTRYNAME']; ?></td>
          <td><?php echo $row['AREANAME']; ?></td>
          <!-- <td><a href="editVote.php?AreaID=<?php echo $AreaID; ?>&?CountryID=<?php echo $CountryID; ?>" class="btn btn-warning">Edit</a></td> -->
          <td><a onclick="javascript: return confirm('Are you sure you want to delete?');" href="processor/membershipProcessor.php?AreaID=<?php echo $AreaID; ?>&amp;CountryID=<?php echo $CountryID; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
  <!-- /.container -->

  <script>
  function myFunction() {
    // Declare variables 
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      test = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        newTxt = test.textContent || test.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1 || (newTxt.toUpperCase().indexOf(filter) > -1)) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      } 
    }
  }
  </script>

  <?php include('includes/footer.php'); ?>
  <?php
  oci_free_statement($stid);
  oci_close($conn);
  ?>

</body>

</html>
