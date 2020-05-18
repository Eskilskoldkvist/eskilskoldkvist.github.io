<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">

    <!-- Load external stylesheets -->
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/join.css">
    <link rel="stylesheet" href="../assets/css/style.css">


    <title>Gå med i kö | Enqueue</title>
  </head>
  <body>

    <div class="join">
      <div class="join-content">
        <div class="join-box">
          <div class="content">
            <img class="logobody" width="200px" src="../assets/img/enqueueLogo.png" alt="Picture of Enqueue logo">
            <h1>Ange din smart-code</h1>
            <form class="" action="details.php" method="post">
              <div class="smart-code-field">
                <input class="c-field" type="text" name="qcode" autocomplete="off">
                <input class="submit-btn" type="submit" value="Fortsätt">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


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

  </body>
</html>
