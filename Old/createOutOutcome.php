<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM IMPACT");
oci_execute($stid);

$newstid = oci_parse($conn, "SELECT AREAID, AREANAME FROM AREA");
oci_execute($newstid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Create Out Outcome</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Create Out Outcome</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>

      <form action="processor/outoutcomeProcessor.php" method="post">

        <input type="hidden" name="Action" value="Create">

        <div class="form-group">
          <label for="AreaID">Area Name:</label>
          <select class="form-control" id="AreaID" name="AreaID" required="true">
            <option value="" selected="selected" disabled>Select an Area Name</option>
            <?php while ($values = oci_fetch_array($newstid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $values['AREAID']; ?>"><?php echo $values['AREANAME']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="ImpactID">Impact Description</label>
          <select class="form-control" id="ImpactID" name="ImpactID" required="true">
            <option value="" selected="selected" disabled>Select an Impact Description</option>
            <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $row['IMPACTID']; ?>"><?php echo $row['IMPACTDESCRIPTION']; ?></option>
            <?php } ?>
          </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

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
