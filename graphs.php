<!DOCTYPE html>
<html lang="en">

<?php 
include('includes/commonResources.php');
include('includes/applicationVariables.php');
include('includes/amchartsResources.php');

require('scripts/x_connect.php'); 

$stid = oci_parse($conn, "SELECT AREANAME, count(*) FROM MEMBERSHIP INNER JOIN COUNTRY ON MEMBERSHIP.COUNTRYID = COUNTRY.COUNTRYID INNER JOIN AREA ON MEMBERSHIP.AREAID = AREA.AREAID GROUP BY AREANAME");
oci_execute($stid);
oci_fetch_all($stid, $areas);
$areacount = array_combine($areas['AREANAME'], $areas['COUNT(*)']);

$countrystid = oci_parse($conn, "SELECT COUNTRYNAME, GDP FROM COUNTRY");
oci_execute($countrystid);
oci_fetch_all($countrystid, $countryGPD);
$countriesGDP = array_combine($countryGPD['COUNTRYNAME'], $countryGPD['GDP']) ;

$keyevents = oci_parse($conn, "SELECT EVENTNAME FROM KEYEVENTS GROUP BY EVENTNAME");
oci_execute($keyevents);
oci_fetch_all($keyevents, $keyevent);

$immigrations = oci_parse($conn, "SELECT COUNT(*) IMMIGRATIONS FROM KEYEVENTS LEFT JOIN IMMIGRATION ON KEYEVENTS.EVENTID = IMMIGRATION.EVENTID GROUP BY EVENTNAME");
oci_execute($immigrations);
oci_fetch_all($immigrations, $imm);

$effects = oci_parse($conn, "SELECT COUNT(*) EFFECTS FROM KEYEVENTS LEFT JOIN EFFECT ON KEYEVENTS.EVENTID = EFFECT.EVENTID GROUP BY EVENTNAME");
oci_execute($effects);
oci_fetch_all($effects, $eff);

$supplychains = oci_parse($conn, "SELECT COUNT(*) SUPPLYCHAINS FROM KEYEVENTS LEFT JOIN SUPPLYCHAINS ON KEYEVENTS.EVENTID = SUPPLYCHAINS.EVENTID GROUP BY EVENTNAME");
oci_execute($supplychains);
oci_fetch_all($supplychains, $supp);

$supplychains = oci_parse($conn, "SELECT COUNT(*) SUPPLYCHAINS FROM KEYEVENTS LEFT JOIN SUPPLYCHAINS ON KEYEVENTS.EVENTID = SUPPLYCHAINS.EVENTID GROUP BY EVENTNAME");
oci_execute($supplychains);
oci_fetch_all($supplychains, $supp);

$sterlingmove = oci_parse($conn, "SELECT COUNT(*) STERLINGMOVEMENTS FROM KEYEVENTS LEFT JOIN STERLINGMOVEMENTS ON KEYEVENTS.EVENTID = STERLINGMOVEMENTS.EVENTID GROUP BY EVENTNAME");
oci_execute($sterlingmove);
oci_fetch_all($sterlingmove, $ster);

$changesmodel = oci_parse($conn, "SELECT COUNT(*) CHANGESMODEL FROM KEYEVENTS LEFT JOIN CHANGESMODEL ON KEYEVENTS.EVENTID = CHANGESMODEL.EVENTID GROUP BY EVENTNAME");
oci_execute($changesmodel);
oci_fetch_all($changesmodel, $change);

$taxation = oci_parse($conn, "SELECT COUNT(*) TAXATION FROM KEYEVENTS LEFT JOIN TAXATION ON KEYEVENTS.EVENTID = TAXATION.EVENTID GROUP BY EVENTNAME");
oci_execute($taxation);
oci_fetch_all($taxation, $tax);

$arr = array_merge($keyevent, $imm, $eff, $supp, $ster, $change, $tax);
$keys = array_keys($arr);

 /* highlight_string("<?php\n\$row =\n" . var_export($row, true) . ";\n?>"); */
// foreach($arr[$keys[0]] as $key => $val){
//   $result[$val] = array_combine(array_slice($keys, 1), array_column(array_slice($arr,1), $key));
// } 
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $applicationName; ?> - View Graphs</title>
  <link rel="stylesheet" type="text/css" href="css/stickyFooter.css">
  <style>
  #AreaPie {
    width: 100%;
    max-height: 600px;
    height: 100vh;
  }
  #CountryGPDBar {
    width: 100%;
    max-height: 600px;
    height: 100vh;
  }
  #KeyeventsCount {
    width: 100%;
    max-height: 600px;
    height: 100vh;
  }
  .tab-pane{
    background-color: #343a40!important;
  }
  </style>

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

    <h1 class="display-1">View Graphs</h1><br>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-areaCountryCount-tab" data-toggle="pill" href="#pills-areaCountryCount" role="tab" aria-controls="pills-areaCountryCount" aria-selected="true">% of Countries in Each Area</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-countryGDP-tab" data-toggle="pill" href="#pills-countryGDP" role="tab" aria-controls="pills-countryGDP" aria-selected="false">Countries GDP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-keyeventsCount-tab" data-toggle="pill" href="#pills-keyeventsCount" role="tab" aria-controls="pills-keyeventsCount" aria-selected="false">Activites per Keyevent</a>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-areaCountryCount" role="tabpanel" aria-labelledby="pills-areaCountryCount-tab">
        <div id="AreaPie"></div>
      </div>
      <div class="tab-pane fade" id="pills-countryGDP" role="tabpanel" aria-labelledby="pills-countryGDP-tab">
        <div id="CountryGPDBar"></div><br><br>
      </div>
      <div class="tab-pane fade" id="pills-keyeventsCount" role="tabpanel" aria-labelledby="pills-keyeventsCount-tab">
        <div id="KeyeventsCount"></div>
      </div>
    </div>

    

  </div>
  <!-- /.container -->


  <?php include('includes/footer.php'); ?>
  <?php
  oci_free_statement($stid);
  oci_close($conn);
  ?>

  <script type="text/javascript">
      AmCharts.makeChart("AreaPie",
        {
          "type": "pie",
          "angle": 12,
          "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "depth3D": 15,
          "titleField": "Area",
          "valueField": "Countries",
          "theme": "chalk",
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "align": "center",
            "markerType": "circle"
          },
          "titles": [
            {
              "id": "Title-1",
              "text": "Percentage of Countries in Areas"
            }
          ],
          "dataProvider": [
            <?php foreach ($areacount as $key => $value) { ?>
            {
              "Area": "<?php echo $key; ?>",
              "Countries": "<?php echo $value; ?>"
            },
            <?php } ?>
          ]
        }
      );
      AmCharts.makeChart("CountryGPDBar",
        {
          "type": "serial",
          "categoryField": "Country",
          "startDuration": 1,
          "theme": "chalk",
          "categoryAxis": {
            "gridPosition": "start"
          },
          "chartCursor": {
            "enabled": true
          },
          "chartScrollbar": {
            "enabled": true
          },
          "trendLines": [],
          "graphs": [
            {
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "title": "graph 1",
              "type": "column",
              "valueField": "GDP"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "title": "GPD"
            }
          ],
          "allLabels": [],
          "balloon": {},
          "titles": [
            {
              "id": "Title-1",
              "size": 15,
              "text": "Countries and their GDP"
            }
          ],
          "dataProvider": [
            <?php foreach ($countriesGDP as $key => $value) { ?>
            {
              "Country": "<?php echo $key; ?>",
              "GDP": "<?php echo $value; ?>"
            },
            <?php } ?>
          ]
        }
      );

      AmCharts.makeChart("KeyeventsCount",
        {
          "type": "serial",
          "categoryField": "Event",
          "startDuration": 1,
          "theme": "chalk",
          "categoryAxis": {
            "gridPosition": "start"
          },
          "trendLines": [],
          "graphs": [
            {
              "balloonText": "[[title]] of [[Event]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "title": "Immigrations",
              "type": "column",
              "valueField": "Immigrations"
            },
            {
              "balloonText": "[[title]] of [[Event]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-2",
              "title": "Effects",
              "type": "column",
              "valueField": "Effects"
            },
            {
              "balloonText": "[[title]] of [[Event]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-3",
              "title": "Supply Chains",
              "type": "column",
              "valueField": "Supply Chains"
            },
            {
              "balloonText": "[[title]] of [[Event]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-4",
              "title": "Sterling Movements",
              "type": "column",
              "valueField": "Sterling Movements"
            },
            {
              "balloonText": "[[title]] of [[Event]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-5",
              "title": "Changes Model",
              "type": "column",
              "valueField": "Changes Model"
            },
            {
              "balloonText": "[[title]] of [[Event]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-6",
              "title": "Taxation",
              "type": "column",
              "valueField": "Taxation"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "stackType": "regular",
              "title": "Count"
            }
          ],
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "useGraphSettings": true
          },
          "titles": [
            {
              "id": "Title-1",
              "size": 15,
              "text": "Activites per Keyevent"
            }
          ],
          "dataProvider": [
            <?php foreach($arr[$keys[0]] as $key => $val){
              $result[$val] = array_combine(array_slice($keys, 1), array_column(array_slice($arr,1), $key));
            } ?>
            <?php foreach ($result as $key => $value) { ?>
            {
              "Event": "<?php echo $key; ?>",
              "Immigrations": <?php echo $value['IMMIGRATIONS']; ?>,
              "Effects": <?php echo $value['EFFECTS']; ?>,
              "Supply Chains": <?php echo $value['SUPPLYCHAINS']; ?>,
              "Sterling Movements": <?php echo $value['STERLINGMOVEMENTS']; ?>,
              "Changes Model": <?php echo $value['CHANGESMODEL']; ?>,
              "Taxation": <?php echo $value['TAXATION']; ?>
            },
            <?php } ?>
          ]
        }
      );
            
          
    </script>

</body>

</html>
