<!DOCTYPE html>
<html lang="sv" dir="ltr">
  <head>
    <meta charset="utf-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/smoothScroll.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/front-end.css">
    <link rel="icon" href="favicon.ico.png">

    <title>Enqueue</title>
  </head>
  <body>

    <div class="top-nav">
      <div class="logo-holder">
        <div class="logo"></div>
      </div>
      <div class="links">
        <a href="#HurDetFunkar">Hur det funkar</a>
        <a href="dashboard/register.php">Skapa ditt konto</a>
        <a href="dashboard/login.php">Logga in</a>
        <a href="queue/join.php">Gå med i en kö</a>
      </div>
    </div>

    <div class="big-pic">
      <div class="content-holder">
        <div class="content">
          <h1>Ett nytt sätt att köa</h1>
          <p>Enqueue är ett digitalt kösystem. Kräver ingen hårdvara helt Plug&Play, kom igång redan idag!</p>
        </div>
      </div>
    </div>

    <div class="home-content">
      <div class="left">
        <div class="content" id="Tjansten">
          <h1>Tjänsten</h1>
          <p>Enqueue hjälper din verksamhet att bli effektivare genom att låta dina kunder köa digitalt via deras mobila enheter. </p>
        </div>
      </div>
      <div class="right">
        <img class="icon" src="assets/img/phone-icon2.png" alt="">
      </div>
    </div>
    <div class="home-content">
      <div class="left">
        <div class="content" id="HurDetFunkar">
          <h1>Hur det funkar</h1>
          <p>Kunden ställer sig i kö genom att gå till en anmälningssida och sedan ange en "kö-kod" och ange sin personliga information. Därefter skickas ett SMS till kunden med en länk till en sida där kunden kan se sin plats i kön.</p>
        </div>
      </div>
      <div class="right">
        <img class="icon" src="assets/img/msg-icon.png" alt="">
      </div>
    </div>
    <div class="home-content">
      <div class="left">
        <div class="content">
          <h1>Skapar nöjdare kunder</h1>
          <p>Genom att använda Enqueue förenklar du och underlättar för dina kunder. Om kunder inte behöver köa lika mycket kommer det leda till nöjdare kunder och ökad intäkt!</p>
        </div>
      </div>
      <div class="right">
        <img class="icon" src="assets/img/customer-icon.png" alt="">
      </div>
    </div>

    <div class="footer">
      <div class="content">
        <h1>Enqueue</h1>
        <p>Utvecklad i Uppsala av Team Enqueue</p>
        <p>Detta är en demo</p>
      </div>
    </div>

  </body>
  <script type="text/javascript">
    // Script for setting dynamic height for login-wrapper.
    function fillHeight(){
    var wHeight = $(window).height();
    $('.big-pic').css('height', wHeight - 80 + 'px');
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
