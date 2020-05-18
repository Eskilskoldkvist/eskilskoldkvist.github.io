<?php
  include '../includes/LogRegFunctions.php';
  include '../includes/dbConnect.php';
  isOwnerLoggedIn();


  $queueUID = $_GET['quid'];
  $ownerID = $_SESSION["ownerID"];
  isOwnerToQueue($connection, $queueUID, $ownerID);
  $queue = $connection->query("SELECT * FROM queue WHERE queue.queueUID = '$queueUID' AND queue.ownerID = '$ownerID' LIMIT 1")->fetch_assoc();

  $active_sessions = $connection->query("SELECT * FROM session WHERE queueUID = '$queueUID' AND sessionStatus = 'inSession'");

  include 'functions/searchNsort.php';


?>

<!doctype html>
<html lang="sv">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="../favicon.ico.png">

    <!-- Load outside dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">

    <!-- Load internal stylesheets -->
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/dash.css">

    <title><?php echo $queue['qname'] ?> | Enqueue Dashboard</title>

  </head>

  <body>

    <?php include '../includes/notice.php' ?>

    <div class="dash-queue-top-bar">
      <div class="content">
        <a href="index.php">Dashboard</a>
        <a href="functions/logout.php">Logga ut</a>
      </div>
    </div>
    <div class="dash-top">
      <div class="title">
        <h1><?php echo $queue['qname'] ?></h1>
        <h2>Ange följande kod till kunder: <span class="dqc"><?php echo $queueUID ?></span></h2>
        <a href="code.php?quid=<?php echo $queueUID ?>">Tryck här för att visa "kö-anslutningssidan"</a>
      </div>
    </div>
    <div class="dash-content">
      <div class="dash-list active-sessions">
        <div class="list-name">Visar: <span class="displays">Aktiva sessioner</span></div>
        <?php
          if ($active_sessions) {
            if ($active_sessions->num_rows == 0) {
              ?><p class="no-sess">Du har ingen aktiv session</p><?php
            }
            while($session = $active_sessions->fetch_assoc()) {
              ?>
              <div class="active-session">
                <div class="content">
                  <div class="about">
                    <div class="name">
                      <h3>Namn</h3>
                      <h1><?php echo $session['customerFirstName']." ".$session['customerLastName'] ?></h1>
                    </div>
                    <div class="action">
                      <form class="" action="functions/end_session.php" method="post">
                        <input type="hidden" name="queueUID" value="<?php echo $queueUID ?>">
                        <input type="hidden" name="sessionID" value="<?php echo $session['sessionID'] ?>">
                        <input class="action-btn" type="submit" value="Avsluta session">
                      </form>
                    </div>
                  </div>
                  <div class="stats">
                    <div class="left">
                      <h4>Email:</h4>
                      <p><?php echo $session['customerEmail'] ?></p>
                      <h4>Telefon:</h4>
                      <p><?php echo $session['customerPhone'] ?></p>
                    </div>
                    <div class="right">
                      <h4>Kö start-tid:</h4>
                      <p><?php echo $session['queueStartTime'] ?></p>
                      <h4>Session start-tid:</h4>
                      <p><?php echo $session['sessionStartTime'] ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          }
        ?>
        <div class="new-sess">
          <form class="" action="functions/start_new_session.php" method="post">
            <input type="hidden" name="queueUID" value="<?php echo $queueUID ?>">
            <input class="action-btn" type="submit" value="Starta Ny Session">
          </form>
        </div>
      </div>
      <div class="dash-list all-sessions">
        <div class="list-name">Visar:
          <select id="sort_select" class="sort">
            <option <?php if($sortOn == 'inQueue'){echo 'selected="selected"';} ?> value="inQueue">
              Sessioner i kö
            </option>
            <option <?php if($sortOn == 'Completed'){echo 'selected="selected"';} ?> value="Completed">
              Avslutade sessioner
            </option>
          </select>
          <div class="search">
            Sök efter kund:
            <form class="" action="details.php?quid=<?php echo $queueUID ?>&sort=<?php echo $sortOn ?>" method="post">
              <input class="txt" type="text" placeholder="Ange kundens förnamn" name="search" autocomplete="off" value="<?php echo $search_on ?>">
              <input class="btn" type="submit" value="Sök">
            </form>
          </div>
        </div>
        <div class="sessions-list">
          <?php
            if ($all_sessions && $sortOn == 'inQueue') {
              if ($all_sessions->num_rows == 0) {
                ?><p class="no-sess">Inga kunder i kö.</p><?php
              }
              while($session = $all_sessions->fetch_assoc()) {
                ?>
                <div class="session">
                  <div class="about">
                    <div class="placement">
                      <h3>Nr</h3>
                      <h1><?php echo $session['placement'] ?></h1>
                    </div>
                    <div class="name">
                      <h3>Namn</h3>
                      <h1><?php echo $session['customerFirstName']." ".$session['customerLastName'] ?></h1>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
          ?>
          <?php
            if ($all_sessions && $sortOn == 'Completed') {
              if ($all_sessions->num_rows == 0) {
                ?><p class="no-sess">Inga kunder i kö.</p><?php
              }
              while($session = $all_sessions->fetch_assoc()) {
                ?>
                <div class="session">
                  <div class="about">
                    <div class="name">
                      <h3>Namn</h3>
                      <h1><?php echo $session['customerFirstName']." ".$session['customerLastName'] ?></h1>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
          ?>
        </div>
      </div>
    </div>
  </body>

  <script type="text/javascript">
    // Script for setting dynamic height for login-wrapper.
    function fillHeight(){
    var wHeight = $(window).height();
    $('.active-sessions').css('min-height', wHeight - 159 + 'px');
    }
    // Run fillHeight on page load.
    fillHeight();
    // Re-run fillHeight everytime the page browser height or
    // width is resized.
    $(window).resize(function() {
    fillHeight();
    });
  </script>

  <script type="text/javascript">
    $("#sort_select").change(function() {
      location.href = "details.php?quid=<?php echo $queueUID ?>&sort=" + $("#sort_select").val();
    });
  </script>

</html>
