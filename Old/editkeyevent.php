<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$EventID = $_GET['EventID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM KEYEVENTS INNER JOIN COUNTRY ON KEYEVENTS.COUNTRYID = COUNTRY.COUNTRYID WHERE EVENTID = :EventID");
oci_bind_by_name($stid, ":EventID", $EventID);
oci_execute($stid);

$newstid = oci_parse($conn, "SELECT COUNTRYID, COUNTRYNAME FROM COUNTRY");
oci_execute($newstid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit Key Event</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit Key Event</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/keyeventsProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="EventID" value="<?php echo $EventID; ?>">

        <div class="form-group">
          <label for="CountryID">Country Name:</label>
          <select class="form-control" id="CountryID" name="CountryID" required="true">
            <?php while ($values = oci_fetch_array($newstid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $values['COUNTRYID']; ?>" <?php if($row['COUNTRYID'] == $values['COUNTRYID']){ ?> selected <?php } ?>><?php echo $values['COUNTRYNAME']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="EventName">Event Name:</label>
          <input type="text" name="EventName" class="form-control" id="EventName" value="<?php echo $row['EVENTNAME'];?>" required="true" maxlength="70">
        </div>

        <div>
          <label for="EventDate">Event Date:</label>
          <input type="date" name="EventDate" class="form-control" id="EventDate" value="<?php echo date('Y-m-d', strtotime($row['EVENTDATE'])); ?>" required="true">
        </div>

        <div class="form-group">
          <label for="EventDescription">Event Description:</label>
          ​<textarea id="EventDescription" name="EventDescription" class="form-control" rows="5" cols="70" required="true" maxlength="255"><?php echo $row['EVENTDESCRIPTION']; ?></textarea>
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
