<?php



session_start();
unset($_SESSION["ownerID"]);
unset($_SESSION["email"]);

header("Location: ../login.php");





 ?>
