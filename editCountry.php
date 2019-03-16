<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$CountryID = $_GET['CountryID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT COUNTRYNAME, GDP FROM COUNTRY WHERE COUNTRYID = :CountryID");
oci_bind_by_name($stid, ":CountryID", $CountryID);
oci_execute($stid);

?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit Country</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit Country</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/countryProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="CountryID" value="<?php echo $CountryID; ?>">

        <div class="form-group">
          <label for="CountryName">Country Name:</label>
          <input type="text" name="CountryName" class="form-control" id="CountryName" value="<?php echo $row['COUNTRYNAME'];?>" required="true" maxlength="100">
        </div>

        <div class="form-group">
          <label for="Gross">GDP:</label>
          <input type="number" name="Gross" class="form-control" id="Gross" value="<?php echo $row['GDP']; ?>" required="true">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

      </form><br>

    <?php }  ?>
    <?php
      oci_free_statement($stid);
      oci_close($conn);
    ?>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
