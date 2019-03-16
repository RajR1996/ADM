<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM KEYEVENTS");
oci_execute($stid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Create Taxation</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/stickyFooter.css"> -->

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Create Taxation</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

      <form action="processor/taxationProcessor.php" method="post">

        <input type="hidden" name="Action" value="Create">

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
          <label for="TaxDescription">Tax Description:</label>
          ​<textarea id="TaxDescription" name="TaxDescription" class="form-control" placeholder="Enter Tax Description" rows="5" cols="70" required="true" maxlength="255"></textarea>
        </div>

        <div class="form-group">
          <label for="TaxValue">Tax Value:</label>
          <input type="number" id="TaxValue" name="TaxValue" class="form-control" placeholder="Enter Tax Value" step="0.01" min="0" max="100" required="true">
        </div>

        <button type="submit" class="btn btn-success">Submit</button><hr>

      </form><br>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>
  <?php
  oci_free_statement($stid);
  oci_close($conn); 
  ?>

</body>

</html>
