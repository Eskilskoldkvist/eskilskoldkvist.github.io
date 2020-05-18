<?php
  include '../includes/dbConnect.php';

  //$q_code = mysqli_real_escape_string($_POST['qcode']);

  if (isset($_GET['quid'])) {
    $q_code = mysqli_real_escape_string($connection, $_GET['quid']);
  }
  elseif (isset($_POST['qcode'])) {
    mysqli_real_escape_string($connection, $q_code = $_POST['qcode']);
  }

  $queue = $connection->query("SELECT queue.queueUID, queue.qname FROM queue WHERE queue.queueUID = '$q_code' LIMIT 1")->fetch_assoc();

  if ($queue === null) {
    header("Location: index.php");
    echo "No queue with that Q-Code exists!!";
  }

//echo $q_code;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
    <link rel="icon" href="favicon.ico.png">

    <!-- Load internal stylesheets -->
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/join.css">
    <script src="../assets/js/validate.js" type="text/javascript"></script>

    <title>Gå med i kö | Enqueue</title>
  </head>
  <body>

    <?php
      if ($_GET['notice']) { ?>
        <div class="top-notification">
          <p class="<?php echo $_GET['notice_type'] ?>"><b>Notis:</b> <?php echo $_GET['notice'] ?></p>
          <a href="">stäng</a>
        </div>
        <?php
      }
    ?>

    <div class="join">
      <div class="join-content">
        <div class="join-box">
          <div class="content">
            <h1>Gå med i "<?php echo $queue['qname']; ?>"</h1>
            <form class="" name="detailsForm" action="functions/join.php" method="post" onsubmit="return validateFormJoin()">
              <div class="form-group">
                <label>Förnamn</label>
                <input type="text" name="first_name" placeholder="Ange ditt förnamn...">
              </div>
              <div class="form-group">
                <label>Efternamn</label>
                <input type="text" name="last_name" placeholder="Ange ditt efternamn...">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" placeholder="example@example.com">
              </div>
              <div class="form-group">
                <label>Telefonnummer</label>
                <input type="text" name="phone" placeholder="+46701234567 ">
              </div>
              <div class="form-group">
                <input type="hidden" name="queue_uid" value="<?php echo $queue['queueUID']; ?>">
                <input class="submit-btn" type="submit" value="Gå med">
              </div>
            </form>

                    <div class="alertDiv">
                    <span id="alertmsg"></span>
                  </div>
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
