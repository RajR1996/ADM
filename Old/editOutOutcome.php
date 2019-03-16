<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$OutcomeID = $_GET['OutcomeID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM OUTOUTCOME INNER JOIN IMPACT ON OUTOUTCOME.IMPACTID = IMPACT.IMPACTID INNER JOIN AREA ON OUTOUTCOME.AREAID = AREA.AREAID WHERE OUTCOMEID = :OutcomeID");
oci_bind_by_name($stid, ":OutcomeID", $OutcomeID);
oci_execute($stid);

$newstid = oci_parse($conn, "SELECT AREAID, AREANAME FROM AREA");
oci_execute($newstid);

$extrastid = oci_parse($conn, "SELECT IMPACTID, IMPACTDESCRIPTION FROM IMPACT");
oci_execute($extrastid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit Out Outcome</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit Out Outcome</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/outoutcomeProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="OutcomeID" value="<?php echo $OutcomeID; ?>">

        <div class="form-group">
          <label for="AreaID">Area Name:</label>
          <select class="form-control" id="AreaID" name="AreaID" required="true">
            <?php while ($area = oci_fetch_array($newstid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $area['AREAID']; ?>" <?php if($area['AREAID'] == $row['AREAID']){ ?> selected <?php } ?>><?php echo $area['AREANAME']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="ImpactID">Impact Description</label>
          <select class="form-control" id="ImpactID" name="ImpactID" required="true">
            <?php while ($impact = oci_fetch_array($extrastid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $impact['IMPACTID']; ?>" <?php if($impact['IMPACTID'] == $row['IMPACTID']){ ?> selected <?php } ?>><?php echo $impact['IMPACTDESCRIPTION']; ?></option>
            <?php } ?>
          </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

      </form><br>

    <?php } ?>
    <?php
    oci_free_statement($stid);
    oci_close($conn);
    oci_free_statement($newstid);
    oci_close($conn);
    oci_free_statement($extrastid);
    oci_close($conn);
    ?>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
