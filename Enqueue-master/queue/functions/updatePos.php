<?php

ob_start();
include '../../includes/dbConnect.php';
include '../../includes/session_helper.php';

if (isset($_POST["sessionId"])) {
  $session = get_session($connection, $_POST['sessionId']);
  if ($session["placement"] == "") {
    echo $session["sessionStatus"];
  }
  else {
    echo $session["placement"];
  }
}
else {
  echo json_encode("null");
}





 ?>
