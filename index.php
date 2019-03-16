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

  <title><?php echo $applicationName; ?></title>
  

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

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Brexit Countdown!</h1><br>
      <h1 class="display-3" id="Countdown"></h1>
      <!-- <p class="lead"></p> -->
      <!-- <a href="#" class="btn btn-primary btn-lg">Call to action!</a> -->
    </header>

    <!-- Page Features -->
    <div class="row text-center">

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="images/Country.jpg" alt="Countries">
          <div class="card-body">
            <h4 class="card-title">Countries</h4>
            <p class="card-text">View a list of all Countries and GDP values.</p>
          </div>
          <div class="card-footer">
            <a href="viewCountries.php" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="images/EULaws.jpg" alt="EU Laws">
          <div class="card-body">
            <h4 class="card-title">EU Laws</h4>
            <p class="card-text">View a list of the EU Laws for each Country.</p>
          </div>
          <div class="card-footer">
            <a href="viewEULaws.php" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="images/SterlingMovement.jpg" alt="Currency">
          <div class="card-body">
            <h4 class="card-title">Sterling Movements</h4>
            <p class="card-text">View a list of Sterling Movements relating to Key Events.</p>
          </div>
          <div class="card-footer">
            <a href="viewSterlingMovements.php" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="images/Brexit.jpg" alt="EU UK Brexit">
          <div class="card-body">
            <h4 class="card-title">Memberships</h4>
            <p class="card-text">View a list of Countries and see what Area they're a member of.</p>
          </div>
          <div class="card-footer">
            <a href="viewMemberships.php" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

  <script>
  // Set the date we're counting down to
  var countDownDate = new Date("Mar 29, 2019 23:00:00").getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
      
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
    // Output the result in an element with id="demo"
    document.getElementById("Countdown").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
      
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("Countdown").innerHTML = "EXPIRED";
    }
  }, 1000);
  </script>

</body>

</html>
