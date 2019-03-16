<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$ImpactID = $_GET['ImpactID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM IMPACT WHERE IMPACTID = :ImpactID");
oci_bind_by_name($stid, ":ImpactID", $ImpactID);
oci_execute($stid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit Impact</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit Impact</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/impactProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="ImpactID" value="<?php echo $ImpactID; ?>">

        <div class="form-group">
          <label for="ImpactDescription">Impact Description:</label>
          <textarea name="ImpactDescription" id="ImpactDescription" class="form-control" rows="5" cols="50" required="true" maxlength="255"><?php echo $row['IMPACTDESCRIPTION']; ?></textarea>
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
