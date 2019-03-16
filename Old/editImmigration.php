<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$ImmigrationID = $_GET['ImmigrationID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM IMMIGRATION INNER JOIN KEYEVENTS ON IMMIGRATION.EVENTID = KEYEVENTS.EVENTID INNER JOIN COUNTRY ON IMMIGRATION.COUNTRYID = COUNTRY.COUNTRYID WHERE IMMIGRATIONID = :ImmigrationID");
oci_bind_by_name($stid, ":ImmigrationID", $ImmigrationID);
oci_execute($stid);

$newstid = oci_parse($conn, "SELECT EVENTID, EVENTNAME FROM KEYEVENTS");
oci_execute($newstid);

$countrystid = oci_parse($conn, "SELECT * FROM COUNTRY");
oci_execute($countrystid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit Immigration</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit Immigration</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/immigrationProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="ImmigrationID" value="<?php echo $ImmigrationID; ?>">

        <div class="form-group">
          <label for="CountryID">Country Name:</label>
          <select class="form-control" id="CountryID" name="CountryID" required="true">
            <?php while ($country = oci_fetch_array($countrystid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $country['COUNTRYID']; ?>" <?php if($row['COUNTRYID'] == $country['COUNTRYID']){ ?> selected <?php } ?>><?php echo $country['COUNTRYNAME']; ?></option>
            <?php } ?>
          </select>
        </div>

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
          <label for="ImmigrationDescription">Immigration Description:</label>
          ​<textarea id="ImmigrationDescription" name="ImmigrationDescription" class="form-control" rows="5" cols="70" required="true" maxlength="255"><?php echo $row['IMMIGRATIONDESCRIPTION']; ?></textarea>
        </div>

        <div class="form-group">
          <label for="ImmigrationStatistics">Immigration Statistic:</label>
          <input type="number" id="ImmigrationStatistics" name="ImmigrationStatistics" class="form-control" step="0.01" min="0" max="100" required="true" value="<?php echo $row['IMMIGRATIONSTATISTICS']; ?>">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

      </form><br>

    <?php } ?>
    <?php
    oci_free_statement($stid);
    oci_close($conn);
    oci_free_statement($newstid);
    oci_close($conn);
    oci_free_statement($countrystid);
    oci_close($conn);
    ?>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
