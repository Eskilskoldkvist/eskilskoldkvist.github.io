<?php
include 'admin.php';
include '../../includes/dbConnect.php';


$admin = new Admin();
$admin->adminGuard();
$admin->checkDeleteQueue($connection);
$admin->checkDeleteOwner($connection);
 ?>
 <a class="admin-logout" onclick="return confirm('Logga ut?')" href="logout.php">Logga ut</a>

<!DOCTYPE html>
<html lang="sv" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hugin/Munin</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="favicon.ico.png">

  </head>
  <body>
    <div class="header">
      <h3><?php echo "Välkommen ".$_SESSION['admin']; ?></h3>
      <div class="allfather-div">
        <img class="allfather-img"src="assets/img/allfather.png" alt="" width="75px">
    </div>
  </div>

    <div class="wrapper">
      <div class="sub-wrapper">
        <div class="qs">
          <h2>KÖER</h2>

          <?php $admin->getQueues($connection); ?>

        </div>

        <div class="owners">
          <h2>ÄGARE</h2>

          <?php $admin->getOwners($connection); ?>

        </div>

      </div>

    </div>



    </div>

  </body>
</html>
