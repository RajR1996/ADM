<?php include('includes/applicationVariables.php'); ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php"><?php echo $applicationName; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus-square"></i> Create</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="createMP.php">MP</a>
              <a class="dropdown-item" href="createCountry.php">Country</a>
              <a class="dropdown-item" href="createArea.php">Area</a>
              <a class="dropdown-item" href="createVote.php">Vote</a>
              <a class="dropdown-item" href="createEULaw.php">EU Law</a>
              <a class="dropdown-item" href="createImpact.php">Impact</a>
              <a class="dropdown-item" href="createEUContribution.php">EU Contribution</a>
              <a class="dropdown-item" href="createOutOutcome.php">Out Outcome</a>
              <a class="dropdown-item" href="createTrade.php">Trade</a>
              <a class="dropdown-item" href="createMembership.php">Membership</a>
              <a class="dropdown-item" href="createKeyEvent.php">Key Event</a>
              <a class="dropdown-item" href="createChangesModel.php">Changes Model</a>
              <a class="dropdown-item" href="createEffect.php">Effect</a>
              <a class="dropdown-item" href="createSupplyChain.php">Supply Chain</a>
              <a class="dropdown-item" href="createTaxation.php">Taxation</a>
              <a class="dropdown-item" href="createSterlingMovement.php">Sterling Movement</a>
              <a class="dropdown-item" href="createImmigration.php">Immigration</a>
              <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a> -->
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i> View</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="viewMPs.php">MPs</a>
              <a class="dropdown-item" href="viewCountries.php">Countries</a>
              <a class="dropdown-item" href="viewAreas.php">Areas</a>
              <a class="dropdown-item" href="viewVotings.php">Votings</a>
              <a class="dropdown-item" href="viewEULaws.php">EU Laws</a>
              <a class="dropdown-item" href="viewImpacts.php">Impacts</a>
              <a class="dropdown-item" href="viewEUContributions.php">EU Contributions</a>
              <a class="dropdown-item" href="viewOutOutcomes.php">Out Outcomes</a>
              <a class="dropdown-item" href="viewTradings.php">Tradings</a>
              <a class="dropdown-item" href="viewMemberships.php">Memberships</a>
              <a class="dropdown-item" href="viewKeyEvents.php">Key Events</a>
              <a class="dropdown-item" href="viewChangesModels.php">Changes Models</a>
              <a class="dropdown-item" href="viewEffects.php">Effects</a>
              <a class="dropdown-item" href="viewSupplyChains.php">Supply Chains</a>
              <a class="dropdown-item" href="viewTaxations.php">Taxations</a>
              <a class="dropdown-item" href="viewSterlingMovements.php">Sterling Movements</a>
              <a class="dropdown-item" href="viewImmigrations.php">Immigrations</a>
              <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a> -->
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="graphs.php"><i class="fas fa-chart-pie"></i> Graphs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutUs.php"><i class="fas fa-info-circle"></i> About</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>