<?php

  include '../includes/LogRegFunctions.php';
  include '../includes/dbConnect.php';
  include 'admin/admin.php';

  isOwnerLoggedIn();

  $ownerID = $_SESSION["ownerID"];

  $queues = $connection->query(
    "SELECT queue.queueUID, queue.qname, queue.description
    FROM queue WHERE ownerID='$ownerID'");

?>

<!doctype html>
<html lang="sv">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Load outside dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">

    <!-- Load internal stylesheets -->
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/dash.css">
    <link rel="icon" href="../favicon.ico.png">

    <title>Mina köer | Enqueue Dashboard</title>

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
        Mina köer | <span><?php echo $_SESSION["email"]; ?></span>
      </div>
    </div>
    <div class="dash-content">
      <div class="dash-list active-sessions q-list">
        <?php
          if ($queues || $queues->fetch_assoc()["ownerID"]!=NULL) {
            while($queue = $queues->fetch_assoc()) {
              ?>
                <div class="active-session">
                  <div class="content">
                    <div class="about">
                      <div class="name">
                        <h3>Kö-namn</h3>
                        <h1><?php echo $queue['qname'] ?></h1>
                        <span>Kod: </span>
                        <span><?php echo $queue['queueUID'] ?></span>
                      </div>
                      <div class="action">
                        <a class="other-btn" href="details.php?quid=<?php echo $queue['queueUID'] ?>">Öppna kö</a>
                      </div>
                    </div>
                    <div class="stats">
                      <div class="left">
                        <h4>Antal köare:</h4>
                        <p><?php echo (new Admin())->getQerCount($connection, $queue['queueUID']); ?></p>
                      </div>
                      <div class="right">
                        <h4>Åtgärder:</h4>
                        <a class="q-list-sm-action" href="edit.php?quid=<?php echo $queue['queueUID']; ?>">Redigera kö</a>
                        <a class="q-list-sm-action danger" onclick="return confirm('Är du säker på att du vill radera den här kön?')" href="functions/delete_queue.php?quid=<?php echo $queue['queueUID']; ?>">Radera kö</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
            }
          }
        ?>
        <div class="new-sess">
          <form class="" action="new.php" method="post">
            <input class="action-btn" type="submit" value="Skapa ny kö">
          </form>
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

  <script type="text/javascript" src="../assets/js/notice.js"></script>

</html>
