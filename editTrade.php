<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');

$TradingID = $_GET['TradingID'];

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT * FROM TRADING INNER JOIN COUNTRY ON TRADING.COUNTRYID = COUNTRY.COUNTRYID WHERE TRADINGID = :TradingID");
oci_bind_by_name($stid, ":TradingID", $TradingID);
oci_execute($stid);

$newstid = oci_parse($conn, "SELECT COUNTRYID, COUNTRYNAME FROM COUNTRY");
oci_execute($newstid);
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - Edit Trade</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">

</head>

<body>

  <?php include('includes/navigation.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <h1 class="display-1">Edit Trade</h1><br>

    <!-- Uncomment to test Form POST -->
    <?php /* highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>"); */ ?>
    <?php //var_dump($_POST); ?>

    <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>

      <form action="processor/tradingProcessor.php" method="post">

        <input type="hidden" name="Action" value="Update">
        <input type="hidden" name="TradingID" value="<?php echo $TradingID; ?>">

        <div class="form-group">
          <label for="CountryID">Country Name:</label>
          <select class="form-control" id="CountryID" name="CountryID" required="true">
            <?php while ($country = oci_fetch_array($newstid, OCI_ASSOC + OCI_RETURN_NULLS)) { ?>
              <option value="<?php echo $country['COUNTRYID']; ?>" <?php if($row['COUNTRYID'] == $country['COUNTRYID']){ ?> selected <?php } ?>><?php echo $country['COUNTRYNAME']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="TradeDescription">Trade Description:</label>
          ​<textarea id="TradeDescription" name="TradeDescription" class="form-control" rows="5" cols="70" required="true" maxlength="255"><?php echo $row['TRADEDESCRIPTION']; ?></textarea>
        </div>
        
        <div class="form-group">
          <label for="TradeAgreement">Voting Decision:</label>
          <select class="form-control" id="TradeAgreement" name="TradeAgreement" required="true">
            <option value="1" <?php if($row['TRADEAGREEMENT'] == "1"){ ?> selected <?php } ?>>Yes</option>
            <option value="0" <?php if($row['TRADEAGREEMENT'] == "0"){ ?> selected <?php } ?>>No</option>
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
    ?>

  </div>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>

</body>

</html>
