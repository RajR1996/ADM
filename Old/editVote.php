<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$VotingID = $_GET['VotingID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM VOTING INNER JOIN MPS ON VOTING.MPID = MPS.MPID WHERE VOTINGID = :VotingID");
oci_bind_by_name($stid, ":VotingID", $VotingID);
oci_execute($stid);

$newstid = oci_parse($conn, "SELECT * FROM MPS");
oci_execute($newstid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit Vote</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit Vote</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/votingProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="VotingID" value="<?php echo $VotingID; ?>">

        <div class="form-group">
          <label for="MPID">MP Name:</label>
          <select class="form-control" id="MPID" name="MPID" required="true">
            <option value="" selected="selected" disabled>Select an MP</option>
            <?php while ($values = oci_fetch_array($newstid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $values['MPID']; ?>" <?php if($row['MPID'] == $values['MPID']){ ?> selected <?php } ?>><?php echo $values['MPFNAME']. ' ' .$values['MPLNAME']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="VotingDecision">Voting Decision:</label>
          <select class="form-control" id="VotingDecision" name="VotingDecision" required="true">
            <option value="Y" <?php if($row['VOTINGDECISION'] == "Y"){ ?> selected <?php } ?>>Yes</option>
            <option value="N" <?php if($row['VOTINGDECISION'] == "N"){ ?> selected <?php } ?>>No</option>
            <option value="A" <?php if($row['VOTINGDECISION'] == "A"){ ?> selected <?php } ?>>Abstained</option>
          </select>
        </div>

        <div class="form-group">
          <label for="VotingDescription">Voting Description:</label>
          ​<textarea id="VotingDescription" name="VotingDescription" class="form-control" rows="5" cols="70" required="true" maxlength="255"><?php echo $row['VOTINGDESCRIPTION']; ?></textarea>
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
