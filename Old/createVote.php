<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM MPS");
oci_execute($stid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Create Vote</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Create Vote</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>

      <form action="processor/votingProcessor.php" method="post">

        <input type="hidden" name="Action" value="Create">

        <div class="form-group">
          <label for="MPID">MP Name:</label>
          <select class="form-control" id="MPID" name="MPID" required="true">
            <option value="" selected="selected" disabled>Select an MP</option>
            <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $row['MPID']; ?>"><?php echo $row['MPFNAME']. ' ' .$row['MPLNAME']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="VotingDecision">Voting Decision:</label>
          <select class="form-control" id="VotingDecision" name="VotingDecision" required="true">
              <option value="" selected="selected" disabled>Select a Decision</option>
              <option value="Y">Yes</option>
              <option value="N">No</option>
              <option value="A">Abstained</option>
          </select>
        </div>

        <div class="form-group">
          <label for="VotingDescription">Voting Description:</label>
          ​<textarea id="VotingDescription" name="VotingDescription" class="form-control" placeholder="Enter Voting Description" rows="5" cols="70" required="true" maxlength="255"></textarea>
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
