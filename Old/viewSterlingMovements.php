<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM STERLINGMOVEMENTS INNER JOIN KEYEVENTS ON STERLINGMOVEMENTS.EVENTID = KEYEVENTS.EVENTID");
oci_execute($stid);
//oci_fetch_all($stid, $emps);
/* highlight_string("<?php\n\$emps =\n" . var_export($emps, true) . ";\n?>"); */

?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - View Sterling Movements</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <?php if(isset($_GET['Success'])) { ?><br>
      <div class="alert alert-success" role="alert">
       <?php echo $_GET['Success']; ?>
      </div>
    <?php } ?>

    <?php if(isset($_GET['Danger'])) { ?><br>
      <div class="alert alert-danger" role="alert">
        <?php echo $_GET['Danger']; ?>
      </div>
    <?php } ?>

    <h1 class="display-1">View Sterling Movements</h1><br>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Event Name</th>
          <th>Sterling Description</th>
          <th>Market Value</th>
          <th>Sterling Statistics</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
          $SterlingMovementID = $row['STERLINGMOVEMENTID'];
          //foreach ($row as $item) { ?>
        <tr>
          <td><?php echo $row['EVENTNAME']; ?></td>
          <td><?php echo $row['STERLINGDESCRIPTION']; ?></td>
          <td><?php echo $row['MARKETVALUE']; ?></td>
          <td><?php echo $row['STERLINGSTATISTICS']; ?></td>
          <td><a href="editSterlingMovement.php?SterlingMovementID=<?php echo $SterlingMovementID; ?>" class="btn btn-warning">Edit</a></td>
          <td><a onclick="javascript: return confirm('Are you sure you want to delete?');" href="processor/sterlingmovementsProcessor.php?SterlingMovementID=<?php echo $SterlingMovementID; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php }//}  ?>
        <?php
          oci_free_statement($stid);
          oci_close($conn);
        ?>
      </tbody>
    </table>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
