<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Create Impact</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Create Impact</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>

      <form action="processor/impactProcessor.php" method="post">

        <input type="hidden" name="Action" value="Create">

        <div class="form-group">
          <label for="ImpactDescription">Impact Description:</label>
          ​<textarea id="ImpactDescription" name="ImpactDescription" class="form-control" placeholder="Enter Impact Description" rows="5" cols="70" required="true" maxlength="255"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>

      </form><br>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
