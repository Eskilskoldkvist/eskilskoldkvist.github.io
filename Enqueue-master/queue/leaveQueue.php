<?php

include '../includes/dbConnect.php';

if (isset($_GET['sid'])) {


  $sessionID = $_GET['sid'];

  $query = "UPDATE session SET `sessionStatus` = 'Canceled' WHERE `sessionID` = '$sessionID'";

  $result = mysqli_query($connection, $query);

  if ($result) {
    echo "True";
  }
  else {
    echo "Error";
  }
  header("Location: index.php");

}
else {
  header("Location: index.php");
}






 ?>
