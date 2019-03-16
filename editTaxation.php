<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$TaxID = $_GET['TaxID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM TAXATION INNER JOIN KEYEVENTS ON TAXATION.EVENTID = KEYEVENTS.EVENTID WHERE TAXID = :TaxID");
oci_bind_by_name($stid, ":TaxID", $TaxID);
oci_execute($stid);

$newstid = oci_parse($conn, "SELECT EVENTID, EVENTNAME FROM KEYEVENTS");
oci_execute($newstid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit Taxation</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit Taxation</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/taxationProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="TaxID" value="<?php echo $TaxID; ?>">

        <div class="form-group">
          <label for="EventID">Event Name:</label>
          <select class="form-control" id="EventID" name="EventID" required="true">
            <option value="" selected="selected" disabled>Select an Event</option>
            <?php while ($event = oci_fetch_array($newstid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $event['EVENTID']; ?>" <?php if($event['EVENTID'] == $row['EVENTID']){ ?> selected <?php } ?>><?php echo $event['EVENTNAME']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="TaxDescription">Supply Description:</label>
          ​<textarea id="TaxDescription" name="TaxDescription" class="form-control" rows="5" cols="70" required="true" maxlength="255"><?php echo $row['TAXDESCRIPTION']; ?></textarea>
        </div>

        <div class="form-group">
          <label for="TaxValue">Tax Value:</label>
          <input type="number" id="TaxValue" name="TaxValue" class="form-control" step="0.01" min="0" max="100" required="true" value="<?php echo $row['TAXVALUE']; ?>">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

      </form><br>

    <?php } ?>
    <?php
    oci_free_statement($stid);
    oci_close($conn);
    oci_free_statement($newstid);
    oci_close($conn);
    ?>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
