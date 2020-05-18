<?php
  include '../includes/LogRegFunctions.php';
  include '../includes/dbConnect.php';
  isOwnerLoggedIn();
?>

<!doctype html>
<html lang="sv">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="../favicon.ico">

    <!-- Load outside dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">

    <!-- Load internal stylesheets -->
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/dash.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="icon" href="../favicon.ico.png">

    <title>Skapa ny kö | Enqueue Dashboard</title>

  </head>

  <body>
    <div class="dash-queue-top-bar">
      <div class="content">
        <a href="index.php">Dashboard</a>
        <a href="functions/logout.php">Logga ut</a>
      </div>
    </div>
    <div class="dash-top">
      <div class="title">
        Skapa ny kö
        |   <span><?php echo  $_SESSION["email"]; ?></span>

      </div>
    </div>
    <div class="dash-content">
      <div class="dash-list active-sessions q-list">

        <div class="form-div">
          <form class="newQ-form" action="functions/create_new_queue.php" method="post">
            <label for="qname">Könamn</label>
            <input type="text" name="qname" placeholder="Könamn...">
            <label for="description">Beskrivning</label>
            <textarea name="description" rows="4" cols="10" placeholder="Övrig information..."></textarea>
            <div class="submit-div">
              <button type="submit" name="subnewqbtn" value="Skapa kö">Skapa kö</button>
            </div>
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

</html>
