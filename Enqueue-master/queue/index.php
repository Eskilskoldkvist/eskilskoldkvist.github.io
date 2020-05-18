<?php
  ob_start();
  include '../includes/dbConnect.php';
  include '../includes/session_helper.php';

  if ($_GET['sid'] == NULL) {
    header('Location: join.php');
    exit;
  }
  else {
    $session = get_session($connection, $_GET['sid']);
    if ($session === null) {
      header('Location: join.php');
      exit;
    }
  }

  if($session['sessionStatus'] == "inSession") {
    $sessioncss = 'inSession';
    $pos_text = "Din tur";
    $text = "Det är nu din tur att få hjälp, vänligen ta kontakt med en medarbetare.";
  }
  if($session['sessionStatus'] == "completed") {
    $sessioncss = 'completed';
    $pos_text = "Avklarad";
    $text = "Din session har nu blivit avklarad, tack och ha en fortsatt trevlig dag!";
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="sessionId" id="sessionId" content="<?php echo $_GET['sid']; ?>">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/inqueue.css">
    <link rel="icon" href="../favicon.ico.png">

    <title><?php echo $session['qname'] ?> | Enqueue</title>

  </head>
  <body>

    <?php include '../includes/notice.php' ?>

    <div class="page-content">
      <div class="place <?php echo $sessioncss; ?>">
        <div class="top">
          Din plats i kön
        </div>
        <div class="content">
          <div id="pos" class="pos inQueue animated <?php if($sessioncss) {echo $sessioncss;} ?>">
            <?php if ($pos_text) {
              echo $pos_text;
            }
            else {
              echo $session['placement'];
            }
            ?>
          </div>
          <div id="status" class="about">
            <?php if ($text) {
              echo $text;
            }
            else {
              echo "Du står i kö och väntar nu på din tur...";
            }
            ?>
            <?php
              if ($insesscom) {
                echo "Det är nu din tur att få hjälp, vänligen ta kontakt med en medarbetare.";
              } ?>
          </div>
        </div>
      </div>
      <div class="actions-pane">
        <div class="section" padding-bottom="30px">
          <div class="title">
            Information
          </div>
          <div class="content">
            <?php echo $session["description"]; ?>
          </div>
          <div class="content bottom">
            Startade kö: <?php echo $session["queueStartTime"]; ?>
          </div>
        </div>
        <div class="section" padding-bottom="30px">
          <div class="title">
            Actions
          </div>
          <a class="action-btn danger" href="leaveQueue.php?sid=<?php echo $_GET["sid"]; ?>">Lämna kö</a>
        </div>
      </div>
    </div>

  </body>

  <script type="text/javascript">

  function updatePos() {

    var sessionId = document.getElementById('sessionId').getAttribute("content");

    $.ajax({
      type:'POST',
      url: 'functions/updatePos.php',

      data: {'sessionId': sessionId},
      success:function(data) {
        console.log(data);
        document.getElementById("pos").innerHTML = data;
        if (data == "inSession") {
          document.getElementById("pos").innerHTML = "Din tur";
          $(".pos").removeClass("inQueue");
          $('.pos').css('width auto');
          $(".pos").addClass("inSession");
          $(".place").addClass("inSession");
          document.getElementById("status").innerHTML = "Det är nu din tur att få hjälp, vänligen ta kontakt med en medarbetare."
        }
        if (data == "completed") {
          document.getElementById("pos").innerHTML = "Avklarad";
          $(".pos").removeClass("inQueue");
          $('.pos').css('width auto');
          $(".pos").addClass("completed");
          $(".place").addClass("completed");
          document.getElementById("status").innerHTML = "Din session har nu blivit avklarad, tack och ha en fortsatt trevlig dag!"
        }
      }
    });
  }

  //setInterval(console.log("updatepos"), 10000);

  setInterval(function(){ updatePos(); }, 5000);

  </script>

  <?php if ($sessioncss == NULL) {
    ?>
      <script type="text/javascript">
        // Script for setting dynamic height for login-wrapper.
        function qWidth(){
        var qWidth = $('.inQueue').height();
        $('.inQueue').css('width', qWidth + 'px');
        }
        // Run fillHeight on page load.
        qWidth();
        // Re-run fillHeight everytime the page browser height or
        // width is resized.
        $(window).resize(function() {
        qWidth();
        });
      </script>
    <?php
  } ?>


</html>
