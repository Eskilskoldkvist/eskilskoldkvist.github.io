<?php

  include '../includes/LogRegFunctions.php';
  include '../includes/dbConnect.php';
  include 'admin/admin.php';

  isOwnerLoggedIn();

  $queueUID = $_GET['quid'];
  $queue = $connection->query("SELECT * FROM queue WHERE queue.queueUID = '$queueUID' LIMIT 1")->fetch_assoc();

  $url = 'www.enqueue.se/queue/details.php?quid='.$queue['queueUID'];

?>

<!doctype html>
<html lang="sv">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="../../../../favicon.ico">

    <!-- Load outside dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">

    <!-- Load internal stylesheets -->
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/join.css">

    <title>Min kö-kod| Enqueue Dashboard</title>

  </head>

  <body>

    <div class="join">
      <div class="join-content">
        <div class="join-box">
          <div class="content">
            <img class="logobody" width="200px" src="../assets/img/enqueueLogo.png" alt="Picture of Enqueue logo">
            <h1>Gå med i kön "<?php echo $queue['qname'] ?>"</h1>
            <p>För att gå med i kön gå till www.enqueue.se/queue och ange koden:</p>
            <h2><span class="dqc"><?php echo $queueUID ?></span></h2>
            <p><b>Eller</b> scanna följande QR-kod:</p>
              <img class="qr-code" src="" alt="">
          </div>
        </div>
      </div>
    </div>

  </body>

  <script type="text/javascript">
    function htmlEncode (value){
      return $('<div/>').text(value).html();
    }

    $(function() {
      $(".qr-code").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + '<?php echo $url ?>' + "&chs=160x160&chld=L|0");
    });
  </script>

  <script type="text/javascript">
    // Script for setting dynamic height for login-wrapper.
    function fillHeight(){
    var wHeight = $(window).height();
    $('.join-content').css('height', wHeight + 'px');
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
