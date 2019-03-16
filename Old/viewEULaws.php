<!DOCTYPE html>
<html lang="en">

<?php
session_start(); 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT EULAWS.LAWID, EULAWS.LAWDETAILS, COUNTRY.COUNTRYNAME FROM EULAWS INNER JOIN COUNTRY ON EULAWS.COUNTRYID = COUNTRY.COUNTRYID");
oci_execute($stid);
//oci_fetch_all($stid, $emps);
/* highlight_string("<?php\n\$emps =\n" . var_export($emps, true) . ";\n?>");*/

?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - View EU Laws</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

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

    <h1 class="display-1">View EU Laws</h1><br>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Country Name</th>
          <th>Law Details</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
          $LawID = $row['LAWID']; 
          //foreach ($row as $item) { ?>
        <tr>
          <td width="20%"><?php echo $row['COUNTRYNAME']; ?></td>
          <td width="80%"><?php echo $row['LAWDETAILS']; ?></td>
          <td><a href="editEULaw.php?LawID=<?php echo $LawID; ?>" class="btn btn-warning">Edit</a></td>
          <td><a onclick="javascript: return confirm('Are you sure you want to delete?');" href="processor/eulawProcessor.php?LawID=<?php echo $LawID; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php }//}  ?>
        <?php
          oci_free_statement($stid);
          oci_close($conn);
        ?>
      </tbody>
    </table>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
