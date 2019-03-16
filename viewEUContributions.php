<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM EUCONTRIBUTION INNER JOIN COUNTRY ON EUCONTRIBUTION.COUNTRYID = COUNTRY.COUNTRYID");
oci_execute($stid);
//oci_fetch_all($stid, $emps);
/* highlight_string("<?php\n\$emps =\n" . var_export($emps, true) . ";\n?>"); */

?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - View EU Contributions</title>
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

    <h1 class="display-1">View EU Contributions</h1><br>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Country Name</th>
          <th>Contribution Description</th>
          <th>Budget Details</th>
          <th>Details</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
          $ContributionID = $row['CONTRIBUTIONID'];
          //foreach ($row as $item) { ?>
        <tr>
          <td><?php echo $row['COUNTRYNAME']; ?></td>
          <td><?php echo $row['CONTRIBUTIONDESCRIPTION']; ?></td>
          <td><?php echo $row['BUDGETDETAILS']; ?></td>
          <td><button type="button" data-toggle="modal" data-target="#ModalCenter<?php echo $ContributionID; ?>" rel="tooltip" title="Click for a detailed view" class="btn btn-info">Modal</button></td>
          <td><a href="editEUContribution.php?ContributionID=<?php echo $ContributionID; ?>" class="btn btn-warning">Edit</a></td>
          <td><a onclick="javascript: return confirm('Are you sure you want to delete?');" href="processor/eucontributionProcessor.php?ContributionID=<?php echo $ContributionID; ?>" class="btn btn-danger">Delete</a></td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="ModalCenter<?php echo $ContributionID; ?>" tabindex="-1" role="dialog" aria-labelledby="Title<?php echo $ContributionID; ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="Title<?php echo $ContributionID; ?>">EU Contributions Details View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <label for="CountryID">Country Name:</label>
                  <select class="form-control" id="CountryID" name="CountryID" required="true" readonly>
                      <option><?php echo $row['COUNTRYNAME']; ?></option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="ContributionDescription">Law Details:</label>
                  ​<textarea id="ContributionDescription" name="ContributionDescription" class="form-control" rows="5" cols="70" required="true" maxlength="255" readonly><?php echo $row['CONTRIBUTIONDESCRIPTION']; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="BudgetDetails">Budget Details:</label>
                  ​<textarea id="BudgetDetails" name="BudgetDetails" class="form-control" rows="5" cols="70" required="true" maxlength="255" readonly><?php echo $row['BUDGETDETAILS']; ?></textarea>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>

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

  <script type="text/javascript">
    $(document).ready(function(){
      $('[rel="tooltip"]').tooltip({trigger: "hover"});
    });    
  </script>

</body>

</html>
