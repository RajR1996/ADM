<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM KEYEVENTS");
oci_execute($stid);

$countrystid = oci_parse($conn, "SELECT * FROM COUNTRY");
oci_execute($countrystid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Create Immigration</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/stickyFooter.css"> -->

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Create Immigration</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

      <form action="processor/immigrationProcessor.php" method="post">

        <input type="hidden" name="Action" value="Create">

        <div class="form-group">
          <label for="CountryID">Country Name:</label>
          <select class="form-control" id="CountryID" name="CountryID" required="true">
            <option value="" selected="selected" disabled>Select a Country</option>
            <?php while ($country = oci_fetch_array($countrystid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $country['COUNTRYID']; ?>"><?php echo $country['COUNTRYNAME']; ?></option>
            <?php }  ?>
          </select>
        </div>

        <div class="form-group">
          <label for="EventID">Event Name:</label>
          <select class="form-control" id="EventID" name="EventID" required="true">
            <option value="" selected="selected" disabled>Select an Event</option>
            <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $row['EVENTID']; ?>"><?php echo $row['EVENTNAME']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="ImmigrationDescription">Immigration Description:</label>
          ​<textarea id="ImmigrationDescription" name="ImmigrationDescription" class="form-control" placeholder="Enter Immigration Description" rows="5" cols="70" required="true" maxlength="255"></textarea>
        </div>

        <div class="form-group">
          <label for="ImmigrationStatistics">Sterling Statistic:</label>
          <input type="number" id="ImmigrationStatistics" name="ImmigrationStatistics" class="form-control" placeholder="Enter Immigration Statistic" step="0.01" min="0" max="100" required="true">
        </div>

        <button type="submit" class="btn btn-success">Submit</button><hr>

      </form><br>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>
  <?php
  oci_free_statement($stid);
  oci_close($conn); 
  oci_free_statement($countrystid);
  oci_close($conn); 
  ?>

</body>

</html>
