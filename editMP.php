<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$MPID = $_GET['MPID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM MPS INNER JOIN COUNTRY ON MPS.COUNTRYID = COUNTRY.COUNTRYID INNER JOIN KEYEVENTS ON MPS.EVENTID = KEYEVENTS.EVENTID WHERE MPID = :MPID");
oci_bind_by_name($stid, ":MPID", $MPID);
oci_execute($stid);

$countrystid = oci_parse($conn, "SELECT COUNTRYID, COUNTRYNAME FROM COUNTRY");
oci_execute($countrystid);

$newstid = oci_parse($conn, "SELECT EVENTID, EVENTNAME FROM KEYEVENTS");
oci_execute($newstid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit MP</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit MP</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/mpProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="MPID" value="<?php echo $MPID; ?>">

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
          <label for="MPFName">MP First Name:</label>
          <input type="text" name="MPFName" class="form-control" id="MPFName" value="<?php echo $row['MPFNAME'];?>" required="true" maxlength="50">
        </div>

        <div class="form-group">
          <label for="MPLName">MP Last Name:</label>
          <input type="text" name="MPLName" class="form-control" id="MPLName" value="<?php echo $row['MPLNAME'];?>" required="true" maxlength="50">
        </div>

        <div class="form-group">
          <label for="MPParty">MP Party:</label>
          <input type="text" name="MPParty" class="form-control" id="MPParty" value="<?php echo $row['MPPARTY'];?>" required="true" maxlength="100">
        </div>

        <div class="form-group">
          <label for="MPLocation">MP Location:</label>
          <input type="text" name="MPLocation" class="form-control" id="MPLocation" value="<?php echo $row['MPLOCATION'];?>" required="true" maxlength="255">
        </div>
        
        <button type="submit" class="btn btn-success">Submit</button>

      </form><br>

    <?php } ?>
    <?php
    oci_free_statement($stid);
    oci_close($conn);
    ?>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
